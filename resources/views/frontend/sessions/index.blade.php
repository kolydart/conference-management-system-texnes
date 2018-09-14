@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sessions.title')</h3>
    @can('session_create')
    <p>
        <a href="{{ route('frontend.sessions.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('session_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('frontend.sessions.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('frontend.sessions.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($sessions) > 0 ? 'datatable' : '' }} @can('session_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('session_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('gw.id')</th>
                        <th>@lang('quickadmin.sessions.fields.title')</th>
                        <th>@lang('quickadmin.sessions.fields.room')</th>
                        <th>@lang('quickadmin.sessions.fields.start')</th>
                        <th>@lang('quickadmin.sessions.fields.duration')</th>
                        <th>@lang('Κενό-Πλεόνασμα')</th>
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
                                @can('session_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='id'>S{{ $session->id }}</td>
                                <td field-key='title'><a href="{{route('frontend.sessions.show',$session->id)}}">{{$session->title }}</a></td>
                                <td field-key='room'>{{ $session->room->title or '' }}</td>
                                <td field-key='start'>{{ $session->start }}</td>
                                <td field-key='duration'>{{ (new gateweb\common\DateTime($session->duration))->get_timeAsDuration('minutes') }}'</td>
                                <td field-key='remains'>{{ $session->papers->pluck('duration')->sum() - (new gateweb\common\DateTime($session->duration))->get_timeAsDuration('minutes') }}'</td>
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
                                    <a href="{{ route('frontend.sessions.show',[$session->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('session_edit')
                                    <a href="{{ route('frontend.sessions.edit',[$session->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
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
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('session_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('frontend.sessions.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection