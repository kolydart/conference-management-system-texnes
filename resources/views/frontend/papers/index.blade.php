@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.papers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
                <thead>
                    <tr>
                        <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.type')</th>
                        <th>@lang('quickadmin.papers.fields.session')</th>
                        <th>@lang('Room')</th>
                        <th>@lang('Date')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th></th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($papers) > 0)
                        @foreach ($papers as $paper)
                            <tr data-entry-id="{{ $paper->id }}">

                                <td field-key='title'>
                                    @if (Gate::allows('paper_view'))
                                        <a href="{{ route('frontend.papers.show',[$paper->id]) }}" >{{ $paper->title }}</a>
                                    @else
                                        {{ $paper->title }}
                                    @endif
                                </td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='type'>{{ $paper->type }}</td>
                                <td field-key='session'>
                                    @if ($paper->session)
                                        <a href="{{route('frontend.sessions.show',$paper->session->id)}}">{{ "S". $paper->session->id.". ".$paper->session->title }}</a>
                                    @endif
                                </td>
                                <td field-key='room'>
                                    @if ($paper->session)
                                        <a href="{{route('frontend.rooms.show',$paper->session->room->id)}}">{{ $paper->session->room->title or '' }}</a>    
                                    @endif
                                    
                                </td>
                                <td field-key='date'>
                                    @if ($paper->session)
                                        {{ (new gateweb\common\DateTime($paper->session->start))->format('d/m/Y') }}
                                    @endif
                                </td>
                                
                                <td field-key='art'>
                                    @foreach ($paper->art as $singleArt)
                                        <a href="{{route('frontend.arts.show',$singleArt->id)}}">{{ $singleArt->title }}</a>
                                    @endforeach
                                </td>
                                <td field-key='duration'>{{ $paper->duration }}</td>
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
@stop
