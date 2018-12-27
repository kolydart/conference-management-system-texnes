<?php

namespace App\Http\Controllers\Frontend;

use App\Fullpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class FullpapersController extends Controller
{
    public function download($uuid) {
        $fullpaper = Fullpaper::where('uuid', $uuid)->firstOrFail();
        $path = Fullpaper::first()->getFirstMedia('finaltext')->getPath();
        return response()->download($path);
    }
 
}
