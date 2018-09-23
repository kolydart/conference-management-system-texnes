@extends('frontend.app')

@section('content')
    <h3 class="page-title mb-3"> <i class="fa fa-newspaper"></i> {{$paper->type}}</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">

                {{-- Availability --}}
                <div class="col-md-4 col-sm-6">
                @if( App\Paper::accepted()->lab()->where('id',$paper->id)->count())
                    <p class="text-secondary small"> @lang('Διαθεσιμότητα:')
                    @if ($paper->attend()->count() >= $paper->capacity())
                         <span class="">@lang('δεν υπάρχουν θέσεις')</span></p>
                    @elseif ($paper->attend()->count() / $paper->capacity() > 0.7)
                        <span class="text-warning">@lang('απομένουν λίγες θέσεις')</span></p>
                    @else
                        <span class="text-success">@lang('υπάρχουν θέσεις')</span></p>
                    @endcan
                @endif
                </div>

                {{-- Attend button --}}
                <div class="col-sm-6 col-md-4 offset-md-4 pb-1">
                    
                        @can('attend_create', $paper)
                        <a href="{{route('frontend.attend.create',$paper->id)}}" class="btn btn-lg btn-success"><i class="far fa-check-square"></i> @lang('Δήλωση συμμετοχής')</a>
                        @endcan

                        @can('attend_delete', $paper)
                        <a href="{{route('frontend.attend.delete',$paper->id)}}" class="btn btn-lg btn-danger"><i class="far fa-times-circle"></i> @lang('Ακύρωση συμμετοχής')</a>
                        @endcan

                        <a href="/page/faq#register" class="text-secondary" title="Οδηγίες για δήλωση εργαστηρίων"><i class="fas fa-info-circle"></i></a>

                </div>
            </div>
            <span class="badge badge-dark">@lang('quickadmin.qa_view')</span>
        </div>        

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>id</th>
                            <td field-key='id'>{{ $paper->id }}</td>
                        </tr>
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
                                    {{ (new gateweb\common\DateTime($paper->session->start))->format('l, d M Y') }}
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
                            <td field-key='duration'>{{ $paper->duration }}'</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.art')</th>
                            <td field-key='art'>
                                @foreach ($paper->art as $singleArt)
                                    <a href="{{route('frontend.arts.show',$singleArt->id)}}" class="badge badge-secondary" >{{ $singleArt->title }}</a>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

