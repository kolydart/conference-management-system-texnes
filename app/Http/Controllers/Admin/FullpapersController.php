<?php

namespace App\Http\Controllers\Admin;

use App\Fullpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFullpapersRequest;
use App\Http\Requests\Admin\UpdateFullpapersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

class FullpapersController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Fullpaper.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('fullpaper_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('fullpaper_delete')) {
                return abort(401);
            }
            $fullpapers = Fullpaper::onlyTrashed()->get();
        } else {
            $fullpapers = Fullpaper::all();
        }

        return view('admin.fullpapers.index', compact('fullpapers'));
    }

    /**
     * Show the form for creating new Fullpaper.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('fullpaper_create')) {
            return abort(401);
        }
        
        $papers = \App\Paper::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.fullpapers.create', compact('papers'));
    }

    /**
     * Store a newly created Fullpaper in storage.
     *
     * @param  \App\Http\Requests\StoreFullpapersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFullpapersRequest $request)
    {
        if (! Gate::allows('fullpaper_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $fullpaper = Fullpaper::create($request->all());


        foreach ($request->input('finaltext_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $fullpaper->id;
            $file->save();
        }

        return redirect()->route('admin.fullpapers.index');
    }


    /**
     * Show the form for editing Fullpaper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('fullpaper_edit')) {
            return abort(401);
        }
        
        $papers = \App\Paper::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $fullpaper = Fullpaper::findOrFail($id);

        return view('admin.fullpapers.edit', compact('fullpaper', 'papers'));
    }

    /**
     * Update Fullpaper in storage.
     *
     * @param  \App\Http\Requests\UpdateFullpapersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFullpapersRequest $request, $id)
    {
        if (! Gate::allows('fullpaper_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $fullpaper = Fullpaper::findOrFail($id);
        $fullpaper->update($request->all());


        $media = [];
        foreach ($request->input('finaltext_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $fullpaper->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $fullpaper->updateMedia($media, 'finaltext');

        return redirect()->route('admin.fullpapers.index');
    }


    /**
     * Display Fullpaper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('fullpaper_view')) {
            return abort(401);
        }
        $fullpaper = Fullpaper::findOrFail($id);

        return view('admin.fullpapers.show', compact('fullpaper'));
    }


    /**
     * Remove Fullpaper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('fullpaper_delete')) {
            return abort(401);
        }
        $fullpaper = Fullpaper::findOrFail($id);
        $fullpaper->deletePreservingMedia();

        return redirect()->route('admin.fullpapers.index');
    }

    /**
     * Delete all selected Fullpaper at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('fullpaper_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Fullpaper::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Fullpaper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('fullpaper_delete')) {
            return abort(401);
        }
        $fullpaper = Fullpaper::onlyTrashed()->findOrFail($id);
        $fullpaper->restore();

        return redirect()->route('admin.fullpapers.index');
    }

    /**
     * Permanently delete Fullpaper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('fullpaper_delete')) {
            return abort(401);
        }
        $fullpaper = Fullpaper::onlyTrashed()->findOrFail($id);
        $fullpaper->forceDelete();

        return redirect()->route('admin.fullpapers.index');
    }
}
