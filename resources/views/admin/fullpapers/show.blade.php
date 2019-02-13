@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.fullpaper.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.fullpaper.fields.paper')</th>
                            <td field-key='paper'>
                                @if (Gate::allows('paper_view') && $fullpaper->paper)
                                    <a href="{{ route('admin.papers.show',[$fullpaper->paper->id]) }}" >{{ $fullpaper->paper->title }}</a>
                                @else
                                    {{ $fullpaper->paper->title }}
                                @endif
                            </td>

                        </tr>
                        <tr>
                            <th>@lang('quickadmin.fullpaper.fields.finaltext')</th>
                            <td field-key='finaltext's> @foreach($fullpaper->getMedia('finaltext') as $media)
                                <p class="form-group">
                                    <a href="{{ "/storage/".$media->id."/".rawurlencode($media->file_name) }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.fullpaper.fields.description')</th>
                            <td field-key='description'>{{ $fullpaper->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.art')</th>
                            <td field-key='art'>
                                @foreach ($fullpaper->paper->art as $singleArt)
                                    <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                @endforeach
                            </td>                            
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.fullpaper.fields.uuid')</th>
                            <td field-key='uuid'>{{ $fullpaper->uuid }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.fullpapers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop


