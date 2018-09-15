@extends('frontend.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sessions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('gw.id')</th>
                            <td field-key='id'>S{{ $session->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sessions.fields.title')</th>
                            <td field-key='title'>{{ $session->title }}</td>
                        </tr>
                            <th>@lang('quickadmin.sessions.fields.room')</th>
                            <td field-key='room'>
                                @if (isset($session->room))
                                    <a href="{{route('frontend.rooms.show',$session->room->id)}}">{{ $session->room->title or '' }}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sessions.fields.start')</th>
                            <td field-key='start'>{{ $session->start }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sessions.fields.duration')</th>
                            <td field-key='duration'>{{ (new gateweb\common\DateTime($session->duration))->get_timeAsDuration('minutes') }}'</td>
                        </tr>
                        <tr>                        
                            <th>@lang('quickadmin.sessions.fields.chair')</th>
                            <td field-key='chair'>{{ $session->chair }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->

<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#papers" aria-controls="papers" role="tab" data-toggle="tab">Προτάσεις</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="papers">
<table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.papers.fields.title')</th>
            <th>@lang('quickadmin.papers.fields.name')</th>
            <th>@lang('quickadmin.papers.fields.type')</th>
            <th>@lang('quickadmin.papers.fields.art')</th>
            <th>@lang('quickadmin.papers.fields.duration')</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @if (count($papers) > 0)
            @foreach ($papers as $paper)
                <tr data-entry-id="{{ $paper->id }}">
                    <td field-key='title'><a href="{{route('frontend.papers.show',$paper->id)}}">{{ $paper->title }}</a></td>
                    <td field-key='name'>{{ $paper->name }}</td>
                    <td field-key='type'>{{ $paper->type }}</td>
                    <td field-key='art'>
                        @foreach ($paper->art as $singleArt)
                            <span class="label label-info label-many">{{ $singleArt->title }}</span>
                        @endforeach
                    </td>
                    <td field-key='duration'>{{ $paper->duration }}</td>
                    <td> <a href="{{ route('frontend.papers.show',[$paper->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a> </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="21">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('frontend.sessions.index') }}" class="btn btn-outline-info">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

