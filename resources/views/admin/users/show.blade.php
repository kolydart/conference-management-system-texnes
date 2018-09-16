@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <td field-key='name'>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.email')</th>
                            <td field-key='email'>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.phone')</th>
                            <td field-key='phone'>{{ $user->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.attribute')</th>
                            <td field-key='attribute'>{{ $user->attribute }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>{{ $user->role->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#subscriptions" aria-controls="subscriptions" role="tab" data-toggle="tab">Δηλώσεις συμμετοχής</a></li>
<li role="presentation" class=""><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Κρίσεις</a></li>
<li role="presentation" class=""><a href="#user_actions" aria-controls="user_actions" role="tab" data-toggle="tab">Ενέργειες χρηστών</a></li>
<li role="presentation" class=""><a href="#loguseragent" aria-controls="loguseragent" role="tab" data-toggle="tab">Loguseragent</a></li>
<li role="presentation" class=""><a href="#papers" aria-controls="papers" role="tab" data-toggle="tab">Προτάσεις</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="subscriptions">
<table class="table table-bordered table-striped {{ count($subscriptions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.subscriptions.fields.user')</th>
                        <th>@lang('quickadmin.subscriptions.fields.paper')</th>
                        <th>@lang('quickadmin.subscriptions.fields.appeared')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($subscriptions) > 0)
            @foreach ($subscriptions as $subscription)
                <tr data-entry-id="{{ $subscription->id }}">
                    <td field-key='user'>{{ $subscription->user->name or '' }}</td>
                                <td field-key='paper'>{{ $subscription->paper->title or '' }}</td>
                                <td field-key='appeared'>{{ Form::checkbox("appeared", 1, $subscription->appeared == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('subscription_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.subscriptions.restore', $subscription->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('subscription_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.subscriptions.perma_del', $subscription->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('subscription_view')
                                    <a href="{{ route('admin.subscriptions.show',[$subscription->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('subscription_edit')
                                    <a href="{{ route('admin.subscriptions.edit',[$subscription->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('subscription_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.subscriptions.destroy', $subscription->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="reviews">
<table class="table table-bordered table-striped {{ count($reviews) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.reviews.fields.user')</th>
                        <th>@lang('quickadmin.reviews.fields.paper')</th>
                        <th>@lang('quickadmin.reviews.fields.review')</th>
                        <th>@lang('quickadmin.reviews.fields.comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($reviews) > 0)
            @foreach ($reviews as $review)
                <tr data-entry-id="{{ $review->id }}">
                    <td field-key='user'>{{ $review->user->name or '' }}</td>
                                <td field-key='paper'>{{ $review->paper->title or '' }}</td>
                                <td field-key='review'>{{ $review->review }}</td>
                                <td field-key='comment'>{!! $review->comment !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('review_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.restore', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('review_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.perma_del', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('review_view')
                                    <a href="{{ route('admin.reviews.show',[$review->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('review_edit')
                                    <a href="{{ route('admin.reviews.edit',[$review->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('review_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.destroy', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="user_actions">
<table class="table table-bordered table-striped {{ count($user_actions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.user-actions.created_at')</th>
                        <th>@lang('quickadmin.user-actions.fields.user')</th>
                        <th>@lang('quickadmin.user-actions.fields.action')</th>
                        <th>@lang('quickadmin.user-actions.fields.action-model')</th>
                        <th>@lang('quickadmin.user-actions.fields.action-id')</th>
                        
        </tr>
    </thead>

    <tbody>
        @if (count($user_actions) > 0)
            @foreach ($user_actions as $user_action)
                <tr data-entry-id="{{ $user_action->id }}">
                    <td>{{ $user_action->created_at or '' }}</td>
                                <td field-key='user'>{{ $user_action->user->name or '' }}</td>
                                <td field-key='action'>{{ $user_action->action }}</td>
                                <td field-key='action_model'>{{ $user_action->action_model }}</td>
                                <td field-key='action_id'>{{ $user_action->action_id }}</td>
                                
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="loguseragent">
<table class="table table-bordered table-striped {{ count($loguseragents) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.loguseragent.fields.os')</th>
                        <th>@lang('quickadmin.loguseragent.fields.browser')</th>
                        <th>@lang('quickadmin.loguseragent.fields.device')</th>
                        <th>@lang('quickadmin.loguseragent.fields.item-id')</th>
                        <th>@lang('quickadmin.loguseragent.fields.ipv6')</th>
                        <th>@lang('quickadmin.loguseragent.fields.uri')</th>
                        <th>@lang('quickadmin.loguseragent.fields.user')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($loguseragents) > 0)
            @foreach ($loguseragents as $loguseragent)
                <tr data-entry-id="{{ $loguseragent->id }}">
                    <td field-key='os'>{{ $loguseragent->os }}</td>
                                <td field-key='browser'>{{ $loguseragent->browser }}</td>
                                <td field-key='device'>{{ $loguseragent->device }}</td>
                                <td field-key='item_id'>{{ $loguseragent->item_id }}</td>
                                <td field-key='ipv6'>{!! $loguseragent->ipv6 !!}</td>
                                <td field-key='uri'>{{ $loguseragent->uri }}</td>
                                <td field-key='user'>{{ $loguseragent->user->name or '' }}</td>
                                                                <td>
                                    @can('loguseragent_view')
                                    <a href="{{ route('admin.loguseragents.show',[$loguseragent->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('loguseragent_edit')
                                    <a href="{{ route('admin.loguseragents.edit',[$loguseragent->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('loguseragent_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.loguseragents.destroy', $loguseragent->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="16">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="papers">
<table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th>@lang('quickadmin.papers.fields.type')</th>
                        <th>@lang('quickadmin.papers.fields.duration')</th>
                        <th>@lang('quickadmin.papers.fields.session')</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.attribute')</th>
                        <th>@lang('quickadmin.papers.fields.status')</th>
                        <th>@lang('quickadmin.papers.fields.order')</th>
                        <th>@lang('quickadmin.papers.fields.capacity')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($papers) > 0)
            @foreach ($papers as $paper)
                <tr data-entry-id="{{ $paper->id }}">
                    <td field-key='title'>{{ $paper->title }}</td>
                                <td field-key='art'>
                                    @foreach ($paper->art as $singleArt)
                                        <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='type'>{{ $paper->type }}</td>
                                <td field-key='duration'>{{ $paper->duration }}</td>
                                <td field-key='session'>{{ $paper->session->title or '' }}</td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='attribute'>{{ $paper->attribute }}</td>
                                <td field-key='status'>{{ $paper->status }}</td>
                                <td field-key='order'>{{ $paper->order }}</td>
                                <td field-key='capacity'>{{ $paper->capacity }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('paper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.papers.restore', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('paper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.papers.perma_del', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('paper_view')
                                    <a href="{{ route('admin.papers.show',[$paper->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('paper_edit')
                                    <a href="{{ route('admin.papers.edit',[$paper->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('paper_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.papers.destroy', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="22">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


