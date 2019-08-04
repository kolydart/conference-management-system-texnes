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
                            <th>@lang('quickadmin.users.fields.checkin')</th>
                            <td field-key='checkin'>{{ $user->checkin }}</td>
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
                        <tr>
                            <th>@lang('Δηλώσεις για εργαστήρια')</th>
                            <td field-key='role'>{{ $user->attend()->count() }}</td>
                            <th>@lang('quickadmin.users.fields.approved')</th>
                            <td field-key='approved'>{{ Form::checkbox("approved", 1, $user->approved == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#proceedings" aria-controls="proceedings" role="tab" data-toggle="tab">Περιεχόμενο για Πρακτικά</a></li>
<li role="presentation" class=""><a href="#attend" aria-controls="attend" role="tab" data-toggle="tab">Δηλώσεις για εργαστήρια</a></li>
<li role="presentation" class=""><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Κρίσεις</a></li>
<li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Μηνύματα</a></li>
<li role="presentation" class=""><a href="#loguseragent" aria-controls="loguseragent" role="tab" data-toggle="tab">Loguseragent</a></li>
<li role="presentation" class=""><a href="#papers" aria-controls="papers" role="tab" data-toggle="tab">Προτάσεις</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="proceedings">
<table class="table table-bordered table-striped {{ count($proceedings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('id')</th>
            <th>@lang('quickadmin.papers.fields.name')</th>
            <th>@lang('quickadmin.papers.fields.title')</th>
            <th>@lang('quickadmin.papers.fields.art')</th>
            <th>@lang('quickadmin.papers.fields.lab-approved')</th>
            @if( request('show_deleted') == 1 )
            <th>&nbsp;</th>
            @else
            <th>&nbsp;</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @if (count($proceedings) > 0)
            @foreach ($proceedings as $paper)
                <tr data-entry-id="{{ $paper->id }}">
                    <td field-key='id'>{{ $paper->id }}</td>
                    <td field-key='name'>{{ $paper->name }}</td>
                    <td field-key='title'>
                        @if (Gate::allows('paper_view'))
                            <a href="{{ route('admin.papers.show',[$paper->id]) }}" >{{ $paper->title }}</a>
                        @else
                            {{ $paper->title }}
                        @endif
                    </td>
                        <td field-key='art'>
                            @foreach ($paper->art as $singleArt)
                                <span class="label label-info label-many">{{ $singleArt->title }}</span>
                            @endforeach
                    </td>
                    <td field-key='lab_approved'>{{ Form::checkbox("lab_approved", 1, $paper->lab_approved == 1 ? true : false, ["disabled"]) }}</td>
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
                <td colspan="32">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>

<div role="tabpanel" class="tab-pane" id="attend">
<table class="table table-bordered table-striped {{ count($attends) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.papers.fields.title')</th>
            <th>@lang('quickadmin.papers.fields.art')</th>
            <th>@lang('quickadmin.papers.fields.type')</th>
            <th>@lang('quickadmin.papers.fields.duration')</th>
            <th>@lang('Date')</th>
            <th>@lang('quickadmin.papers.fields.session')</th>
            <th>@lang('quickadmin.papers.fields.name')</th>
            <th>@lang('quickadmin.papers.fields.attribute')</th>
            <th>@lang('quickadmin.papers.fields.status')</th>
            <th>@lang('quickadmin.papers.fields.capacity')</th>
            <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($attends) > 0)
            @foreach ($attends as $attend)
                <tr data-entry-id="{{ $attend->id }}">
                        <td field-key='title'>
                            @if (Gate::allows('paper_view'))
                                <a href="{{ route('admin.papers.show',[$attend->id]) }}" >{{ $attend->title }}</a>
                            @else
                                {{ $attend->title }}
                            @endif
                        </td>
                        <td field-key='art'>
                            @foreach ($attend->art as $singleArt)
                                <span class="label label-info label-many">{{ $singleArt->title }}</span>
                            @endforeach
                        </td>
                        <td field-key='type'>{{ $attend->type }}</td>
                        <td field-key='duration'>{{ $attend->duration }}</td>
                        <td field-key='date'>{{ (new gateweb\common\DateTime($attend->session->start))->format('D, d M') }}</td>
                        <td field-key='session'><a href="{{route('admin.sessions.show',$attend->session->id)}}">{{ $attend->session->title }}</a> <span class="text-secondary text-muted">[ <i class="fa fa-clock"></i> {{(new gateweb\common\DateTime($attend->session->start))->format('H:i')}}]</span></td>
                        <td field-key='name'>{{ $attend->name }}</td>
                        <td field-key='attribute'>{{ $attend->attribute }}</td>
                        <td field-key='status'>{{ $attend->status }}</td>
                        <td field-key='capacity'>{{ $attend->capacity }}</td>
                        <td>
                            @can('paper_view')
                            <a href="{{ route('admin.papers.show',[$attend->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                            @endcan
                            @if(Gate::allows('attend_delete_backend',[$attend,$user]))
                                <a href='{{route('admin.attends.delete',[$attend,$user])}}' onClick="return confirm('Are you sure?')" class="btn btn-xs btn-danger">@lang('Αφαίρεση από το εργαστήριο')</a>
                            @endif

                        </td>
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
<div role="tabpanel" class="tab-pane" id="reviews">
<table class="table table-bordered table-striped {{ count($reviews) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.papers.fields.title')</th>
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
                    <td field-key='paper'>
                        @if (Gate::allows('paper_view'))
                            <a href="{{ route('admin.papers.show',[$review->paper->id]) }}" >{{ $review->paper->title }}</a>
                        @else
                            {{ $review->paper->title }}
                        @endif                                
                    </td>

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
<div role="tabpanel" class="tab-pane " id="messages">
<table class="table table-bordered table-striped {{ count($messages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.messages.fields.name')</th>
                        <th>@lang('quickadmin.messages.fields.email')</th>
                        <th>@lang('quickadmin.messages.fields.title')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($messages) > 0)
            @foreach ($messages as $message)
                <tr data-entry-id="{{ $message->id }}">
                    <td field-key='name'>{{ $message->name }}</td>
                                <td field-key='email'>{{ $message->email }}</td>
                                <td field-key='title'>{{ $message->title }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('message_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.restore', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('message_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.perma_del', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('message_view')
                                    <a href="{{ route('admin.messages.show',[$message->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('message_edit')
                                    <a href="{{ route('admin.messages.edit',[$message->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('message_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.destroy', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('quickadmin.qa_no_entries_in_table')</td>
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
                        <th>@lang('quickadmin.papers.fields.capacity')</th>
                        <th>@lang('quickadmin.papers.fields.lab-approved')</th>
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
                        <td field-key='title'>
                            @if (Gate::allows('paper_view'))
                                <a href="{{ route('admin.papers.show',[$paper->id]) }}" >{{ $paper->title }}</a>
                            @else
                                {{ $paper->title }}
                            @endif
                        </td>
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
                                <td field-key='capacity'>{{ $paper->capacity }}</td>
                                <td field-key='lab_approved'>{{ Form::checkbox("lab_approved", 1, $paper->lab_approved == 1 ? true : false, ["disabled"]) }}</td>
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
                <td colspan="32">@lang('quickadmin.qa_no_entries_in_table')</td>
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


