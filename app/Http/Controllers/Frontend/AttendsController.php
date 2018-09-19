<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Paper;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use gateweb\common\Presenter;
use gateweb\common\Router;

class AttendsController extends Controller
{

    public function __construct(){
		$this->middleware('auth');
	}


	public function index(){
		$papers = User::findOrFail(Auth::id())->attend()->accepted()->filtered()->get();
		return view('frontend.attends.index',compact('papers'));
	}
	
    public function create($paper_id){

        $paper = Paper::findOrFail($paper_id);
        
        if (Gate::allows('attend_create',$paper)) {
            $paper->attend()->attach(Auth::id());        
            Presenter::message(__('Επιτυχής δήλωση: '). $paper->title,"success");
        } else {
            Presenter::message(__('You are not authorized for this action'),"error");
        }

        return back();
        
    }

    /**
     * delete attend
     * accept 2nd parameter (for admin) to delete another user's attend
     * @param  [type] $id      [description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function delete($paper_id){
        
        $paper = Paper::findOrFail($paper_id);

        if (Gate::allows('attend_delete',$paper)) {
            $paper->attend()->detach(Auth::id());
            Presenter::message(__('Διαγραφή από: '). $paper->title, 'info');
        } else {
            Presenter::message(__('You are not authorized for this action'),"error");
        }
        
        return back();
    }
}
