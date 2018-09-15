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
        /** 
         * @todo ->orderBy(RelatedDate)
         */
        $papers = Paper::accepted()->filtered()->get(); 

        return view('frontend.papers.index', compact('papers'));
    }

    /**
     * Display Paper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $paper = Paper::accepted()->findOrFail($id);

        return view('frontend.papers.show', compact('paper'));
    }

}
