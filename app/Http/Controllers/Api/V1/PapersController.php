<?php

namespace App\Http\Controllers\Api\V1;

use App\Paper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePapersRequest;
use App\Http\Requests\Admin\UpdatePapersRequest;

class PapersController extends Controller
{
    public function index()
    {
        return Paper::all();
    }

    public function show($id)
    {
        return Paper::findOrFail($id);
    }

    public function update(UpdatePapersRequest $request, $id)
    {
        $paper = Paper::findOrFail($id);
        $paper->update($request->all());
        

        return $paper;
    }

    public function store(StorePapersRequest $request)
    {
        $paper = Paper::create($request->all());
        

        return $paper;
    }

    public function destroy($id)
    {
        $paper = Paper::findOrFail($id);
        $paper->delete();
        return '';
    }
}
