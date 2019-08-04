@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('Πρακτικά')</h3>
    @can('paper_create')
    <p>
        <a href="{{ route('admin.papers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('paper_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.papers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.papers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }} @can('paper_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('paper_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>id</th>
                        <th>@lang('quickadmin.papers.fields.name')</th>
                        <th>@lang('quickadmin.papers.fields.title')</th>
                        <th>@lang('quickadmin.papers.fields.art')</th>
                        <th>@lang('quickadmin.papers.fields.user')</th>
                        <th>@lang('Content for proceedings')</th>
                        <th>@lang('Approved')</th>
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
                                @can('paper_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='id'>{{$paper->id}}</td>
                                <td field-key='name'>{{ $paper->name }}</td>
                                <td field-key='title'>
                                    @if (Gate::allows('paper_view'))
                                        <a href="{{ route('admin.papers.show',[$paper->id]) }}" >{{ $paper->title }}</a>
                                    @else
                                        {{ $paper->title }}
                                    @endif
                                </td>
                                <td field-key='art'>
                                    @foreach ($paper->art as $singleArt)
                                        <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                    @endforeach
                                </td>
                                <td field-key='user'>{{ $paper->user->name or '' }}</td>
                                <td field-key='lab_updated'>@if ($paper->description || $paper->fullpapers->count() ) <span class="text-success" style="font-size: 1.2em">✓</span>@endif</td>
                                <td field-key='lab_approved'>@if ($paper->lab_approved) <span class="text-success" style="font-size: 1.2em">✔︎</span>@endif</td>
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
        @can('paper_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.papers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection
