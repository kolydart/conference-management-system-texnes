<?php

namespace App\Http\Controllers\Admin;

use App\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubscriptionsRequest;
use App\Http\Requests\Admin\UpdateSubscriptionsRequest;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of Subscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subscription_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('subscription_delete')) {
                return abort(401);
            }
            $subscriptions = Subscription::onlyTrashed()->get();
        } else {
            $subscriptions = Subscription::all();
        }

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating new Subscription.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('subscription_create')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $papers = \App\Paper::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.subscriptions.create', compact('users', 'papers'));
    }

    /**
     * Store a newly created Subscription in storage.
     *
     * @param  \App\Http\Requests\StoreSubscriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubscriptionsRequest $request)
    {
        if (! Gate::allows('subscription_create')) {
            return abort(401);
        }
        $subscription = Subscription::create($request->all());



        return redirect()->route('admin.subscriptions.index');
    }


    /**
     * Show the form for editing Subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('subscription_edit')) {
            return abort(401);
        }
        
        $users = \App\User::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $papers = \App\Paper::get()->pluck('title', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $subscription = Subscription::findOrFail($id);

        return view('admin.subscriptions.edit', compact('subscription', 'users', 'papers'));
    }

    /**
     * Update Subscription in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionsRequest $request, $id)
    {
        if (! Gate::allows('subscription_edit')) {
            return abort(401);
        }
        $subscription = Subscription::findOrFail($id);
        $subscription->update($request->all());



        return redirect()->route('admin.subscriptions.index');
    }


    /**
     * Display Subscription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('subscription_view')) {
            return abort(401);
        }
        $subscription = Subscription::findOrFail($id);

        return view('admin.subscriptions.show', compact('subscription'));
    }


    /**
     * Remove Subscription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('subscription_delete')) {
            return abort(401);
        }
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('admin.subscriptions.index');
    }

    /**
     * Delete all selected Subscription at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subscription_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Subscription::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Subscription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('subscription_delete')) {
            return abort(401);
        }
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->restore();

        return redirect()->route('admin.subscriptions.index');
    }

    /**
     * Permanently delete Subscription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('subscription_delete')) {
            return abort(401);
        }
        $subscription = Subscription::onlyTrashed()->findOrFail($id);
        $subscription->forceDelete();

        return redirect()->route('admin.subscriptions.index');
    }
}
