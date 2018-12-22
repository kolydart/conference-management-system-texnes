<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Paper;
use Gate;
use Illuminate\Http\Request;
use gateweb\common\Presenter;
use gateweb\common\Router;
use gateweb\common\database\LogUserAgent;

class PapersController extends Controller
{
    use FileUploadTrait;
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

    /**
     * Show the form for editing Paper.
     * valid only with signed url
     *
     * @param  Request  $request
     * @param  paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Paper $paper)
    {

        /** check valid signature */
        if (! $request->hasValidSignature() || $paper->lab_approved) {
            Presenter::message("Δεν έχετε δικαιώματα επεξεργασίας στο αντικείμενο.","warning");
            return redirect(route('frontend.home'));
        }
        
        $paper = Paper::findOrFail($paper->id);

        return view('frontend.papers.edit', compact('paper'));
    }

    /**
     * Update a Paper in storage.
     * protected by csrf (I hope)
     *
     * @param  Request  $request
     * @param  paper  $paper
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paper $paper)
    {

        $request->validate([
            'title' => 'required|regex:'.Router::PREG_VALIDATE_TEXT,
            'abstract' => 'required',
            'objectives' => 'required',
            'materials' => 'required',
            'description' => 'required',
            'evaluation' => 'required',
            'video' => 'url',
            'images' => 'image',
        ]);

        $request = $this->saveFiles($request);

        // dd($request->all());
        $paper->update([
            'title' => $request->title,
            'abstract' => $request->abstract,
            'objectives' => $request->objectives,
            'materials' => $request->materials,
            'description' => $request->description,
            'evaluation' => $request->evaluation,
            'images' => $request->images,
            'video' => $request->video,
            'bibliography' => $request->bibliography,            
        ]);

        $media = [];
        foreach ($request->input('images_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $paper->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $paper->updateMedia($media, 'images');

        Presenter::message("Η εγγραφή ενημερώθηκε.<br>Θα δημοσιευτεί μετά την επιβεβαίωση από την οργανωτική επιτροπή.<br>Ευχαριστούμε.","info");

        return redirect()->route('frontend.papers.show',['id'=>$paper->id]);
    }


}
