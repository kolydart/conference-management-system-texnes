@extends('frontend.app')

@section('content')
    <h3 class="page-title"><i class="fa fa-map-marker-alt"></i> @lang('Αίθουσα')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
        </div>        

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.title')</th>
                            <td field-key='title'>{{ $room->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.description')</th>
                            <td field-key='description'>{!! $room->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.type')</th>
                            <td field-key='type'>{{ $room->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.rooms.fields.wifi')</th>
                            <td field-key='type'>{{ $room->wifi }}</td>
                        </tr>
                    </table>
                </div>
            </div>

<a href="{{route('frontend.pages.show','map')}}" class="btn btn-primary m-3"><i class="fa fa-map"></i> Χάρτες - πρόσβαση</a>

    
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
            <a href="#papers" class="nav-link active">
                <span class="badge badge-dark">Προτάσεις/Εισηγήσεις</span>
            </a>
            </li>
        </ul>

<!-- Tab panes -->
<div class="tab-content">
<div role="tabpanel" class="tab-pane active" id="papers">
    @include('frontend.papers.table')
</div>
   
</div>

        </div>
    </div>
@stop
