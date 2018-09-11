@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.rooms.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.rooms.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.rooms.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.rooms.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => 'Πληροφορίες για το κοινό']) !!}
                    <p class="help-block">Πληροφορίες για το κοινό</p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('quickadmin.rooms.fields.type').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('type', 'Αμφιθέατρο', false, []) !!}
                            Αμφιθέατρο
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Αίθουσα διδασκαλίας', false, []) !!}
                            Αίθουσα διδασκαλίας
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Αίθουσα τελετών', false, []) !!}
                            Αίθουσα τελετών
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Εξωτερικός χώρος', false, []) !!}
                            Εξωτερικός χώρος
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('wifi', trans('quickadmin.rooms.fields.wifi').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('wifi'))
                        <p class="help-block">
                            {{ $errors->first('wifi') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('wifi', 'full', false, []) !!}
                            full
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('wifi', 'limited', false, []) !!}
                            limited
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('wifi', 'none', false, []) !!}
                            none
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
            });
        });
    </script>

@stop