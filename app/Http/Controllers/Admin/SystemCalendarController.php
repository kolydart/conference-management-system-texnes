<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use gateweb\common\DateTime;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 
        $resources = Room::select('id','title')->get();

        foreach (\App\Session::all() as $session) { 
           $crudFieldValue = $session->getOriginal('start'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $session->title; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . " " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'end'   => (new DateTime($crudFieldValue))->addTime($session->duration), 
                'url'   => route('admin.sessions.show', $session->id),
                'resourceId' => $session->room_id
           ];
        }

       return view('admin.calendar' , compact('events','resources')); 
    }

}
