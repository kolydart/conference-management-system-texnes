<?php

namespace App\Http\Controllers\Api\V1;

use App\Paper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Paper as PaperResource;
use App\Http\Requests\Admin\StorePapersRequest;
use App\Http\Requests\Admin\UpdatePapersRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\Traits\FileUploadTrait;


class PapersController extends Controller
{
    public function index()
    {
        

        return new PaperResource(Paper::with(['art', 'assign'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('paper_view')) {
            return abort(401);
        }

        $paper = Paper::with(['art', 'assign'])->findOrFail($id);

        return new PaperResource($paper);
    }

    public function store(StorePapersRequest $request)
    {
        if (Gate::denies('paper_create')) {
            return abort(401);
        }

        $paper = Paper::create($request->all());
        $paper->art()->sync($request->input('art', []));
        $paper->assign()->sync($request->input('assign', []));
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $key => $file) {
                $paper->addMedia($file)->toMediaCollection('document');
            }
        }

        return (new PaperResource($paper))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdatePapersRequest $request, $id)
    {
        if (Gate::denies('paper_edit')) {
            return abort(401);
        }

        $paper = Paper::findOrFail($id);
        $paper->update($request->all());
        $paper->art()->sync($request->input('art', []));
        $paper->assign()->sync($request->input('assign', []));
        $filesInfo = explode(',', $request->input('uploaded_document'));
        foreach ($paper->getMedia('document') as $file) {
            if (! in_array($file->id, $filesInfo)) {
                $file->delete();
            }
        }
        if ($request->hasFile('document')) {
            foreach ($request->file('document') as $key => $file) {
                $paper->addMedia($file)->toMediaCollection('document');
            }
        }

        return (new PaperResource($paper))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('paper_delete')) {
            return abort(401);
        }

        $paper = Paper::findOrFail($id);
        $paper->delete();

        return response(null, 204);
    }
}
