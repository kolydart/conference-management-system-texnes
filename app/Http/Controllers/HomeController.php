<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\ReportsController;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['backend','auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $fullpapers = \App\Fullpaper::latest()->limit(5)->get(); 

        $attendsReport = (new ReportsController)->attendCreated($request);

        return view('home', array_merge(compact( 'fullpapers' ),$attendsReport));
    }

}
