@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.papers.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.papers.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.papers.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('art', trans('quickadmin.papers.fields.art').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-art">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-art">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('art[]', $arts, old('art'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-art' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('art'))
                        <p class="help-block">
                            {{ $errors->first('art') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('type', trans('quickadmin.papers.fields.type').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('type'))
                        <p class="help-block">
                            {{ $errors->first('type') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('type', 'Εισήγηση', false, []) !!}
                            Εισήγηση
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Εργαστήριο: βιωματικές δράσεις', false, []) !!}
                            Εργαστήριο: βιωματικές δράσεις
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('type', 'Εργαστήριο: καλές πρακτικές', false, []) !!}
                            Εργαστήριο: καλές πρακτικές
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration', trans('quickadmin.papers.fields.duration').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('duration'))
                        <p class="help-block">
                            {{ $errors->first('duration') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('duration', '20', false, []) !!}
                            20
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('duration', '45', false, []) !!}
                            45
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('duration', '90', false, []) !!}
                            90
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('quickadmin.papers.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('email', trans('quickadmin.papers.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::label('attribute', trans('quickadmin.papers.fields.attribute').'', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('attribute'))
                        <p class="help-block">
                            {{ $errors->first('attribute') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Πανεπιστημιακός', false, []) !!}
                            Πανεπιστημιακός
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Ερευνητής', false, []) !!}
                            Ερευνητής
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Μεταπτυχιακός φοιτητής', false, []) !!}
                            Μεταπτυχιακός φοιτητής
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Εκπαιδευτικός Β/θμιας Εκπ/σης', false, []) !!}
                            Εκπαιδευτικός Β/θμιας Εκπ/σης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Εκπαιδευτικός Α/θμιας Εκπ/σης', false, []) !!}
                            Εκπαιδευτικός Α/θμιας Εκπ/σης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Καλλιτέχνης', false, []) !!}
                            Καλλιτέχνης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Άλλο', false, []) !!}
                            Άλλο
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('document', trans('quickadmin.papers.fields.document').'', ['class' => 'control-label']) !!}
                    {!! Form::file('document[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'document',
                        'data-filekey' => 'document',
                        ]) !!}
                    <p class="help-block"></p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('document'))
                        <p class="help-block">
                            {{ $errors->first('document') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('assign', trans('quickadmin.papers.fields.assign').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-assign">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-assign">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('assign[]', $assigns, old('assign'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-assign' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('assign'))
                        <p class="help-block">
                            {{ $errors->first('assign') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('quickadmin.papers.fields.status').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('status', 'Accepted', false, ['required' => '']) !!}
                            Accepted
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('status', 'Rejected', false, ['required' => '']) !!}
                            Rejected
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('status', 'Pending', false, ['required' => '']) !!}
                            Pending
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('informed', trans('quickadmin.papers.fields.informed').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('informed'))
                        <p class="help-block">
                            {{ $errors->first('informed') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('informed', 'Unaware', false, ['required' => '']) !!}
                            Unaware
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('informed', 'Informed', false, ['required' => '']) !!}
                            Informed
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Κρίσεις
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="kriseis">
                    @foreach(old('reviews', []) as $index => $data)
                        @include('admin.papers.reviews_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('quickadmin.qa_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="kriseis-template">
        @include('admin.papers.reviews_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('quickadmin/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Paper',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
    <script>
        $("#selectbtn-art").click(function(){
            $("#selectall-art > option").prop("selected","selected");
            $("#selectall-art").trigger("change");
        });
        $("#deselectbtn-art").click(function(){
            $("#selectall-art > option").prop("selected","");
            $("#selectall-art").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-assign").click(function(){
            $("#selectall-assign > option").prop("selected","selected");
            $("#selectall-assign").trigger("change");
        });
        $("#deselectbtn-assign").click(function(){
            $("#selectall-assign > option").prop("selected","");
            $("#selectall-assign").trigger("change");
        });
    </script>
@stop