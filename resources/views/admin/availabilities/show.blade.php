@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.availability.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.availability.fields.type')</th>
                            <td field-key='type'>{{ $availability->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.availability.fields.start')</th>
                            <td field-key='start'>{{ $availability->start }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.availability.fields.end')</th>
                            <td field-key='end'>{{ $availability->end }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.availability.fields.notes')</th>
                            <td field-key='notes'>{!! $availability->notes !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.availability.fields.room')</th>
                            <td field-key='room'>{{ $availability->room->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.availabilities.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
            
        });
    </script>
            
@stop
