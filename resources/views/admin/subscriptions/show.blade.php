@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.subscriptions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.subscriptions.fields.user')</th>
                            <td field-key='user'>{{ $subscription->user->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.subscriptions.fields.paper')</th>
                            <td field-key='paper'>{{ $subscription->paper->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.subscriptions.fields.appeared')</th>
                            <td field-key='appeared'>{{ Form::checkbox("appeared", 1, $subscription->appeared == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


