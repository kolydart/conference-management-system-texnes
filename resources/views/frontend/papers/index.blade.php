@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-newspaper"></i> 
        @if (request()->get('type'))
            {{ request()->get('type') }}
        @else
            @lang('Εισηγήσεις/Εργαστήρια')
        @endif 
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_list')</span>
        </div>
        
        <div class="panel-body">
            @include('frontend.papers.table')
        </div>

    </div>
@stop
