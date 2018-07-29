<?php

namespace App\Http\Controllers\Api\V1;

use App\Judgement;
use App\Http\Controllers\Controller;
use App\Http\Resources\Judgement as JudgementResource;
use App\Http\Requests\Admin\StoreJudgementsRequest;
use App\Http\Requests\Admin\UpdateJudgementsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;


class JudgementsController extends Controller
{
    public function index()
    {
        

        return new JudgementResource(Judgement::with(['paper', 'user'])->get());
    }

    public function show($id)
    {
        if (Gate::denies('judgement_view')) {
            return abort(401);
        }

        $judgement = Judgement::with(['paper', 'user'])->findOrFail($id);

        return new JudgementResource($judgement);
    }

    public function store(StoreJudgementsRequest $request)
    {
        if (Gate::denies('judgement_create')) {
            return abort(401);
        }

        $judgement = Judgement::create($request->all());
        
        

        return (new JudgementResource($judgement))
            ->response()
            ->setStatusCode(201);
    }

    public function update(UpdateJudgementsRequest $request, $id)
    {
        if (Gate::denies('judgement_edit')) {
            return abort(401);
        }

        $judgement = Judgement::findOrFail($id);
        $judgement->update($request->all());
        
        
        

        return (new JudgementResource($judgement))
            ->response()
            ->setStatusCode(202);
    }

    public function destroy($id)
    {
        if (Gate::denies('judgement_delete')) {
            return abort(401);
        }

        $judgement = Judgement::findOrFail($id);
        $judgement->delete();

        return response(null, 204);
    }
}
