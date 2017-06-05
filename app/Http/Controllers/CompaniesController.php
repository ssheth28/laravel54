<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Auth;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
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
        $roleId = $request->roleid;
        $request->session()->put('currentrole', $roleId);
        return response()
            ->json(['redirecturl' => route('admin.home', ['domain' => $companySlug])]);
    }
}
