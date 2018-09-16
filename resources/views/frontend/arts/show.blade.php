@extends('frontend.app')

@section('content')
<h3 class="page-title">
    <i class="fa fa-paint-brush"></i> @lang('Τέχνη')
</h3>
<div class="panel panel-default">
    <div class="panel-heading">
        <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
    </div>        

    <div class="panel-body">
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
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#papers" class="nav-link active">
                    <span class="badge badge-dark">Εισηγήσεις/Εργαστήρια</span>
                </a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="papers">
                @include('frontend.papers.table')
            </div>
        </div>
        <p>
        </p>
    </div>
</div>
@stop
