<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
// Removed gateweb dependencies

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 
        $resources = Room::orderBy('title')->select('id','title')->get();

        foreach (\App\Session::all() as $session) { 
           $crudFieldValue = $session->getOriginal('start'); 

           if (! $crudFieldValue) {
               continue;
           }

           $eventLabel     = $session->title; 
           $prefix         = ''; 
           $suffix         = ''; 
           $dataFieldValue = trim($prefix . "S$session->id. " . $eventLabel . " " . $suffix); 
           $events[]       = [ 
                'title' => $dataFieldValue, 
                'start' => $crudFieldValue, 
                'end'   => \Carbon\Carbon::parse($crudFieldValue)->addHours(1)->format('Y-m-d H:i:s'), // Simplified - add 1 hour
                'url'   => route((strpos(\Route::currentRouteName(), 'admin') === 0) ? 'admin.sessions.show' : 'frontend.sessions.show', $session->id),
                'resourceId' => $session->room_id,
                'color' => (isset($session->color))? $session->color->value : '',
           ];
        }

        /**
         * show availability time slots
         */
          foreach (\App\Availability::all() as $slot) {
            $events[] =[
              'title' => $slot->notes, 
              'start' => $slot->start, 
              'end'   => $slot->end, 
              'resourceId' => $slot->room_id,
              'rendering' => 'background',
              'color' => $slot->color->value
            ];
          }

       return view('admin.calendar' , compact('events','resources')); 
    }

}
