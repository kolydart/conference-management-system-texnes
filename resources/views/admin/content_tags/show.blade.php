@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.content-tags.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.content-tags.fields.title')</th>
                            <td field-key='title'>{{ $content_tag->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-tags.fields.slug')</th>
                            <td field-key='slug'>{{ $content_tag->slug }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.content_tags.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
