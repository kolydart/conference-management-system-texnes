@inject('request', 'Illuminate\Http\Request')
@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-newspaper"></i> 
        @if ((new gateweb\common\Router())->get_var('type',false,'raw'))
            {{(new gateweb\common\Router())->get_var('type',false,'raw')}}
        @else
            @lang('Εισηγήσεις/Εργαστήρια')
        @endif 
    </h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_list')</span>
        </div>
        
        <div class="panel-body table-responsive">
            @include('frontend.papers.table')
        </div>

    </div>
@stop
