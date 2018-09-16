@extends('frontend.app')

@section('content')
<h3 class="page-title">
    <i class="fa fa-paint-brush"></i> @lang('Τέχνη')
</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
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
                            <h4>{{ $art->title }}</h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li class="active" role="presentation">
                <a aria-controls="papers" data-toggle="tab" href="#papers" role="tab">
                    <span class="badge badge-dark">Εισηγήσεις/Εργαστήρια</span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="papers" role="tabpanel">
                @include('frontend.papers.table')
            </div>
        </div>
        <p>
        </p>
        <a class="btn btn-outline-info" href="{{ route('frontend.arts.index') }}">
            @lang('quickadmin.qa_back_to_list')
        </a>
    </div>
</div>
@stop
