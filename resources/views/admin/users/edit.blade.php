@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.users.title')</h3>
    
    {!! Form::model($user, ['method' => 'PUT', 'route' => ['admin.users.update', $user->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.users.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.users.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('checkin', trans('quickadmin.users.fields.checkin').'', ['class' => 'control-label']) !!}
                    <p class="help-block">in Reception</p>
                    @if($errors->has('checkin'))
                        <p class="help-block">
                            {{ $errors->first('checkin') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('checkin', 'Checked-in', false, []) !!}
                            Checked-in
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('checkin', 'Αbsent', false, []) !!}
                            Αbsent
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('quickadmin.users.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attribute', trans('quickadmin.users.fields.attribute').'*', ['class' => 'control-label']) !!}
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
                            {!! Form::radio('attribute', 'Εκπαιδευτικός ΠΕ 01', false, ['required' => '']) !!}
                            Εκπαιδευτικός ΠΕ 01
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('password', trans('quickadmin.users.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('role_id', trans('quickadmin.users.fields.role').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('role_id', $roles, old('role_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('role_id'))
                        <p class="help-block">
                            {{ $errors->first('role_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

