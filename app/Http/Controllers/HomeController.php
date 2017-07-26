<?php

namespace App\Http\Controllers;

use Auth;
use View;
use Modules\Widget\Entities\Widget;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Home';
        View::share('title', $this->title);
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $widgets = Widget::where('company_id', '=', 1)->pluck('status', 'slug');
        return view('home.home', compact('widgets'));
    }
}
