<?php

namespace App\Http\Controllers\Admin;

use App\ContentTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentTagsRequest;
use App\Http\Requests\Admin\UpdateContentTagsRequest;

class ContentTagsController extends Controller
{
    /**
     * Display a listing of ContentTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {if ($_GATES_$) {
            return abort(401);
        }


                $content_tags = ContentTag::all();

        return view('admin.content_tags.index', compact('content_tags'));
    }

    /**
     * Show the form for creating new ContentTag.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {if ($_GATES_$) {
            return abort(401);
        }
        return view('admin.content_tags.create');
    }

    /**
     * Store a newly created ContentTag in storage.
     *
     * @param  \App\Http\Requests\StoreContentTagsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContentTagsRequest $request)
    {if ($_GATES_$) {
            return abort(401);
        }
        $content_tag = ContentTag::create($request->all());



        return redirect()->route('admin.content_tags.index');
    }


    /**
     * Show the form for editing ContentTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {if ($_GATES_$) {
            return abort(401);
        }
        $content_tag = ContentTag::findOrFail($id);

        return view('admin.content_tags.edit', compact('content_tag'));
    }

    /**
     * Update ContentTag in storage.
     *
     * @param  \App\Http\Requests\UpdateContentTagsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContentTagsRequest $request, $id)
    {if ($_GATES_$) {
            return abort(401);
        }
        $content_tag = ContentTag::findOrFail($id);
        $content_tag->update($request->all());



        return redirect()->route('admin.content_tags.index');
    }


    /**
     * Display ContentTag.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {if ($_GATES_$) {
            return abort(401);
        }
        $content_tag = ContentTag::findOrFail($id);

        return view('admin.content_tags.show', compact('content_tag'));
    }


    /**
     * Remove ContentTag from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {if ($_GATES_$) {
            return abort(401);
        }
        $content_tag = ContentTag::findOrFail($id);
        $content_tag->delete();

        return redirect()->route('admin.content_tags.index');
    }

    /**
     * Delete all selected ContentTag at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {if ($_GATES_$) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ContentTag::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
