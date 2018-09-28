<?php

namespace App\Http\Controllers\Frontend;

use App\ContentPage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use gateweb\common\database\LogUserAgent;

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
        (new LogUserAgent())->snapshot(['item_id'=>$page->id],false);

        return view('frontend.page', compact('page'));
    }

}
