<?php

namespace App\Http\Controllers;

use Auth;
use View;
use DB;
use Landlord;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title = 'Company Profile';
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Companies           $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Companies $companies
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies)
    {
    }

    /**
     * Generate slug.
     *
     * @param Request $request Request Object
     *
     * @return JSON JSON response
     */
    public function generateSlug(Request $request)
    {
        $slug = Companies::makeSlugUniqueBeforeCreate(str_slug($request->company_name));

        return $slug;
    }

    /**
     * Select company.
     *
     * @param Request $request Request Object
     *
     * @return JSON JSON response
     */
    public function selectCompany(Request $request)
    {
        $companySlug = app('request')->route()->parameter('company');
        $companies = Auth::user()->companies()->where('settings->is_invitation_accepted', 1);

        if ($companySlug != 'www') {
            return redirect()->route('admin.home', ['domain' => $companySlug]);
        }

        if (count($companies->get()) == 1) {
            $singleCompanySlug = $companies->first();

            $roles = Auth::user()->roles->filter(function ($value, $key) use($singleCompanySlug) {
                    if (explode('.', $value->name)[0] == $singleCompanySlug->id) {
                        return $value;
                    }
                })->values();

            if(count($roles) == 1) {
                $request->session()->put('currentrole', $roles->first()->id);
                return redirect()->route('admin.home', ['domain' => $singleCompanySlug->slug]);
            } else {
                return view('auth.selectcompany');
            }
        }
        return view('auth.selectcompany');
    }

    public function redirectUserCompanyRole(Request $request)
    {
        $companySlug = $request->companyslug;
        $companyId = $request->companyid;
        $roles = Auth::user()->roles->filter(function ($value, $key) use($companyId) {
                if (explode('.', $value->name)[0] == $companyId) {
                    return $value;
                }
            })->values();
        $roleId = $roles->first()->id;
        $request->session()->put('currentrole', $roleId);
        return response()
            ->json(['redirecturl' => route('admin.dashboard', ['domain' => $companySlug])]);
    }

    public function companyProfile()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $companyData = Companies::with('user')->find($companyId);
        return view('companies.overview', compact('companyData'));
    }

    public function viewMembers()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $companyData = Companies::with('user')->find($companyId);

        $users = DB::table('users')
                        ->join('company_user', 'company_user.user_id', 'users.id')
                        ->join('people', 'users.person_id', 'people.id')
                        ->where('company_user.company_id', $companyId)
                        ->select('*', DB::raw('DATE_FORMAT(users.created_at, "%d-%m-%Y %H:%i:%s") as "created_datetime"'),
                                      DB::raw('users.id as user_id'),
                                      DB::raw('company_user.settings as settings'))->get();    
                                      // dd($users);    
        
        return view('companies.view_members', compact('users', 'companyData'));
    }

    public function editCompanyProfile()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $companyData = Companies::with('user')->find($companyId);
        return view('companies.edit_company_profile', compact('companyData'));
    }

    public function updateCompanyProfile(Request $request, $company)
    {
        $companyId = Landlord::getTenants()['company']->id;
        $company = Companies::findOrFail($companyId);
        $companyLogo = $request->file('company_logo');

        $company->name = $request->name;
        $company->company_domain_url = $request->company_domain_url;
        $company->contact_no = $request->contact_no;
        $company->email = $request->company_email;
        $company->country = $request->country;
        $company->state = $request->state;
        $company->city = $request->city;
        $company->pincode = $request->pincode;
        $company->address = $request->address;

        $company->save();
        
        // store company logo
        if($companyLogo) {
            $company->clearMediaCollection('Company_logo');
            $media = $company->addMedia($companyLogo)
                            ->preservingOriginal()
                            ->toMediaLibrary('Company_logo');
        }

        flash()->success(config('config-variables.flash_messages.dataSaved'));

        return redirect()->route('company.edit.profile', ['domain' => app('request')->route()->parameter('company')]);
    }

    public function changePassword()
    {
        $companyId = Landlord::getTenants()['company']->id;
        $companyData = Companies::with('user')->find($companyId);
        return view('companies.change_password', compact('companyData'));
    }
}