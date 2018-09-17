<?php

namespace App\Http\Controllers\Admin;

use App\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreColorsRequest;
use App\Http\Requests\Admin\UpdateColorsRequest;

class ColorsController extends Controller
{
    /**
     * Display a listing of Color.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('color_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('color_delete')) {
                return abort(401);
            }
            $colors = Color::onlyTrashed()->get();
        } else {
            $colors = Color::all();
        }

        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating new Color.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('color_create')) {
            return abort(401);
        }
        return view('admin.colors.create');
    }

    /**
     * Store a newly created Color in storage.
     *
     * @param  \App\Http\Requests\StoreColorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreColorsRequest $request)
    {
        if (! Gate::allows('color_create')) {
            return abort(401);
        }
        $color = Color::create($request->all());



        return redirect()->route('admin.colors.index');
    }


    /**
     * Show the form for editing Color.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('color_edit')) {
            return abort(401);
        }
        $color = Color::findOrFail($id);

        return view('admin.colors.edit', compact('color'));
    }

    /**
     * Update Color in storage.
     *
     * @param  \App\Http\Requests\UpdateColorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateColorsRequest $request, $id)
    {
        if (! Gate::allows('color_edit')) {
            return abort(401);
        }
        $color = Color::findOrFail($id);
        $color->update($request->all());



        return redirect()->route('admin.colors.index');
    }


    /**
     * Display Color.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('color_view')) {
            return abort(401);
        }
        $availabilities = \App\Availability::where('color_id', $id)->get();$sessions = \App\Session::where('color_id', $id)->get();

        $color = Color::findOrFail($id);

        return view('admin.colors.show', compact('color', 'availabilities', 'sessions'));
    }


    /**
     * Remove Color from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        $color = Color::findOrFail($id);
        $color->delete();

        return redirect()->route('admin.colors.index');
    }

    /**
     * Delete all selected Color at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Color::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Color from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        $color = Color::onlyTrashed()->findOrFail($id);
        $color->restore();

        return redirect()->route('admin.colors.index');
    }

    /**
     * Permanently delete Color from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('color_delete')) {
            return abort(401);
        }
        $color = Color::onlyTrashed()->findOrFail($id);
        $color->forceDelete();

        return redirect()->route('admin.colors.index');
    }
}
