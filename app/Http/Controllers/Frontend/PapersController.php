<?php

namespace App\Http\Controllers\Frontend;

use App\Paper;
use Illuminate\Http\Request;
use Gate;
use App\Http\Controllers\Controller;

class PapersController extends Controller
{
    /**
     * Display a listing of Paper.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $papers = Paper::all()->reverse();

        return view('admin.papers.index', compact('papers'));
    }

    /**
     * Display Paper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $arts = \App\Art::get()->pluck('title', 'id');

        $sessions = \App\Session::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $assigns = \App\User::get()->pluck('name', 'id');
        $fullpapers = \App\Fullpaper::where('paper_id', $id)->get();$reviews = \App\Review::where('paper_id', $id)->get();$messages = \App\Message::where('paper_id', $id)->get();

        $paper = Paper::findOrFail($id);

        return view('admin.papers.show', compact('paper', 'fullpapers', 'reviews', 'messages'));
    }

}
