@extends('frontend.app')

@section('content')
<h3 class="page-title">
    @lang('quickadmin.arts.title')
</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        @lang('quickadmin.qa_view')
    </div>
    <div class="panel-body table-responsive">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>
                            @lang('quickadmin.arts.fields.title')
                        </th>
                        <td field-key="title">
                            {{ $art->title }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Nav tabs -->
        {{-- <ul class="nav nav-tabs" role="tablist">
            <li class="active" role="presentation">
                <a aria-controls="papers" data-toggle="tab" href="#papers" role="tab">
                    Προτάσεις
                </a>
            </li>
        </ul> --}}
        <!-- Tab panes -->
        {{-- <div class="tab-content">
            <div class="tab-pane active" id="papers" role="tabpanel"> --}}
                <table class="table table-bordered table-striped {{ count($papers) > 0 ? 'datatable' : '' }}">
                    <thead>
                        <tr>
                            <th>
                                @lang('quickadmin.papers.fields.title')
                            </th>
                            <th>
                                @lang('quickadmin.papers.fields.type')
                            </th>
                            <th>
                                @lang('quickadmin.papers.fields.duration')
                            </th>
                            <th>
                                @lang('quickadmin.papers.fields.session')
                            </th>
                            <th>
                                @lang('quickadmin.papers.fields.name')
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($papers) > 0)
                    @foreach ($papers as $paper)
                        <tr data-entry-id="{{ $paper->id }}">
                            <td field-key="title">
                                @if (Gate::allows('paper_view'))
                                <a href="{{ route('frontend.papers.show',[$paper->id]) }}">
                                    {{ $paper->title }}
                                </a>
                                @else
                                    {{ $paper->title }}
                                @endif
                            </td>
                            <td field-key="type">
                                {{ $paper->type }}
                            </td>
                            <td field-key="duration">
                                {{ $paper->duration }}
                            </td>
                            <td field-key="session">
                                @if ($paper->session)
                                <a href="{{route('frontend.sessions.show',$paper->session->id)}}">
                                    {{ "S". $paper->session->id.". ".$paper->session->title }}
                                </a>
                                @endif
                            </td>
                            <td field-key="name">
                                {{ $paper->name }}
                            </td>
                            <td>
                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.papers.show',[$paper->id]) }}">
                                    @lang('quickadmin.qa_view')
                                </a>
                            </td>
                        </tr>
                        @endforeach
                @else
                        <tr>
                            <td colspan="21">
                                @lang('quickadmin.qa_no_entries_in_table')
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            {{-- </div>
        </div> --}}
        <p>
        </p>
        <a class="btn btn-default" href="{{ route('frontend.arts.index') }}">
            @lang('quickadmin.qa_back_to_list')
        </a>
    </div>
</div>
@stop
