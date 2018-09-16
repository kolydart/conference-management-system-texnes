@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.subscriptions.title')</h3>
    
    {!! Form::model($subscription, ['method' => 'PUT', 'route' => ['admin.subscriptions.update', $subscription->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('quickadmin.subscriptions.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('paper_id', trans('quickadmin.subscriptions.fields.paper').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('paper_id', $papers, old('paper_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('paper_id'))
                        <p class="help-block">
                            {{ $errors->first('paper_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('appeared', trans('quickadmin.subscriptions.fields.appeared').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('appeared', 0) !!}
                    {!! Form::checkbox('appeared', 1, old('appeared', old('appeared')), []) !!}
                    <p class="help-block"></p>
                    @if($errors->has('appeared'))
                        <p class="help-block">
                            {{ $errors->first('appeared') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

