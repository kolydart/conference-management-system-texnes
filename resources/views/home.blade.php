@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('gw.dashboard')</div>

                <div class="panel-body">
                    {{-- @lang('quickadmin.qa_dashboard_text') --}}
                @if (
                    Hash::check(
                        gateweb\common\Presenter::before(Auth::user()->email,'@'), Auth::user()->password
                        )
                    )
                    <p class='mt-2'>
                        <strong class="bg-warning">
                            Παρακαλώ αλλάξτε το αρχικό password
                        </strong>
                        <br>(είναι κοινότοπο)
                    </p>
                    <p><a class="btn btn-warning" href="/change_password">Αλλαγή password</a></p>
                @endif
                </div>
            </div>
        </div>
    </div>
@endsection
