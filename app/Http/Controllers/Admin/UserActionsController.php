<?php

namespace App\Http\Controllers\Admin;

use App\UserAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserActionsRequest;
use App\Http\Requests\Admin\UpdateUserActionsRequest;
use Yajra\DataTables\DataTables;

class UserActionsController extends Controller
{
    /**
     * Display a listing of UserAction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('user_action_access')) {
            return abort(401);
        }


        
        if (request()->ajax()) {
            $query = UserAction::query();
            $query->with("user");
            $template = 'actionsTemplate';
            
            $query->select([
                'user_actions.id',
                'user_actions.user_id',
                'user_actions.action',
                'user_actions.action_model',
                'user_actions.action_id',
            ]);
            $table = Datatables::of($query);

            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);
            $table->addColumn('massDelete', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            $table->editColumn('actions', function ($row) use ($template) {
                $gateKey  = 'user_action_';
                $routeKey = 'admin.user_actions';

                return view($template, compact('row', 'gateKey', 'routeKey'));
            });
            $table->editColumn('user.name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->editColumn('action_model', function ($row) {
                return $row->action_model ? $row->action_model : '';
            });
            $table->editColumn('action_id', function ($row) {
                return $row->action_id ? $row->action_id : '';
            });

            $table->rawColumns(['actions','massDelete']);

            return $table->make(true);
        }

        return view('admin.user_actions.index');
    }
}
