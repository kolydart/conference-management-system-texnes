{{-- @extends('layouts.app') --}}
@extends('frontend.app')


@section('content')
    
    <legend class="text-info">Επεξεργασία εργαστηρίου</legend>
    
    {!! Form::model($paper, ['method' => 'PUT', 'route' => ['frontend.papers.update', $paper->id], 'files' => true,]) !!}
            <div class="row mt-5 ">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('title', trans('quickadmin.papers.fields.title').'', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block text-secondary"></p>
                    @if($errors->has('title text-danger'))
                        <p class="help-block"> {{ $errors->first('title') }} </p>
                    @endif
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-3 offset-sm-1 form-group w-100">
                    {!! Form::label('duration', trans('Διάρκεια').'', ['class' => 'control-label']) !!}
                    {!! Form::text('duration', old('duration'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block text-secondary">Συνολικός χρόνος σε λεπτά της ώρας</p>
                    @if($errors->has('duration text-danger'))
                        <p class="help-block"> {{ $errors->first('duration') }} </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('abstract', trans('quickadmin.papers.fields.abstract').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">(έως 200 λέξεις)</p>
                    {!! Form::textarea('abstract', old('abstract'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    @if($errors->has('abstract text-danger'))
                        <p class="help-block"> {{ $errors->first('abstract') }} </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('objectives', trans('quickadmin.papers.fields.objectives').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">(Διδακτικοί / Μαθησιακοί)</p>
                    {!! Form::textarea('objectives', old('objectives'), ['class' => 'form-control editor', 'placeholder' => 'Στόχοι (Διδακτικοί / Μαθησιακοί)']) !!}
                    @if($errors->has('objectives'))
                        <p class="help-block text-danger">
                            {{ $errors->first('objectives') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('materials', trans('quickadmin.papers.fields.materials').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">(Εποπτικά μέσα / Εξοπλισμός / Εργαλεία)</p>
                    {!! Form::textarea('materials', old('materials'), ['class' => 'form-control editor', 'placeholder' => 'Υλικό (Εποπτικά μέσα / Εξοπλισμός / Εργαλεία)']) !!}
                    @if($errors->has('materials'))
                        <p class="help-block text-danger">
                            {{ $errors->first('materials') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('description', trans('quickadmin.papers.fields.description').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">Σχέδιο ανάπτυξης (Φάσεις, δραστηριότητες, πορεία εργαστηρίου, αποτελέσματα, με έκταση έως 2000 λέξεις)</p>
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => 'Σχέδιο ανάπτυξης / περιγραφή (Φάσεις, δραστηριότητες, πορεία εργαστηρίου, αποτελέσματα, με έκταση έως 2000 λέξεις)']) !!}
                    @if($errors->has('description'))
                        <p class="help-block text-danger">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('evaluation', trans('quickadmin.papers.fields.evaluation').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">(Αναλύεται πώς είδατε προσωπικά το εργαστήριο που υλοποιήσατε)</p>
                    {!! Form::textarea('evaluation', old('evaluation'), ['class' => 'form-control editor', 'placeholder' => 'Προσωπική αποτίμηση (Αναλύεται πώς είδατε προσωπικά το εργαστήριο που υλοποιήσατε)']) !!}
                    @if($errors->has('evaluation'))
                        <p class="help-block text-danger">
                            {{ $errors->first('evaluation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('images', trans('quickadmin.papers.fields.images').'', ['class' => 'control-label mt-3']) !!}
                    {!! Form::file('images[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'images',
                        'data-filekey' => 'images',
                        ]) !!}
                    <p class="help-block text-secondary">Υλικό τεκμηρίωσης (Έως 5 φωτογραφίες, ενδεικτικές της δράσης του εργαστηρίου)</p>
                    <div class="photo-block">
                        {{-- <div class="progress-bar form-group">&nbsp;</div> --}}
                        <div class="files-list">
                            @foreach($paper->getMedia('images') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getFullUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                    <input type="hidden" name="images_id[]" value="{{ $media->id }}">
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if($errors->has('images'))
                        <p class="help-block text-danger">
                            {{ $errors->first('images') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('video', trans('quickadmin.papers.fields.video').'', ['class' => 'control-label mt-3']) !!}
                    <p class="help-block text-secondary">Βίντεο του εργαστηρίου (Με link στην πλατφόρμα όπου το έχετε αναρτήσει: vod-new.sch.gr , vimeo.com, youtube.com κ.λπ.)</p>
                    {!! Form::text('video', old('video'), ['class' => 'form-control']) !!}
                    @if($errors->has('video'))
                        <p class="help-block text-danger">
                            {{ $errors->first('video') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 form-group w-100">
                    {!! Form::label('bibliography', trans('quickadmin.papers.fields.bibliography').'', ['class' => 'control-label mt-3']) !!}
                    {!! Form::textarea('bibliography', old('bibliography'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block text-secondary"></p>
                    @if($errors->has('bibliography'))
                        <p class="help-block text-danger">
                            {{ $errors->first('bibliography') }}
                        </p>
                    @endif
                </div>
            </div>            

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-info mb-5']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    {{-- <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script> --}}
    <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <script>
        $('.editor').not('#abstract').not('#description').each(function () {
            CKEDITOR.replace($(this).attr('id'),{customConfig: '/js/ckeditor_config_frontend.js'});
        });
        $('#abstract').each(function () {
            CKEDITOR.replace($(this).attr('id'),{customConfig: '/js/ckeditor_config_frontend_200words.js'});
        });
        $('#description').each(function () {
            CKEDITOR.replace($(this).attr('id'),{customConfig: '/js/ckeditor_config_frontend_2000words.js'});
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
@stop