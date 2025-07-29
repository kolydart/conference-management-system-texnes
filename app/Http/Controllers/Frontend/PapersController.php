<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\Frontend\UpdatePapersRequest;
use App\Paper;
use Gate;
use Illuminate\Http\Request;
// use gateweb\common\Presenter; // Removed during gateweb cleanup
// use gateweb\common\Router; // Removed during gateweb cleanup
// use gateweb\common\database\LogUserAgent; // Removed during gateweb cleanup

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
        // if ((new Router)->validate($id,'int'))
        //     (new LogUserAgent())->snapshot(['item_id'=>$id],false); // Removed during gateweb cleanup

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
            session()->flash('warning', "Δεν έχετε δικαιώματα επεξεργασίας στο αντικείμενο.");
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
    public function update(UpdatePapersRequest $request, Paper $paper)
    {

        $request = $this->saveFiles($request);

        // dd($request->all());
        $paper->update([
            'title' => $request->title,
            'duration' => $request->duration,
            'abstract' => $request->abstract,
            'age' => $request->age,
            'capacity' => $request->capacity,
            'objectives' => $request->objectives,
            'materials' => $request->materials,
            'description' => $request->description,
            'evaluation' => $request->evaluation,
            'images' => $request->images,
            'video' => $request->video,
            'keywords' => $request->keywords,
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

        session()->flash('info', "Η καρτέλα ενημερώθηκε.<br>Θα είναι δημόσια προσβάσιμη αφού επιβεβαιωθεί από τους επιμελητές των πρακτικών.<br>Ευχαριστούμε.");

        return redirect()->route('frontend.papers.show',['id'=>$paper->id]);
    }


}
