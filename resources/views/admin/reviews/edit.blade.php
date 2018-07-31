@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.reviews.title')</h3>
    
    {!! Form::model($review, ['method' => 'PUT', 'route' => ['admin.reviews.update', $review->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('review', trans('quickadmin.reviews.fields.review').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('review'))
                        <p class="help-block">
                            {{ $errors->first('review') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('review', 'Approve', false, ['required' => '']) !!}
                            Approve
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('review', 'Neutral', false, ['required' => '']) !!}
                            Neutral
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('review', 'Reject', false, ['required' => '']) !!}
                            Reject
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

