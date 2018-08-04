<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public function index() 
    {
        $events = []; 

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
                'url'   => route('admin.sessions.edit', $session->id)
           ]; 
        } 


       return view('admin.calendar' , compact('events')); 
    }

}
