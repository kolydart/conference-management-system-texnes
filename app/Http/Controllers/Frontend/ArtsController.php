<?php

namespace App\Http\Controllers\Frontend;

use App\Art;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtsController extends Controller
{
    /**
     * Display a listing of Art.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arts = Art::all();

        return view('frontend.arts.index', compact('arts'));
    }

    /**
     * Display Art.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $papers = \App\Paper::whereHas('art',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $art = Art::findOrFail($id);

        return view('frontend.arts.show', compact('art', 'papers'));
    }

}
