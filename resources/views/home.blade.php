@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('gw.dashboard')
            </div>
            <div class="panel-body">
                Σύστημα Διαχείρισης Προτάσεων για το Συνέδριο <a href="/" class="btn btn-link">Oι Τέχνες στο ελληνικό σχολείο: παρόν και μἐλλον</a> <a href="/" class="btn btn-primary"><i class="fa fa-eye"></i></a><br><br>                
                @if (
                    Hash::check(
                        gateweb\common\Presenter::before(Auth::user()->email,'@'), Auth::user()->password
                        )
                    )
                <p class="mt-2"> <strong class="bg-warning"> Παρακαλώ αλλάξτε το αρχικό password </strong> <br> (είναι κοινότοπο) </br> </p>
                <p>
                    <a class="btn btn-warning" href="/change_password"> Αλλαγή password </a>
                </p>
                @endif
            </div>
        </div>
    </div>

    {{-- Papers report --}}
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Συγκεντρωτικά Δεδομένα για Πρακτικά</b>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    <thead>
                        <tr>
                            <th> Κατηγορία </th>
                            <th> Σύνολο </th>
                            <th> Με περιεχόμενο για πρακτικά </th>
                            <th> Ολοκληρωμένα </th>
                        </tr>
                    </thead>
                    <tr>
                        <td> Εισηγήσεις </td>
                        <td> {{ App\Paper::accepted()->labNot()->count() }} </td>
                        <td> {{ App\Paper::accepted()->labNot()->whereHas('fullpapers')->count() }} </td>
                        <td> {{ App\Paper::accepted()->labNot()->whereHas('fullpapers')->where('lab_approved',1)->count() }} </td>
                    </tr>
                    <tr>
                        <td> Εργαστήρια </td>
                        <td> {{ App\Paper::accepted()->lab()->count() }} </td>
                        <td> {{ App\Paper::accepted()->lab()->where('description','<>','')->count() }} </td>
                        <td> {{ App\Paper::accepted()->lab()->where('description','<>','')->where('lab_approved',1)->count() }} </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Δηλώσεις συμμετοχής σε εργαστήρια (chart) --}}
    {{-- <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Δηλώσεις συμμετοχής σε εργαστήρια
            </div>
            <div class="panel-body">
                   @include('admin.partials.reports.html')
            </div>
        </div>
    </div> --}}

    {{-- Πληρότητα εργαστηρίων --}}
    <?php /*<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Πληρότητα εργαστηρίων
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            {{-- <th>Όλα</th> --}}
                            {{-- <th>>1 Ακροατές</th> --}}
                            {{-- <th>0 Ακροατές</th> --}}
                            <th>Μέση πληρότητα</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            {{-- <td>{{App\Paper::accepted()->whereRaw('`type` LIKE "Εργαστήριο%"')->count()}}</td>
                            <td>{{App\Paper::accepted()->whereHas('attend')->count()}}</td>
                            <td>{{App\Paper::accepted()->whereRaw('`type` LIKE "Εργαστήριο%"')->whereDoesnthave('attend')->count()}}</td> --}}
                            <td>{{round(DB::table('attend')->count()/App\Paper::accepted()->whereRaw('`type` LIKE "Εργαστήριο%"')->pluck('capacity')->sum()*100,2)}}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>*/?>

    {{-- Ακροατές --}}
    {{-- <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Στατιστικά ακροατών
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Όλοι</th>
                            <th>Έχουν δηλώσει εργαστήρια</th>
                            <th>Δεν έχουν δηλώσει</th>
                            <th>Μέσος αρ. εργαστηρίων όσων δήλωσαν </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{App\User::attendees()->count()}}</td>
                            <td>{{App\User::attendees()->whereHas('attend')->count()}}</td>
                            <td>{{App\User::attendees()->whereDoesnthave('attend')->count()}}</td>
                            <td>@if (App\User::attendees()->whereHas('attend')->count())
                                {{round( DB::table('attend')->count() / App\User::attendees()->whereHas('attend')->count(),2)}}
                            @endif</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    {{-- Ακροατές με εργαστήρια που ξεκινούν την ίδια ώρα --}}
    {{-- <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Διπλοεγγεγραμμένοι (Ακροατές με εργαστήρια που ξεκινούν την ίδια ώρα)
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tbody>
                        @foreach (App\User::has('attend')->get() as $user)
                            @if (App\Http\Controllers\Frontend\AttendsController::concurrent($user->attend))
                            <tr>
                                <td><a href="{{route('admin.users.show',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->attribute}}</td>
                                <td>{{count(App\Http\Controllers\Frontend\AttendsController::concurrent($user->attend))}}</td>
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    {{-- Empty abstracts --}}
    <?php /*<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Προτάσεις χωρίς περίληψη: <b> {{App\Paper::whereNull('abstract')->orWhere('abstract','')->accepted()->count()}}</b>
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    {{-- <thead>
                        <tr>
                            <td>
                                @lang('Όνομα')
                            </td>
                            <td>
                                @lang('quickadmin.papers.fields.title')
                            </td>
                            <td>
                                @lang('Περίληψη')
                            </td>
                        </tr>
                    </thead> --}}
                    @foreach(App\Paper::whereNull('abstract')->orWhere('abstract','')->accepted()->get() as $paper)
                    <tr>
                        <td>
                            {{$paper->name}}
                        </td>
                        <td>
                            <a href="{{route('admin.papers.show',$paper->id)}}">{{$paper->title}}</a>
                        </td>
                        <td>
                            {{$paper->type}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>*/?>    

    {{-- Recently created attends --}}
    <?php /*<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Πρόσφατες (10) δηλώσεις σε εργαστήρια
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    {{-- <thead>
                        <tr>
                            <td>
                                @lang('quickadmin.papers.fields.title')
                            </td>
                            <td>
                                @lang('quickadmin.fullpaper.fields.description')
                            </td>
                        </tr>
                    </thead> --}}
                    @foreach(App\Activitylog::where('description', 'attend_create')->latest()->take(10)->get() as $log)
                    <tr>
                        <td>
                            {{App\User::findOrFail($log->causer_id)->name}}
                        </td>
                        <td>
                            [{{App\Paper::findOrFail($log->subject_id)->id}}] {{App\Paper::findOrFail($log->subject_id)->title}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>*/?>

    {{-- Recently created users --}}
    {{-- <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Πρόσφατες (10) εγγραφές ακροατών
            </div>
            <div class="panel-body table-responsive">
                @foreach(App\User::attendees()->orderBy('created_at','Desc')->take(10)->get() as $user)
                    <p>{{$user->name}}, {{$user->email}}, {{$user->attribute}}, {{$user->created_at}}</p>
                @endforeach
            </div>
        </div>
    </div> --}}

    {{-- Recently added fullpapers --}}
    <?php /*<div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Recently added fullpapers
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    {{-- <thead>
                        <tr>
                            <td>
                                @lang('quickadmin.papers.fields.title')
                            </td>
                            <td>
                                @lang('quickadmin.fullpaper.fields.description')
                            </td>
                        </tr>
                    </thead> --}}
                    @foreach($fullpapers as $fullpaper)
                    <tr>
                        <td>
                            <a href="{{ route('admin.papers.show',$fullpaper->paper->id) }}">{{ $fullpaper->paper->title }}</a>
                        </td>
                        <td>
                            {{ $fullpaper->description }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>*/?>


</div>
@endsection

@section('javascript')
    @include('admin.partials.reports.javascript')
@stop
