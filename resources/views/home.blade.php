@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                @lang('gw.dashboard')
            </div>
            <div class="panel-body">
                Σύστημα Διαχείρισης Προτάσεων για το Συνέδριο <a href="http://texnes-ellinikosxoleio.uoa.gr/" target="_blank">Oι Τέχνες στο ελληνικό σχολείο: παρόν και μἐλλον</a><br><br>                
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

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Recently added fullpapers
            </div>
            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ajaxTable">
                    <thead>
                        <tr>
                            <td>
                                @lang('quickadmin.papers.fields.title')
                            </td>
                            <td>
                                @lang('quickadmin.fullpaper.fields.description')
                            </td>
                        </tr>
                    </thead>
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
    </div>
</div>
@endsection