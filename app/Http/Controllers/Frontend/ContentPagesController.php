<?php

namespace App\Http\Controllers\Frontend;

use App\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class ContentPagesController extends Controller
{

    /**
     * Display ContentPage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($alias)
    {
        
        $page = ContentPage::where('alias', $alias)->firstOrFail();

        return view('frontend.page', compact('page'));
    }

}
