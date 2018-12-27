@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.fullpaper.title')</h3>
    @can('fullpaper_create')
    <p>
        <a href="{{ route('admin.fullpapers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('fullpaper_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.fullpapers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.fullpapers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($fullpapers) > 0 ? 'datatable' : '' }} @can('fullpaper_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('fullpaper_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.fullpaper.fields.paper')</th>
                        <th>@lang('quickadmin.fullpaper.fields.finaltext')</th>
                        <th>@lang('quickadmin.fullpaper.fields.description')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($fullpapers) > 0)
                        @foreach ($fullpapers as $fullpaper)
                            <tr data-entry-id="{{ $fullpaper->id }}">
                                @can('fullpaper_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='paper'>
                                    @if (Gate::allows('paper_view') && $fullpaper->paper)
                                        <a href="{{ route('admin.papers.show',[$fullpaper->paper->id]) }}" >{{ $fullpaper->paper->title }}</a>
                                    @else
                                        {{ $fullpaper->paper->title }}
                                    @endif
                                </td>
                                <td field-key='finaltext'> @foreach($fullpaper->getMedia('finaltext') as $media)
                                <p class="form-group">
                                    <a href="{{ "/storage/".$media->id."/".rawurlencode($media->file_name) }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                                <td field-key='description'>{{ $fullpaper->description }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('fullpaper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.restore', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('fullpaper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.perma_del', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('fullpaper_view')
                                    <a href="{{ route('admin.fullpapers.show',[$fullpaper->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('fullpaper_edit')
                                    <a href="{{ route('admin.fullpapers.edit',[$fullpaper->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('fullpaper_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.destroy', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('fullpaper_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.fullpapers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection