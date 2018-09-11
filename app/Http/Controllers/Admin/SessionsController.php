<?php

namespace App\Http\Controllers\Admin;

use App\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSessionsRequest;
use App\Http\Requests\Admin\UpdateSessionsRequest;

class SessionsController extends Controller
{
    /**
     * Display a listing of Session.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('session_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('session_delete')) {
                return abort(401);
            }
            $sessions = Session::onlyTrashed()->get();
        } else {
            $sessions = Session::all();
        }

        return view('admin.sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating new Session.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('session_create')) {
            return abort(401);
        }
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $colors = \App\Color::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.sessions.create', compact('rooms', 'colors'));
    }

    /**
     * Store a newly created Session in storage.
     *
     * @param  \App\Http\Requests\StoreSessionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSessionsRequest $request)
    {
        if (! Gate::allows('session_create')) {
            return abort(401);
        }
        $session = Session::create($request->all());



        return redirect()->route('admin.sessions.index');
    }


    /**
     * Show the form for editing Session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('session_edit')) {
            return abort(401);
        }
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $colors = \App\Color::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $session = Session::findOrFail($id);

        return view('admin.sessions.edit', compact('session', 'rooms', 'colors'));
    }

    /**
     * Update Session in storage.
     *
     * @param  \App\Http\Requests\UpdateSessionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSessionsRequest $request, $id)
    {
        if (! Gate::allows('session_edit')) {
            return abort(401);
        }
        $session = Session::findOrFail($id);
        $session->update($request->all());



        return redirect()->route('admin.sessions.index');
    }


    /**
     * Display Session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('session_view')) {
            return abort(401);
        }
        
        $rooms = \App\Room::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $papers = \App\Paper::where('session_id', $id)->orderByRaw('-`order` DESC')->orderByAttribute()->get();
        $colors = \App\Color::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $session = Session::findOrFail($id);

        return view('admin.sessions.show', compact('session', 'papers'));
    }


    /**
     * Remove Session from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('session_delete')) {
            return abort(401);
        }
        $session = Session::findOrFail($id);
        $session->delete();

        return redirect()->route('admin.sessions.index');
    }

    /**
     * Delete all selected Session at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('session_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Session::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Session from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('session_delete')) {
            return abort(401);
        }
        $session = Session::onlyTrashed()->findOrFail($id);
        $session->restore();

        return redirect()->route('admin.sessions.index');
    }

    /**
     * Permanently delete Session from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('session_delete')) {
            return abort(401);
        }
        $session = Session::onlyTrashed()->findOrFail($id);
        $session->forceDelete();

        return redirect()->route('admin.sessions.index');
    }
}
