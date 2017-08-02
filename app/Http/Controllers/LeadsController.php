<?php

namespace App\Http\Controllers;

use DB;
use View;
use Landlord;
use App\Models\Lead;
use App\Models\Country;
use Illuminate\Http\Request;

class LeadsController extends Controller
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
        $this->title = 'Business';
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
        $countries = Country::all()->pluck('name', 'id');
        return view('leads.index', compact('countries'));
    }

    public function getLeadsData() 
    {
        $request = $this->request->all();
        $leadsDetails = DB::table('leads')
                        ->join('users', 'users.id', 'leads.poc_id')
                        ->join('people', 'users.person_id', 'people.id')
                        ->select('leads.*', DB::raw('DATE_FORMAT(leads.created_at, "%d-%m-%Y") as "created_datetime"'),
                            DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'));

        $sortby = 'leads.id';
        $sorttype = 'desc';

        $leadsDetails->orderBy($sortby, $sorttype);

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        if (isset($request['lead_name']) && trim($request['lead_name']) !== '') {
            $leadsDetails->where('leads.lead_name', 'like', '%'.$request['lead_name'].'%');
        }

        if (isset($request['lead_email']) && trim($request['lead_email']) !== '') {
            $leadsDetails->where('leads.email', 'like', '%'.$request['lead_email'].'%');
        }

        if (isset($request['country']) && trim($request['country']) !== '') {
            $leadsDetails->where('leads.country_id', '=', '%'.$request['country']);
        }

        $leadsDetailsList = [];

        if (!array_key_exists('pagination', $request)) {
            $leadsDetails = $leadsDetails->paginate($request['pagination_length']);
            $leadsDetailsList = $leadsDetails;
        } else {
            $leadsDetailsList['total'] = $leadsDetails->count();
            $leadsDetailsList['data'] = $leadsDetails->get();
        }

        $response = $leadsDetailsList;

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
        $users = DB::table('users')
                    ->join('company_user', 'company_user.user_id', 'users.id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->where('company_user.company_id', $companyId)
                    ->select('users.*', DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'))
                    ->pluck('userFullName', 'users.id');

        $countries = Country::all()->pluck('name', 'id');
        return view('leads.create', compact('countries', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lead = new Lead();
        $lead->lead_name = $request->lead_name;
        $lead->country_id = $request->country;
        $lead->contact_no = $request->contact_no;
        $lead->email = $request->email;
        $lead->skype_id = $request->skype_id;
        $lead->reference = $request->reference;
        $lead->last_update_status = $request->last_update_status;
        $lead->poc_id = $request->poc;
        $lead->industry = $request->industry;
        $lead->other_detail = $request->other_detail;

        $lead->save();

        $image = $request->file('file');
        dd($image);
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('leads.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($company, $id)
    {
        $lead = Lead::with('country')->find($id);
        $leadDetailHtml = view('leads.lead_detail_show', ['lead' => $lead])->render();

        return array('leadDetailHtml' => $leadDetailHtml);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $companyId = Landlord::getTenants()['company']->id;
        $users = DB::table('users')
                    ->join('company_user', 'company_user.user_id', 'users.id')
                    ->join('people', 'users.person_id', 'people.id')
                    ->where('company_user.company_id', $companyId)
                    ->select('users.*', DB::raw('CONCAT(people.first_name, " ", people.last_name) as userFullName'))
                    ->pluck('userFullName', 'users.id');
        $countries = Country::all()->pluck('name', 'id');
        $lead = Lead::findOrFail($id);

        return view('leads.edit', compact('countries', 'lead', 'users'));
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
        $lead = Lead::findOrFail($id);
        $lead->lead_name = $request->lead_name;
        $lead->country_id = $request->country;
        $lead->contact_no = $request->contact_no;
        $lead->email = $request->email;
        $lead->skype_id = $request->skype_id;
        $lead->reference = $request->reference;
        $lead->last_update_status = $request->last_update_status;
        $lead->poc_id = $request->poc;
        $lead->industry = $request->industry;
        $lead->other_detail = $request->other_detail;
        $lead->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('leads.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        Lead::where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));

        return redirect()->route('leads.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
