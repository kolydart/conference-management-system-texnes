<?php

namespace App\Http\Controllers\Admin;

use App\Paper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePapersRequest;
use App\Http\Requests\Admin\UpdatePapersRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

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
        if (! Gate::allows('paper_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('paper_delete')) {
                return abort(401);
            }
            $papers = Paper::onlyTrashed()->get();
        } else {
            $papers = Paper::all();
        }

        return view('admin.papers.index', compact('papers'));
    }

    /**
     * Show the form for creating new Paper.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('paper_create')) {
            return abort(401);
        }
        
        $arts = \App\Art::get()->pluck('title', 'id');

        $assigns = \App\User::get()->pluck('name', 'id');


        return view('admin.papers.create', compact('arts', 'assigns'));
    }

    /**
     * Store a newly created Paper in storage.
     *
     * @param  \App\Http\Requests\StorePapersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePapersRequest $request)
    {
        if (! Gate::allows('paper_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $paper = Paper::create($request->all());
        $paper->art()->sync(array_filter((array)$request->input('art')));
        $paper->assign()->sync(array_filter((array)$request->input('assign')));


        foreach ($request->input('document_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $paper->id;
            $file->save();
        }

        return redirect()->route('admin.papers.index');
    }


    /**
     * Show the form for editing Paper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('paper_edit')) {
            return abort(401);
        }
        
        $arts = \App\Art::get()->pluck('title', 'id');

        $assigns = \App\User::get()->pluck('name', 'id');


        $paper = Paper::findOrFail($id);

        return view('admin.papers.edit', compact('paper', 'arts', 'assigns'));
    }

    /**
     * Update Paper in storage.
     *
     * @param  \App\Http\Requests\UpdatePapersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePapersRequest $request, $id)
    {
        if (! Gate::allows('paper_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $paper = Paper::findOrFail($id);
        $paper->update($request->all());
        $paper->art()->sync(array_filter((array)$request->input('art')));
        $paper->assign()->sync(array_filter((array)$request->input('assign')));


        $media = [];
        foreach ($request->input('document_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $paper->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $paper->updateMedia($media, 'document');

        return redirect()->route('admin.papers.index');
    }


    /**
     * Display Paper.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('paper_view')) {
            return abort(401);
        }
        $paper = Paper::findOrFail($id);

        return view('admin.papers.show', compact('paper'));
    }


    /**
     * Remove Paper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('paper_delete')) {
            return abort(401);
        }
        $paper = Paper::findOrFail($id);
        $paper->deletePreservingMedia();

        return redirect()->route('admin.papers.index');
    }

    /**
     * Delete all selected Paper at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('paper_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Paper::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Paper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('paper_delete')) {
            return abort(401);
        }
        $paper = Paper::onlyTrashed()->findOrFail($id);
        $paper->restore();

        return redirect()->route('admin.papers.index');
    }

    /**
     * Permanently delete Paper from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('paper_delete')) {
            return abort(401);
        }
        $paper = Paper::onlyTrashed()->findOrFail($id);
        $paper->forceDelete();

        return redirect()->route('admin.papers.index');
    }
}
