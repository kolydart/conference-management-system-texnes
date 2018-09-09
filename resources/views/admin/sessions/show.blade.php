@extends('layouts.app')

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
                            <td field-key='title'>S{{ $session->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sessions.fields.title')</th>
                            <td field-key='title'>{{ $session->title }}</td>
                        </tr>
                            <th>@lang('quickadmin.sessions.fields.room')</th>
                            <td field-key='room'>{{ $session->room->title or '' }}</td>
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
                        <tr>
                            <th>@lang('Κενό-Πλεόνασμα')</th>
                            <td field-key='remains'>{{ $session->papers->pluck('duration')->sum() - (new gateweb\common\DateTime($session->duration))->get_timeAsDuration('minutes') }}'</td>
                        </tr>                        
                            <th>@lang('quickadmin.sessions.fields.chair')</th>
                            <td field-key='chair'>{{ $session->chair }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<a href="{{route('admin.sessions.edit',$session->id)}}" class="btn btn-info">@lang('quickadmin.qa_edit')</a> <br><br>           
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#papers" aria-controls="papers" role="tab" data-toggle="tab">Προτάσεις</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="papers">
<table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
                        <th>@lang('id')</th>
            <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th>@lang('quickadmin.papers.fields.type')</th>
                        <th>@lang('quickadmin.papers.fields.duration')</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.attribute')</th>
                        <th>@lang('quickadmin.papers.fields.status')</th>
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
                                <td field-key='id'>{{ $paper->id }}</td>
                    <td field-key='title'><a href="{{route('admin.papers.show',$paper->id)}}">{{ $paper->title }}</a></td>
                                <td field-key='art'>
                                    @foreach ($paper->art as $singleArt)
                                        <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='type'>{{ $paper->type }}</td>
                                <td field-key='duration'>{{ $paper->duration }}</td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='attribute'>{{ $paper->attribute }}</td>
                                <td field-key='status'>{{ $paper->status }}</td>
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
                <td colspan="20">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.sessions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
            $('.timepicker').datetimepicker({
                format: "{{ config('app.time_format_moment') }}",
            });
            
        });
    </script>
            
@stop
