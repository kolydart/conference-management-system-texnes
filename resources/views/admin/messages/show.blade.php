@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.messages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.messages.fields.name')</th>
                            <td field-key='name'>{{ $message->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.messages.fields.email')</th>
                            <td field-key='email'>{{ $message->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.messages.fields.title')</th>
                            <td field-key='title'>{{ $message->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.messages.fields.paper')</th>
                            <td field-key='paper'>{{ $message->paper->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.messages.fields.body')</th>
                            <td field-key='body'>{!! $message->body !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.messages.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


