<?php

namespace App\Http\Controllers\Frontend;

use App\Session;
use Illuminate\Http\Request;
use Gate;
use App\Http\Controllers\Controller;

class SessionsController extends Controller
{
    /**
     * Display a listing of Session.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = Session::all();

        return view('frontend.sessions.index', compact('sessions'));
    }

    /**
     * Display Session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $papers = \App\Paper::accepted()->where('session_id', $id)->orderByRaw('-`order` DESC')->orderByAttribute()->get();

        $session = Session::findOrFail($id);

        return view('frontend.sessions.show', compact('session', 'papers'));
    }

}
