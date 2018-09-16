@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-map-marker-alt"></i> @lang('Αίθουσα')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
        </div>        

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.title')</th>
                            <td field-key='title'>{{ $room->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.description')</th>
                            <td field-key='description'>{!! $room->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.type')</th>
                            <td field-key='type'>{{ $room->type }}</td>
                        </tr>
                    </table>
                </div>
            </div>

<a href="{{route('frontend.pages.show','map')}}" class="btn btn-primary m-3"><i class="fa fa-map"></i> Χάρτες - πρόσβαση</a>

    
        <!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#sessions" aria-controls="sessions" role="tab" data-toggle="tab"><span class="badge badge-dark">Συνεδρίες</span></a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="sessions">
<table class="table table-bordered table-striped {{ count($sessions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.sessions.fields.title')</th>
            <th>@lang('quickadmin.sessions.fields.room')</th>
            <th>@lang('quickadmin.sessions.fields.start')</th>
            <th>@lang('quickadmin.sessions.fields.duration')</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @if (count($sessions) > 0)
            @foreach ($sessions as $session)
                <tr data-entry-id="{{ $session->id }}">
                    <td field-key='title'><a href="{{route('frontend.sessions.show',$session->id)}}">{{ "S". $session->id.". ".$session->title }}</a></td>
                    <td field-key='room'>{{ $session->room->title or '' }}</td>
                    <td field-key='start'>{{ $session->start }}</td>
                    <td field-key='duration'>{{ $session->duration }}</td>
                    <td> <a href="{{ route('frontend.sessions.show',[$session->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a> </td>
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

            <p>&nbsp;</p>

            <a href="{{ route('frontend.rooms.index') }}" class="btn btn-outline-info">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
