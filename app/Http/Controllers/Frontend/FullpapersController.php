<?php

namespace App\Http\Controllers\Frontend;

use App\Fullpaper;
use App\Http\Controllers\Controller;
use App\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FullpapersController extends Controller
{

    public function download($uuid,$paper_id=null) {
        $path = Fullpaper::where('uuid', $uuid)->firstOrFail()->getFirstMedia('finaltext')->getPath();
        if($paper_id)
			activity()
			   ->causedBy(Paper::findOrFail($paper_id))
			   ->performedOn(Fullpaper::where('uuid', $uuid)->firstOrFail())
			   ->log('download');        	

        return response()->download($path);
    }
 
}
