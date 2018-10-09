<?php

namespace App\Http\Controllers\Admin;

use App\Lunch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLunchesRequest;
use App\Http\Requests\Admin\UpdateLunchesRequest;

class LunchesController extends Controller
{
    /**
     * Display a listing of Lunch.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('lunch_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('lunch_delete')) {
                return abort(401);
            }
            $lunches = Lunch::onlyTrashed()->get();
        } else {
            $lunches = Lunch::all();
        }

        return view('admin.lunches.index', compact('lunches'));
    }

    /**
     * Show the form for creating new Lunch.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('lunch_create')) {
            return abort(401);
        }
        return view('admin.lunches.create');
    }

    /**
     * Store a newly created Lunch in storage.
     *
     * @param  \App\Http\Requests\StoreLunchesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLunchesRequest $request)
    {
        if (! Gate::allows('lunch_create')) {
            return abort(401);
        }
        $lunch = Lunch::create($request->all());



        return redirect()->route('admin.lunches.index');
    }


    /**
     * Show the form for editing Lunch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('lunch_edit')) {
            return abort(401);
        }
        $lunch = Lunch::findOrFail($id);

        return view('admin.lunches.edit', compact('lunch'));
    }

    /**
     * Update Lunch in storage.
     *
     * @param  \App\Http\Requests\UpdateLunchesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLunchesRequest $request, $id)
    {
        if (! Gate::allows('lunch_edit')) {
            return abort(401);
        }
        $lunch = Lunch::findOrFail($id);
        $lunch->update($request->all());



        return redirect()->route('admin.lunches.index');
    }


    /**
     * Display Lunch.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('lunch_view')) {
            return abort(401);
        }
        $lunch = Lunch::findOrFail($id);

        return view('admin.lunches.show', compact('lunch'));
    }


    /**
     * Remove Lunch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('lunch_delete')) {
            return abort(401);
        }
        $lunch = Lunch::findOrFail($id);
        $lunch->delete();

        return redirect()->route('admin.lunches.index');
    }

    /**
     * Delete all selected Lunch at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('lunch_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Lunch::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Lunch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('lunch_delete')) {
            return abort(401);
        }
        $lunch = Lunch::onlyTrashed()->findOrFail($id);
        $lunch->restore();

        return redirect()->route('admin.lunches.index');
    }

    /**
     * Permanently delete Lunch from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('lunch_delete')) {
            return abort(401);
        }
        $lunch = Lunch::onlyTrashed()->findOrFail($id);
        $lunch->forceDelete();

        return redirect()->route('admin.lunches.index');
    }
}
