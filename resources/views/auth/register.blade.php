@extends('frontend.app')

@section('content')
{{-- Do not allow registration until a certain date --}}
@if (new gateweb\common\DateTime() < new DateTime('2018-09-25'))

    <p class="alert alert-warning">@lang('Ο μηχανισμός εγγραφής δεν είναι διαθέσιμος, διότι πραγματοποιούνται οι δηλώσεις όσων είχαν κάνει προεγγραφή. Θα είναι διαθέσιμος από τις 25 Σεπτεμβρίου.')</p>

@else

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading mb-4 text-muted ">@lang('quickadmin.qa_register')</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">@lang('quickadmin.qa_name')*</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">@lang('quickadmin.qa_email')*</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">@lang('Τηλέφωνο')</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control" name="phone" required>
                                </div>
                            </div>

                            <div class="form-group">
                                 <label for="attribute" class="col-md-4 control-label">@lang('Ιδιότητα')*</label>
                                {{-- {!! Form::label('attribute', trans('quickadmin.users.fields.attribute').'*', ['class' => 'control-label']) !!} --}}
                                <div class="col-md-6">
                                    
                                    <p class="help-block"></p>
                                    @if($errors->has('attribute'))
                                        <p class="help-block">
                                            {{ $errors->first('attribute') }}
                                        </p>
                                    @endif

                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 91.01', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 91.01
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 79.01', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 79.01
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 08', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 08
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 70', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 70
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 60', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 60
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 02', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 02
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 11', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 11
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 05 / 06 / 07 / 34 / 40', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 05 / 06 / 07 / 34 / 40
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 03/ 04', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 03/ 04
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 86', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 86
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 36', false, ['required' => '']) !!}
                                            Εκπαιδευτικός ΠΕ 36
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Προπτυχιακός/ή Φοιτητής /τρια', false, ['required' => '']) !!}
                                            Προπτυχιακός/ή Φοιτητής /τρια
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Μεταπτυχιακός /η Φοιτητής / τρια', false, ['required' => '']) !!}
                                            Μεταπτυχιακός /η Φοιτητής / τρια
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Διδάκτορας', false, ['required' => '']) !!}
                                            Διδάκτορας
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Ανεξάρτητος Ερευνητής', false, ['required' => '']) !!}
                                            Ανεξάρτητος Ερευνητής
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Μέλος ΕΔΙΠ / ΕΕΠ', false, ['required' => '']) !!}
                                            Μέλος ΕΔΙΠ / ΕΕΠ
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Μέλος ΔΕΠ', false, ['required' => '']) !!}
                                            Μέλος ΔΕΠ
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Ομότιμος Καθηγητής / τρια', false, ['required' => '']) !!}
                                            Ομότιμος Καθηγητής / τρια
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            {!! Form::radio('attribute', 'Άλλο', false, ['required' => '']) !!}
                                            Άλλο
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">@lang('quickadmin.qa_password')*</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">@lang('quickadmin.qa_confirm_password')*</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4 mb-5">
                                    <button type="submit" class="btn btn-success">
                                        @lang('quickadmin.qa_register')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
