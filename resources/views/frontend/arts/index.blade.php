@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-paint-brush"></i> @lang('quickadmin.arts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_list')</span>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($arts) > 0 ? 'datatable' : '' }} ">
                <thead>
                    <tr>
                        <th>@lang('quickadmin.arts.fields.title')</th>
                        <th></th>
                    </tr>

                </thead>
                
                <tbody>
                    @if (count($arts) > 0)
                        @foreach ($arts as $art)
                            <tr data-entry-id="{{ $art->id }}">
                                <td field-key='title'>{{ $art->title }}</td>
                                <td> <a href="{{ route('frontend.arts.show',[$art->id]) }}" class="btn btn-xs btn-outline-primary">@lang('quickadmin.qa_view')</a> </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
