<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Paper;
use App\User;
use Auth;
use Gate;
use Illuminate\Http\Request;
use gateweb\common\DateTime;
use gateweb\common\Presenter;
use gateweb\common\Router;

class AttendsController extends Controller
{

    public function __construct(){
		$this->middleware('auth');
	}

    /**
     * view my attends
     * @return papers
     */
	public function index(){
		$papers = User::findOrFail(Auth::id())->attend()->accepted()->filtered()->get();
        self::checkForConcurrentSessions($papers);
		return view('frontend.attends.index',compact('papers'));
	}

    /**
     * attach $paper to my $user
     * @param  int $paper_id 
     * @return back()
     */
    public function create($paper_id){

        $paper = Paper::findOrFail($paper_id);
        
        Presenter::message(__('Η περίοδος δηλώσεων έχει παρέλθει.'), 'info');
        // if (Gate::allows('attend_create',$paper)) {
        //     $paper->attend()->attach(Auth::id());        
        //     Presenter::message(__('Επιτυχής δήλωση: '). $paper->title,"success");
        // } else {
        //     Presenter::message(__('You are not authorized for this action'),"error");
        // }

        // activity()
        //    ->performedOn($paper)
        //    ->causedBy(Auth::id())
        //    ->log('attend_create');

        return back();
        
    }

    /**
     * delete attend
     * @param  int $paper_id
     * @return back()
     */
    public function delete($paper_id){
        
        $paper = Paper::findOrFail($paper_id);

        Presenter::message(__('Η περίοδος δηλώσεων έχει παρέλθει.'), 'info');
        // if (Gate::allows('attend_delete',$paper)) {
        //     $paper->attend()->detach(Auth::id());
        //     Presenter::message(__('Διαγραφή από: '). $paper->title, 'info');
        // } else {
        //     Presenter::message(__('You are not authorized for this action'),"error");
        // }

        // activity()
        //    ->performedOn($paper)
        //    ->causedBy(Auth::id())
        //    ->log('attend_delete');

        return back();
    }

    /**
     * notify user For Concurrent Sessions
     * @param  eloquent $papers
     * @return void (message)
     */
    public static function checkForConcurrentSessions($papers){

        $duplicates = self::concurrent($papers);

        if($duplicates){
            asort($duplicates);
            $message = "Παρακαλούμε βεβαιωθείτε ότι τα εργαστήρια που επιλέξατε, πραγματοποιούνται διαφορετικές ώρες.<br>Κάποια εργαστήρια, φαίνεται πως περιλαμβάνονται σε συνεδρίες που ξεκινούν την ίδια ώρα:<br>";
            foreach ($duplicates as $id => $date) {
                $p=Paper::findOrFail($id);
                $message .= "<a href=\"".route('frontend.papers.show',$id)."\">$p->title</a> (στη συνεδρία ".$p->session->title." που ξεκινά στις ".(new DateTime($p->session->start))->format('d M, H:i').")<br>";
            }
            Presenter::message($message,'warning');
        }

    }
    

    /**
     * check papers in concurrent Sessions
     * @param  collection $papers
     * @return array['id'=>'date']|false duplicate papers
     */
    public static function concurrent($papers){
        /** array to return */
        $duplicates = [];

        /**
         * create $eloquent (collection)
         * @var array
         */
        $eloquent = [];
        foreach ($papers as $paper) {
            $eloquent[] = [
                'id'=>$paper->id, 
                'session' => $paper->session_id, 
                'date' => $paper->session->start
            ];
        }
        $collection = collect($eloquent);

        /**
         * find duplicates
         * @var duplicates
         */
        foreach ($collection->groupBy('date') as $group){
            /** has duplicates AND session->count() > 1 */
            if($group->count() > 1 && $group->groupBy('session')->count() > 1 ){
                foreach ($group as $item) {
                    $duplicates[$item['id']] = $item['date'];
                }
            }
        }

        return count($duplicates)? $duplicates : false;
    }

}
