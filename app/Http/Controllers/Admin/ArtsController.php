<?php

namespace App\Http\Controllers\Admin;

use App\Art;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreArtsRequest;
use App\Http\Requests\Admin\UpdateArtsRequest;

class ArtsController extends Controller
{
    /**
     * Display a listing of Art.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('art_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('art_delete')) {
                return abort(401);
            }
            $arts = Art::onlyTrashed()->get();
        } else {
            $arts = Art::all();
        }

        return view('admin.arts.index', compact('arts'));
    }

    /**
     * Show the form for creating new Art.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('art_create')) {
            return abort(401);
        }
        return view('admin.arts.create');
    }

    /**
     * Store a newly created Art in storage.
     *
     * @param  \App\Http\Requests\StoreArtsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtsRequest $request)
    {
        if (! Gate::allows('art_create')) {
            return abort(401);
        }
        $art = Art::create($request->all());



        return redirect()->route('admin.arts.index');
    }


    /**
     * Show the form for editing Art.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('art_edit')) {
            return abort(401);
        }
        $art = Art::findOrFail($id);

        return view('admin.arts.edit', compact('art'));
    }

    /**
     * Update Art in storage.
     *
     * @param  \App\Http\Requests\UpdateArtsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtsRequest $request, $id)
    {
        if (! Gate::allows('art_edit')) {
            return abort(401);
        }
        $art = Art::findOrFail($id);
        $art->update($request->all());



        return redirect()->route('admin.arts.index');
    }


    /**
     * Display Art.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('art_view')) {
            return abort(401);
        }
        $papers = \App\Paper::whereHas('art',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $art = Art::findOrFail($id);

        return view('admin.arts.show', compact('art', 'papers'));
    }


    /**
     * Remove Art from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('art_delete')) {
            return abort(401);
        }
        $art = Art::findOrFail($id);
        $art->delete();

        return redirect()->route('admin.arts.index');
    }

    /**
     * Delete all selected Art at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('art_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Art::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Art from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('art_delete')) {
            return abort(401);
        }
        $art = Art::onlyTrashed()->findOrFail($id);
        $art->restore();

        return redirect()->route('admin.arts.index');
    }

    /**
     * Permanently delete Art from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('art_delete')) {
            return abort(401);
        }
        $art = Art::onlyTrashed()->findOrFail($id);
        $art->forceDelete();

        return redirect()->route('admin.arts.index');
    }
}
