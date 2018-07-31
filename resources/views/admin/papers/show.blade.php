@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.papers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.papers.fields.title')</th>
                            <td field-key='title'>{{ $paper->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.art')</th>
                            <td field-key='art'>
                                @foreach ($paper->art as $singleArt)
                                    <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.type')</th>
                            <td field-key='type'>{{ $paper->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.duration')</th>
                            <td field-key='duration'>{{ $paper->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.name')</th>
                            <td field-key='name'>{{ $paper->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.email')</th>
                            <td field-key='email'>{{ $paper->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.attribute')</th>
                            <td field-key='attribute'>{{ $paper->attribute }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.document')</th>
                            <td field-key='document's> @foreach($paper->getMedia('document') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.assign')</th>
                            <td field-key='assign'>
                                @foreach ($paper->assign as $singleAssign)
                                    <span class="label label-info label-many">{{ $singleAssign->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.status')</th>
                            <td field-key='status'>{{ $paper->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.informed')</th>
                            <td field-key='informed'>{{ $paper->informed }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.papers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
