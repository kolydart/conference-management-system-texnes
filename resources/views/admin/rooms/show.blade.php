@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.rooms.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.title')</th>
                            <td field-key='title'>{{ $room->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.description')</th>
                            <td field-key='description'>{!! $room->description !!}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class=""><a href="#availability" aria-controls="availability" role="tab" data-toggle="tab">Διαθεσιμότητα αιθουσών</a></li>
<li role="presentation" class="active"><a href="#sessions" aria-controls="sessions" role="tab" data-toggle="tab">Συνεδρίες</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane " id="availability">
<table class="table table-bordered table-striped {{ count($availabilities) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            {{-- <th>@lang('quickadmin.availability.fields.room')</th> --}}
                        <th style="width: 30px;">@lang('quickadmin.availability.fields.type')</th>
                        <th>@lang('quickadmin.availability.fields.start')</th>
                        <th>@lang('quickadmin.availability.fields.end')</th>
                        <th>@lang('quickadmin.availability.fields.notes')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($availabilities) > 0)
            @foreach ($availabilities as $availability)
                <tr data-entry-id="{{ $availability->id }}">
                    {{-- <td field-key='room'>{{ $availability->room->title or '' }}</td> --}}
                                <td field-key='type'>{{ $availability->type }}</td>
                                <td field-key='start'>{{ $availability->start }}</td>
                                <td field-key='end'>{{ $availability->end }}</td>
                                <td field-key='notes'>{!! $availability->notes !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('availability_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.availabilities.restore', $availability->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('availability_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.availabilities.perma_del', $availability->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('availability_view')
                                    <a href="{{ route('admin.availabilities.show',[$availability->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('availability_edit')
                                    <a href="{{ route('admin.availabilities.edit',[$availability->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('availability_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.availabilities.destroy', $availability->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane active" id="sessions">
<table class="table table-bordered table-striped {{ count($sessions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.sessions.fields.title')</th>
                        <th>@lang('quickadmin.sessions.fields.room')</th>
                        <th>@lang('quickadmin.sessions.fields.start')</th>
                        <th>@lang('quickadmin.sessions.fields.duration')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($sessions) > 0)
            @foreach ($sessions as $session)
                <tr data-entry-id="{{ $session->id }}">
                    <td field-key='title'>{{ $session->title }}</td>
                                <td field-key='room'>{{ $session->room->title or '' }}</td>
                                <td field-key='start'>{{ $session->start }}</td>
                                <td field-key='duration'>{{ $session->duration }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('session_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.sessions.restore', $session->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('session_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.sessions.perma_del', $session->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('session_view')
                                    <a href="{{ route('admin.sessions.show',[$session->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('session_edit')
                                    <a href="{{ route('admin.sessions.edit',[$session->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('session_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.sessions.destroy', $session->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.rooms.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop
