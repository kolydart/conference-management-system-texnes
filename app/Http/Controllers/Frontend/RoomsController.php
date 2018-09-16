<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Paper;
use App\Room;
use Gate;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    /**
     * Display a listing of Room.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('title')->get();

        return view('frontend.rooms.index', compact('rooms'));
    }

    /**
     * Display Room.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $sessions = \App\Session::where('room_id', $id)->get();
        $papers = Room::findOrFail($id)->papers()->accepted()->get();

        $room = Room::findOrFail($id);

        return view('frontend.rooms.show', compact('room', 'sessions', 'papers'));
    }

}
