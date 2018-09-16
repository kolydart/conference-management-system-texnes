<?php

namespace App\Http\Controllers\Frontend;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of Subscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (! Gate::allows('subscription_access')) {
        //     return abort(401);
        // }


        // if (request('show_deleted') == 1) {
        //     if (! Gate::allows('subscription_delete')) {
        //         return abort(401);
        //     }
        //     $subscriptions = Subscription::onlyTrashed()->get();
        // } else {
        //     $subscriptions = Subscription::all();
        // }

        // return view('admin.subscriptions.index', compact('subscriptions'));
    }


    /**
     * Display Subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // if (! Gate::allows('subscription_view')) {
        //     return abort(401);
        // }
        // $subscription = Subscription::findOrFail($id);

        // return view('admin.subscriptions.show', compact('subscription'));
    }

    

}
