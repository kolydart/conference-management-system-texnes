<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Paper;
use Gate;
use Illuminate\Http\Request;
use gateweb\common\database\LogUserAgent;

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
        (new LogUserAgent())->snapshot(['item_id'=>$id],false);

        return view('frontend.papers.show', compact('paper'));
    }

}
