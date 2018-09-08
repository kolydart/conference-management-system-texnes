<?php

namespace App\Http\Controllers\Admin;

use App\Availability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAvailabilitiesRequest;
use App\Http\Requests\Admin\UpdateAvailabilitiesRequest;

class AvailabilitiesController extends Controller
{
    /**
     * Display a listing of Availability.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('availability_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('availability_delete')) {
                return abort(401);
            }
            $availabilities = Availability::onlyTrashed()->get();
        } else {
            $availabilities = Availability::orderBy('start')->get();
        }

        return view('admin.availabilities.index', compact('availabilities'));
    }

    /**
     * Show the form for creating new Availability.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('availability_create')) {
            return abort(401);
        }
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.availabilities.create', compact('rooms'));
    }

    /**
     * Store a newly created Availability in storage.
     *
     * @param  \App\Http\Requests\StoreAvailabilitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAvailabilitiesRequest $request)
    {
        if (! Gate::allows('availability_create')) {
            return abort(401);
        }
        $availability = Availability::create($request->all());



        return redirect()->route('admin.availabilities.index');
    }


    /**
     * Show the form for editing Availability.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('availability_edit')) {
            return abort(401);
        }
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $availability = Availability::findOrFail($id);

        return view('admin.availabilities.edit', compact('availability', 'rooms'));
    }

    /**
     * Update Availability in storage.
     *
     * @param  \App\Http\Requests\UpdateAvailabilitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAvailabilitiesRequest $request, $id)
    {
        if (! Gate::allows('availability_edit')) {
            return abort(401);
        }
        $availability = Availability::findOrFail($id);
        $availability->update($request->all());



        return redirect()->route('admin.availabilities.index');
    }


    /**
     * Display Availability.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('availability_view')) {
            return abort(401);
        }
        $availability = Availability::findOrFail($id);

        return view('admin.availabilities.show', compact('availability'));
    }


    /**
     * Remove Availability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('availability_delete')) {
            return abort(401);
        }
        $availability = Availability::findOrFail($id);
        $availability->delete();

        return redirect()->route('admin.availabilities.index');
    }

    /**
     * Delete all selected Availability at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('availability_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Availability::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Availability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('availability_delete')) {
            return abort(401);
        }
        $availability = Availability::onlyTrashed()->findOrFail($id);
        $availability->restore();

        return redirect()->route('admin.availabilities.index');
    }

    /**
     * Permanently delete Availability from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('availability_delete')) {
            return abort(401);
        }
        $availability = Availability::onlyTrashed()->findOrFail($id);
        $availability->forceDelete();

        return redirect()->route('admin.availabilities.index');
    }
}
