<?php

namespace App\Http\Controllers;

use DB;
use View;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologiesController extends Controller
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
        $this->title = 'Project Technologies';
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
        $technologies = Technology::all();
        return view('technologies.index', compact('technologies'));
    }

    public function getTechnologyData()
    {
        $request = $this->request->all();
        $technologies = DB::table('technologies')
                    ->select('*', DB::raw('DATE_FORMAT(technologies.created_at, "%d-%m-%Y") as "created_datetime"'));

        $sortby = 'technologies.id';
        $sorttype = 'desc';

        if (isset($request['sortby'])) {
            $sortby = $request['sortby'];
            $sorttype = $request['sorttype'];
        }

        $technologiesList = [];

        if (!array_key_exists('pagination', $request)) {
            $technologies = $technologies->paginate($request['pagination_length']);
            $technologiesList = $technologies;
        } else {
            $technologiesList['total'] = $technologies->count();
            $technologiesList['data'] = $technologies->get();
        }

        $response = $technologiesList;

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
        $technology = new Technology();
        $technology->name = $request->technology_name;
        $technology->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('technologies.index', ['domain' => app('request')->route()->parameter('company')]);
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
        $technology = Technology::findOrFail($id);
        $technology->name = $request->technology_name;
        $technology->save();

        flash()->success(config('config-variables.flash_messages.dataSaved'));
        return redirect()->route('technologies.index', ['domain' => app('request')->route()->parameter('company')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($company, $id)
    {
        Technology::where('id', $id)->delete();
        flash()->success(config('config-variables.flash_messages.dataDeleted'));
        return redirect()->route('technologies.index', ['domain' => app('request')->route()->parameter('company')]);
    }
}
