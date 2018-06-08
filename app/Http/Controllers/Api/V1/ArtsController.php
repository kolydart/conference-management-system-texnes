<?php

namespace App\Http\Controllers\Api\V1;

use App\Art;
use App\Http\Controllers\Controller;
use App\Http\Resources\Art as ArtResource;
use App\Http\Requests\Admin\StoreArtsRequest;
use App\Http\Requests\Admin\UpdateArtsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;



class ArtsController extends Controller
{
    public function index()
    {
        

        return new ArtResource(Art::with([])->get());
    }

    public function show($id)
    {
        if (Gate::denies('art_view')) {
            return abort(401);
        }

        $art = Art::with([])->findOrFail($id);

        return new ArtResource($art);
    }

    public function store(StoreArtsRequest $request)
    {
        if (Gate::denies('art_create')) {
            return abort(401);
        }

        $art = Art::create($request->all());
        
        

        return (new ArtResource($art))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateArtsRequest $request, $id)
    {
        if (Gate::denies('art_edit')) {
            return abort(401);
        }

        $art = Art::findOrFail($id);
        $art->update($request->all());
        
        
        

        return (new ArtResource($art))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('art_delete')) {
            return abort(401);
        }

        $art = Art::findOrFail($id);
        $art->delete();

        return response(null, 204);
    }
}
