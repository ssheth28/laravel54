<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $this->title = 'Department';
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
        $departments = Department::all();
        return view('department.index', compact('departments'));
    }

    public function getDepartmentData()
    {
        $request = $this->request->all();
        $departments = DB::table('departments')
                    ->select('*', DB::raw('DATE_FORMAT(departments.created_at, "%d-%m-%Y") as "created_datetime"'));

        $sortby = 'departments.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $departmentsList = [];

        if (!array_key_exists('pagination', $request)) {
            $departments = $departments->paginate($request['pagination_length']);
            $departmentsList = $departments;
        } else {
            $departmentsList['total'] = $departments->count();
            $departmentsList['data'] = $departments->get();
        }

        $response = $departmentsList;

        return $response;            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department = new Department();
        $department->name = $request->department_name;
        $department->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('departments.index', ['domain' => app('request')->route()->parameter('company')]);
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
    public function edit($id)
    {
        //
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
        $department = Department::findOrFail($id);
        $department->name = $request->department_name;
        $department->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('departments.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        Department::where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));

        return redirect()->route('departments.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
