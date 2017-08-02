<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\User;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Carbon\Carbon as Carbon;

class RecruitmentsController extends Controller
{
    public $title;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->title = 'Recruitments Manager';
        $this->request = $request;
        View::share('title', $this->title);
        parent::__construct();        
    }

    public function __destruct()
    {
        unset($this->title);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $users = DB::table('users')
                    ->join('company_user', 'company_user.user_id', 'users.id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->where('company_user.company_id', $companyId)
                    ->select('users.*', DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'))
                    ->pluck('userFullName', 'users.id');

        return view('hr_department.recruitments.index', compact('users'));
    }

    public function getRecruitmentData() 
    {
        $request = $this->request->all();
        $recruitmentDetails = DB::table('recruitment_details')
                    ->join('users', 'users.id', 'recruitment_details.assignee_id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->select('recruitment_details.*', 
                        DB::raw('DATE_FORMAT(recruitment_details.date_of_interview, "%d-%m-%Y") as "date_of_interview"'),
                        DB::raw('DATE_FORMAT(recruitment_details.time_of_interview, "%H:%i %p") as "time_of_interview"'),
                        DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'));

        $sortby = 'recruitment_details.id';
        $sorttype = 'desc';

        $recruitmentDetails->orderBy($sortby, $sorttype);

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        if (isset($request['person_name']) && trim($request['person_name']) !== '') {
            $recruitmentDetails->where('recruitment_details.person_name', 'like', '%'.$request['person_name'].'%');
        }

        if (isset($request['position']) && trim($request['position']) !== '') {
            $recruitmentDetails->where('recruitment_details.position', '=', $request['position']);
        }

        if (isset($request['last_status']) && trim($request['last_status']) !== '') {
            $recruitmentDetails->where('recruitment_details.last_status', '=', $request['last_status']);
        }

        if (isset($request['assignee']) && trim($request['assignee']) !== '') {
            $recruitmentDetails->where('recruitment_details.assignee_id', '=', $request['assignee']);
        }  

        $recruitmentDetailsList = [];

        if (!array_key_exists('pagination', $request)) {
            $recruitmentDetails = $recruitmentDetails->paginate($request['pagination_length']);
            $recruitmentDetailsList = $recruitmentDetails;
        } else {
            $recruitmentDetailsList['total'] = $recruitmentDetails->count();
            $recruitmentDetailsList['data'] = $recruitmentDetails->get();
        }

        $response = $recruitmentDetailsList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = DB::table('users')
                    ->join('people', 'users.person_id', 'people.id')
                    ->pluck('people.first_name', 'users.id')
                    ->toArray();
        return view('hr_department.recruitments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyId = Landlord::getTenants()['company']->id;
        $recruitment = new Recruitment();
        $recruitment->person_name = $request->person_name;
        $recruitment->position = $request->position;
        $recruitment->date_of_interview = Carbon::parse($request->date_of_interview)->format('Y-m-d H:i:s');
        $recruitment->time_of_interview = Carbon::parse($request->time_of_interview)->format('Y-m-d H:i:s');
        $recruitment->assignee_id = $request->assigned_to;
        $recruitment->last_status = $request->last_status;
        $recruitment->area_of_interest = $request->area_of_interest;
        $recruitment->source_of_info_about_company = $request->source_of_info_about_company;
        $recruitment->remarks = $request->remarks;
        $recruitment->contact_no = $request->contact_no;
        $recruitment->current_salary = $request->current_salary;
        $recruitment->expected_salary = $request->expected_salary;
        $recruitment->notice_period = $request->notice_period;
        $recruitment->date_of_joining = Carbon::parse($request->date_of_joining)->format('Y-m-d H:i:s');
        $recruitment->preferred_location = $request->preferred_location;
        $recruitment->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('recruitments.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company, $id)
    {
        $recruitment = Recruitment::find($id);
        $recruitmentDetailHtml = view('hr_department.recruitments.recruitment_detail_show', ['recruitment' => $recruitment])->render();

        return array('recruitmentDetailHtml' => $recruitmentDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $users = DB::table('users')
                    ->join('people', 'users.person_id', 'people.id')
                    ->pluck('people.first_name', 'users.id')
                    ->toArray();

        return view('hr_department.recruitments.edit', compact('recruitment','users'));        
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
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->person_name = $request->person_name;
        $recruitment->position = $request->position;
        $recruitment->date_of_interview = Carbon::parse($request->date_of_interview)->format('Y-m-d H:i:s');
        $recruitment->time_of_interview = Carbon::parse($request->time_of_interview)->format('Y-m-d H:i:s');
        $recruitment->assignee_id = $request->assigned_to;
        $recruitment->last_status = $request->last_status;
        $recruitment->area_of_interest = $request->area_of_interest;
        $recruitment->source_of_info_about_company = $request->source_of_info_about_company;
        $recruitment->remarks = $request->remarks;
        $recruitment->contact_no = $request->contact_no;
        $recruitment->current_salary = $request->current_salary;
        $recruitment->expected_salary = $request->expected_salary;
        $recruitment->notice_period = $request->notice_period;
        $recruitment->date_of_joining = Carbon::parse($request->date_of_joining)->format('Y-m-d H:i:s');
        $recruitment->preferred_location = $request->preferred_location;
        $recruitment->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('recruitments.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        $recruitment = Recruitment::where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));

        return redirect()->route('recruitments.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
