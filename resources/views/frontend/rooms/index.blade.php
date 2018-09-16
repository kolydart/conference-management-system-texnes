@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-map-marker-alt"></i> @lang('quickadmin.rooms.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_list')</span>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rooms) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('quickadmin.rooms.fields.title')</th>
                        <th>@lang('quickadmin.rooms.fields.type')</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($rooms) > 0)
                        @foreach ($rooms as $room)
                            <tr data-entry-id="{{ $room->id }}">

                                <td field-key='title'>{{ $room->title }}</td>
                                <td field-key='type'>{{ $room->type }}</td>
                                <td> <a href="{{ route('frontend.rooms.show',[$room->id]) }}" class="btn btn-xs btn-ouline-primary">@lang('quickadmin.qa_view')</a> </td>
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
    </div>
@stop
