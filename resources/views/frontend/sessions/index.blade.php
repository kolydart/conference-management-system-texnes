@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="far fa-clock"></i> @lang('quickadmin.sessions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_list')</span>
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($sessions) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('gw.id')</th>
                        <th>@lang('quickadmin.sessions.fields.title')</th>
                        <th>@lang('quickadmin.sessions.fields.room')</th>
                        <th>@lang('Τύπος')</th>
                        <th>@lang('quickadmin.sessions.fields.start')</th>
                        <th>@lang('quickadmin.sessions.fields.duration')</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($sessions) > 0)
                        @foreach ($sessions as $session)
                            <tr data-entry-id="{{ $session->id }}">
                                <td field-key='id'>S{{ $session->id }}</td>
                                <td field-key='title'><a href="{{route('frontend.sessions.show',$session->id)}}">{{$session->title }}</a></td>
                                <td field-key='room'>{{ $session?->room->title or '' }}</td>
                                <td field-key='color'>{{ $session->color->title or '' }}</td>
                                <td field-key='start'>{{ \Carbon\Carbon::parse($session->start)->format('d M, H:i') }}</td>
                                <td field-key='duration'>{{ \Carbon\Carbon::createFromFormat('H:i:s', $session->duration)->diffInMinutes(\Carbon\Carbon::createFromFormat('H:i:s', '00:00:00')) }}'</td>
                                <td> <a href="{{ route('frontend.sessions.show',[$session->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a></td>
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

