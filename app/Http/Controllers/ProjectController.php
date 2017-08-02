<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Technology;
use Carbon\Carbon as Carbon;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->title = 'Project';
        View::share('title', $this->title);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $projectTechnologies = Technology::all()->pluck('name', 'id');
        $clients = DB::table('clients')->pluck('name', 'id');
        $projectMembers =  DB::table('users')
                            ->join('company_user', 'company_user.user_id', 'users.id')
                            ->join('people', 'users.person_id', 'people.id')
                            ->where('company_user.company_id', $companyId)
                            ->select('users.*', DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'))
                            ->pluck('userFullName', 'users.id');
        return view('projects.index', compact('projectTechnologies', 'clients', 'projectMembers'));
    }

    public function getProjectData()
    {
        $request = $this->request->all();
        $projects = DB::table('projects')
                    ->leftjoin('technologies', 'technologies.id', 'projects.technology_id')
                    ->leftjoin('clients', 'clients.id', '=', 'projects.client_id')
                    ->leftjoin('project_user', 'project_user.project_id', 'projects.id')
                    ->select('projects.*', DB::raw('DATE_FORMAT(projects.created_at, "%d-%m-%Y") as "created_datetime"'),
                                DB::raw('technologies.name as technologyName'),
                                DB::raw('clients.name as clientName'),
                                DB::raw('count(project_user.user_id) as totalMembers'))
                    ->groupBy('projects.id');

        $sortby = 'projects.id';
        $sorttype = 'desc';

        $projects->orderBy($sortby, $sorttype);

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        if (isset($request['name']) && trim($request['name']) !== '') {
            $projects->where('projects.name', 'like', '%'.$request['name'].'%');
        }

        if (isset($request['project_technology']) && trim($request['project_technology']) !== '') {
            $projects->where('projects.technology_id', '=', $request['project_technology']);
        }

        if (isset($request['project_member']) && trim($request['project_member']) !== '') {
            $projects->where('project_user.user_id', '=', $request['project_member']);
        }

        if (isset($request['client']) && trim($request['client']) !== '') {
            $projects->where('projects.client_id', '=', $request['client']);
        }

        if (isset($request['priority']) && trim($request['priority']) !== '') {
            $projects->where('projects.priority', '=', $request['priority']);
        } 

        if (isset($request['status']) && trim($request['status']) !== '') {
            $projects->where('projects.status', '=', $request['status']);
        }                                        

        $projectsList = [];

        if (!array_key_exists('pagination', $request)) {
            $projects = $projects->paginate($request['pagination_length']);
            $projectsList = $projects;
        } else {
            $projectsList['total'] = $projects->count();
            $projectsList['data'] = $projects->get();
        }

        $response = $projectsList;

        return $response;                    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $technologies = Technology::all()->pluck('name', 'id');
        $clients = DB::table('clients')->pluck('name', 'id');

        $users = DB::table('users')
                    ->join('company_user', 'company_user.user_id', 'users.id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->where('company_user.company_id', $companyId)
                    ->select('users.*', DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'))
                    ->pluck('userFullName', 'users.id');

        return view('projects.create', compact('technologies', 'users', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->name = $request->project_name;
        $project->technology_id = $request->project_tech;
        $project->project_type = $request->project_type;
        $project->client_id = $request->client_name;
        $project->old_website = $request->old_website;        
        $project->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $project->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $project->other_info = $request->other_info;
        $project->status = $request->project_status;
        $project->priority = $request->project_priority;
        $project->save();

        foreach ($request->project_member as $member) {
            $projectUser = new ProjectUser();
            $projectUser->user_id = $member;
            $projectUser->project_id = $project->id;
            $projectUser->save();
        }

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('projects.index', ['domain' => app('request')->route()->parameter('company')]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company, $id)
    {
        $project = Project::with('technology', 'client')->find($id);
        $projectDetailHtml = view('projects.project_detail_show', ['project' => $project])->render();

        return array('projectDetailHtml' => $projectDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $project = Project::findOrFail($id);
        $clients = DB::table('clients')->pluck('name', 'id');
        $technologies = Technology::all()->pluck('name', 'id');
        $users = DB::table('users')
                    ->join('people', 'users.person_id', 'people.id')
                    ->pluck('people.first_name', 'users.id')
                    ->toArray();

        return view('projects.edit', compact('project', 'clients', 'technologies', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $company, $id)
    {
        $project = Project::findOrFail($id);
        $project->name = $request->project_name;
        $project->technology_id = $request->project_tech;
        $project->project_type = $request->project_type;
        $project->client_id = $request->client_name;
        $project->old_website = $request->old_website;        
        $project->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
        $project->end_date = Carbon::parse($request->end_date)->format('Y-m-d');
        $project->other_info = $request->other_info;
        $project->status = $request->project_status;
        $project->priority = $request->project_priority;
        $project->save();

        $project->user()->sync([]);

        foreach ($request->project_member as $member) {
            $projectUser = new ProjectUser();
            $projectUser->user_id = $member;
            $projectUser->project_id = $project->id;
            $projectUser->save();
        }

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('projects.index', ['domain' => app('request')->route()->parameter('company')]);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        $project = Project::with('user')->where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));

        return redirect()->route('projects.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
