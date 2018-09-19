<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Paper;
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
		$papers = Paper::accepted()->filtered()->get(); 
		return view('frontend.attends.index',compact('papers'));
	}
	
    public function create($id){
        if (Auth::check()) {
            $paper = Paper::findOrFail($id);
            $paper->attend()->attach(Auth::id());        
            Presenter::message(__('Δηλώσατε συμμετοχή στο/ή: '). $paper->type. ", ". $paper->title,"success");
            return back();
        } else {
            abort(401,'You are not logged-in.');
        }
        
    }

    /**
     * delete attend
     * accept 2nd parameter (for admin) to delete another user's attend
     * @param  [type] $id      [description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function delete($id){
        if (Auth::check()) {
            $router = new Router();
            if($router->get_var('user_id',false,'int') && Gate::allows('attend_delete')){
                $user_id = $router->get_var('user_id',false,'int');
            }else{
                $user_id = Auth::id();
            }
            $paper = Paper::findOrFail($id);
            $paper->attend()->detach($user_id);        
            Presenter::message(__('Επιτυχής διαγραφή από: '). $paper->type. ", ". $paper->title, 'warning');
            return back();
        } else {
            abort(401,'You are not logged-in.');
        }
        
    }
}
