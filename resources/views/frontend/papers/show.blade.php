@extends('frontend.app')

@section('content')
    <h3 class="page-title mb-3"> <i class="fa fa-newspaper"></i> {{$paper->type}}</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
        </div>        

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.papers.fields.title')</th>
                            <td field-key='title'><strong>{{ $paper->title }}</strong></td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.name')</th>
                            <td field-key='name'>{{ $paper->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.session')</th>
                            <td field-key='session'>
                                @if ($paper->session)
                                    <a href="{{route('frontend.sessions.show',$paper->session->id)}}">{{ $paper->session->title or '' }}</a> [ <i class="fa fa-clock"></i> {{(new gateweb\common\DateTime($paper->session->start))->format('H:i')}}]    
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Αίθουσα')</th>
                            <td field-key='room'>
                                @if ($paper->session)
                                    <a href="{{route('frontend.rooms.show',$paper->session->room->id)}}">{{ $paper->session->room->title or '' }}</a>    
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('Ημερομηνία')</th>
                            <td field-key='date'>
                                @if ($paper->session)
                                    {{ (new gateweb\common\DateTime($paper->session->start))->format('d/m/Y') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.abstract')</th>
                            <td field-key='abstract'>{!! $paper->abstract !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.bio')</th>
                            <td field-key='bio'>{!! $paper->bio !!}</td>
                        </tr>

                        <tr>
                            <th>@lang('quickadmin.papers.fields.duration')</th>
                            <td field-key='duration'>{{ $paper->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.art')</th>
                            <td field-key='art'>
                                @foreach ($paper->art as $singleArt)
                                    <a href="{{route('frontend.arts.show',$singleArt->id)}}" class="badge badge-secondary" >{{ $singleArt->title }}</a>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>id</th>
                            <td field-key='id'>{{ $paper->id }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <a href="{{ route('frontend.papers.index') }}" class="btn btn-outline-info">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

