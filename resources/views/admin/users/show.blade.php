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
                            <th>@lang('quickadmin.users.fields.role')</th>
                            <td field-key='role'>
                                @foreach ($user->role as $singleRole)
                                    <span class="label label-info label-many">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#judgements" aria-controls="judgements" role="tab" data-toggle="tab">Κρίσεις</a></li>
<li role="presentation" class=""><a href="#papers" aria-controls="papers" role="tab" data-toggle="tab">Προτάσεις</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="judgements">
<table class="table table-bordered table-striped {{ count($judgements) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.judgements.fields.user')</th>
                        <th>@lang('quickadmin.judgements.fields.paper')</th>
                        <th>@lang('quickadmin.judgements.fields.judgement')</th>
                        <th>@lang('quickadmin.judgements.fields.comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($judgements) > 0)
            @foreach ($judgements as $judgement)
                <tr data-entry-id="{{ $judgement->id }}">
                    <td field-key='user'>{{ $judgement->user->name or '' }}</td>
                                <td field-key='paper'>{{ $judgement->paper->title or '' }}</td>
                                <td field-key='judgement'>{{ $judgement->judgement }}</td>
                                <td field-key='comment'>{!! $judgement->comment !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['judgements.restore', $judgement->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['judgements.perma_del', $judgement->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('judgements.show',[$judgement->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('judgements.edit',[$judgement->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['judgements.destroy', $judgement->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="papers">
<table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th>@lang('quickadmin.papers.fields.type')</th>
                        <th>@lang('quickadmin.papers.fields.duration')</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.email')</th>
                        <th>@lang('quickadmin.papers.fields.attribute')</th>
                        <th>@lang('quickadmin.papers.fields.assign')</th>
                        <th>@lang('quickadmin.papers.fields.status')</th>
                        <th>@lang('quickadmin.papers.fields.informed')</th>
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
                                        <span class="label label-info label-many">{{ $singleArt->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='type'>{{ $paper->type }}</td>
                                <td field-key='duration'>{{ $paper->duration }}</td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='email'>{{ $paper->email }}</td>
                                <td field-key='attribute'>{{ $paper->attribute }}</td>
                                <td field-key='document'>@if($paper->document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $paper->document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='assign'>
                                    @foreach ($paper->assign as $singleAssign)
                                        <span class="label label-info label-many">{{ $singleAssign->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='status'>{{ $paper->status }}</td>
                                <td field-key='informed'>{{ $paper->informed }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['papers.restore', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['papers.perma_del', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('papers.show',[$paper->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('papers.edit',[$paper->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['papers.destroy', $paper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
