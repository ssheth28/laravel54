<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Vacancy;
use App\Models\Department;
use Illuminate\Http\Request;

class VacanciesController extends Controller
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
        $this->title = 'Vacancies';
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
        $departments = Department::all()->pluck('name', 'id');
        return view('hr_department.vacancy_manager.index', compact('departments'));
    }

    public function getVacanciesData()
    {
        $request = $this->request->all();
        $vacancyDetails = DB::table('vacancies')
                            ->join('departments', 'departments.id', 'vacancies.department_id')
                            ->select('*', DB::raw('DATE_FORMAT(vacancies.created_at, "%d-%m-%Y") as "created_datetime"'),
                                DB::raw('departments.name as departmentName'));

        $sortby = 'vacancies.id';
        $sorttype = 'desc';

        $vacancyDetails->orderBy($sortby, $sorttype);

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        if (isset($request['position_name']) && trim($request['position_name']) !== '') {
            $vacancyDetails->where('vacancies.position_name', 'like', '%'.$request['position_name'].'%');
        }

        if (isset($request['department']) && trim($request['department']) !== '') {
            $vacancyDetails->where('vacancies.department_id', '=', $request['department']);
        }        

        $vacancyDetailsList = [];

        if (!array_key_exists('pagination', $request)) {
            $vacancyDetails = $vacancyDetails->paginate($request['pagination_length']);
            $vacancyDetailsList = $vacancyDetails;
        } else {
            $vacancyDetailsList['total'] = $vacancyDetails->count();
            $vacancyDetailsList['data'] = $vacancyDetails->get();
        }

        $response = $vacancyDetailsList;

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all()->pluck('name', 'id');
        return view('hr_department.vacancy_manager.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vacancy = new Vacancy();
        $vacancy->position_name = $request->position_name;
        $vacancy->department_id = $request->department_name;
        $vacancy->no_of_vacancies = $request->no_of_vacancies;
        $vacancy->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('vacancies.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($company, $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $departments = Department::all()->pluck('name', 'id');
        return view('hr_department.vacancy_manager.edit', compact('vacancy', 'departments'));
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
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->position_name = $request->position_name;
        $vacancy->department_id = $request->department_name;
        $vacancy->no_of_vacancies = $request->no_of_vacancies;
        $vacancy->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('vacancies.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        $vacancy = Vacancy::where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));

        return redirect()->route('vacancies.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
