@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.papers.title')</h3>
    
    {!! Form::model($paper, ['method' => 'PUT', 'route' => ['admin.papers.update', $paper->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body row">
            <div class="col-md-6{{-- row --}}">
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
            <div class="col-md-6{{-- row --}}">
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
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('art', trans('quickadmin.papers.fields.art').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-art">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-art">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('art[]', $arts, old('art') ? old('art') : $paper->art->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-art' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('art'))
                        <p class="help-block">
                            {{ $errors->first('art') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('quickadmin.papers.fields.user').'', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>            
            <div class="col-md-6{{-- row --}}">
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
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('duration', trans('quickadmin.papers.fields.duration').'', ['class' => 'control-label']) !!}
                    <p class="help-block">Συνολικός χρόνος σε λεπτά της ώρας</p>
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
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('session_id', trans('quickadmin.papers.fields.session').'', ['class' => 'control-label']) !!}
                    {!! Form::select('session_id', $sessions, old('session_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('session_id'))
                        <p class="help-block">
                            {{ $errors->first('session_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.papers.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
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
                            {!! Form::radio('attribute', 'Μέλος ΔΕΠ', false, []) !!}
                            Μέλος ΔΕΠ
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Μέλος ΕΕΠ', false, []) !!}
                            Μέλος ΕΕΠ
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Μέλος ΕΔΙΠ', false, []) !!}
                            Μέλος ΕΔΙΠ
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Διδάκτωρ / Ερευνητής', false, []) !!}
                            Διδάκτωρ / Ερευνητής
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Υποψήφιος Διδάκτωρ', false, []) !!}
                            Υποψήφιος Διδάκτωρ
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Μεταπτυχιακός/ή Φοιτητής/τρια', false, []) !!}
                            Μεταπτυχιακός/ή Φοιτητής/τρια
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Προπτυχιακός/ή Φοιτητής/τρια', false, []) !!}
                            Προπτυχιακός/ή Φοιτητής/τρια
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Στέλεχος Εκπαίδευσης', false, []) !!}
                            Στέλεχος Εκπαίδευσης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης', false, []) !!}
                            Εκπαιδευτικός Πρωτοβάθμιας Εκπαίδευσης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης', false, []) !!}
                            Εκπαιδευτικός Δευτεροβάθμιας Εκπαίδευσης
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('attribute', 'Καλλιτέχνης', false, []) !!}
                            Καλλιτέχνης
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('quickadmin.papers.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
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
                        <div class="files-list">
                            @foreach($paper->getMedia('document') as $media)
                                <p class="form-group">
                                    <a href="{{ "/storage/".$media->id."/".rawurlencode($media->file_name) }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                    <input type="hidden" name="document_id[]" value="{{ $media->id }}">
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if($errors->has('document'))
                        <p class="help-block">
                            {{ $errors->first('document') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('abstract', trans('quickadmin.papers.fields.abstract').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('abstract', old('abstract'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block">Περίληψη (έως 200 λέξεις)</p>
                    @if($errors->has('abstract'))
                        <p class="help-block">
                            {{ $errors->first('abstract') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bio', trans('quickadmin.papers.fields.bio').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('bio', old('bio'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bio'))
                        <p class="help-block">
                            {{ $errors->first('bio') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('assign', trans('quickadmin.papers.fields.assign').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-assign">
                        {{ trans('quickadmin.qa_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-assign">
                        {{ trans('quickadmin.qa_deselect_all') }}
                    </button>
                    {!! Form::select('assign[]', $assigns, old('assign') ? old('assign') : $paper->assign->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-assign' ]) !!}
                    <p class="help-block"></p>
                    @if($errors->has('assign'))
                        <p class="help-block">
                            {{ $errors->first('assign') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
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
            <div class="col-md-6{{-- row --}}">
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
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('order', trans('quickadmin.papers.fields.order').'', ['class' => 'control-label']) !!}
                    {!! Form::number('order', old('order'), ['class' => 'form-control', 'placeholder' => 'Θέση (σειρά) εντός της συνεδρίας. Αφήστε κενό για ταξινόμηση σύμφωνα με την ιδιότητα']) !!}
                    <p class="help-block">Θέση (σειρά) εντός της συνεδρίας. Αφήστε κενό για ταξινόμηση σύμφωνα με την ιδιότητα</p>
                    @if($errors->has('order'))
                        <p class="help-block">
                            {{ $errors->first('order') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-6{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('capacity', trans('quickadmin.papers.fields.capacity').'', ['class' => 'control-label']) !!}
                    {!! Form::number('capacity', old('capacity'), ['class' => 'form-control', 'placeholder' => 'Μέγιστος αριθμός συμμετεχόντων']) !!}
                    <p class="help-block">Αριθμός μελών ομάδας</p>
                    @if($errors->has('capacity'))
                        <p class="help-block">
                            {{ $errors->first('capacity') }}
                        </p>
                    @endif
                </div>
            </div>

            {{-- Lab only fields --}}
            @if (App\Paper::lab()->where('id',$paper->id)->count() == 1)
            
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('age', trans('quickadmin.papers.fields.age').'', ['class' => 'control-label']) !!}
                    {!! Form::text('age', old('age'), ['class' => 'form-control', 'placeholder' => 'Ηλικίες ή σχολικές τάξεις στις οποίες απευθύνεται']) !!}
                    <p class="help-block">Ηλικίες ή σχολικές τάξεις στις οποίες απευθύνεται</p>
                    @if($errors->has('age'))
                        <p class="help-block">
                            {{ $errors->first('age') }}
                        </p>
                    @endif
                </div>
            </div>            
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('objectives', trans('quickadmin.papers.fields.objectives').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('objectives', old('objectives'), ['class' => 'form-control editor', 'placeholder' => 'Στόχοι (Διδακτικοί / Μαθησιακοί)']) !!}
                    <p class="help-block">Στόχοι (Διδακτικοί / Μαθησιακοί/ Βασικοί / Επί μέρους/ Μη σχετικοί στόχοι)</p>
                    @if($errors->has('objectives'))
                        <p class="help-block">
                            {{ $errors->first('objectives') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('materials', trans('quickadmin.papers.fields.materials').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('materials', old('materials'), ['class' => 'form-control editor', 'placeholder' => 'Υλικό (Εποπτικά μέσα / Εξοπλισμός / Εργαλεία)']) !!}
                    <p class="help-block">Υλικά και μέσα (Εποπτικά μέσα / Εξοπλισμός / Εργαλεία)</p>
                    @if($errors->has('materials'))
                        <p class="help-block">
                            {{ $errors->first('materials') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('quickadmin.papers.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control editor', 'placeholder' => 'Σχέδιο ανάπτυξης / περιγραφή (Φάσεις, δραστηριότητες, πορεία εργαστηρίου, αποτελέσματα, με έκταση έως 2000 λέξεις)']) !!}
                    <p class="help-block">Σχέδιο εισαγωγής, ανάπτυξης, κλεισίματος εργαστήριου / περιγραφή (Φάσεις, χρονική διάρκεια κάθε φάσης, δραστηριότητες, οδηγίες, πορεία εργαστηρίου, σημειώσεις – προτάσεις για τον εμψυχωτή/διδάσκοντα, αποτελέσματα, παραλλαγές ασκήσεων / δράσεων,  με έκταση έως 2000 λέξεις)</p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('evaluation', trans('quickadmin.papers.fields.evaluation').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('evaluation', old('evaluation'), ['class' => 'form-control editor', 'placeholder' => 'Προσωπική αποτίμηση (Αναλύεται πώς είδατε προσωπικά το εργαστήριο που υλοποιήσατε)']) !!}
                    <p class="help-block">Προσωπική αποτίμηση (αναλύετε πώς είδατε προσωπικά το εργαστήριο που υλοποιήσατε)</p>
                    @if($errors->has('evaluation'))
                        <p class="help-block">
                            {{ $errors->first('evaluation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('images', trans('quickadmin.papers.fields.images').'', ['class' => 'control-label']) !!}
                    {!! Form::file('images[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'images',
                        'data-filekey' => 'images',
                        ]) !!}
                    <p class="help-block">Υλικό τεκμηρίωσης (έως 5 φωτογραφίες, ενδεικτικές της δράσης του εργαστηρίου)</p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list">
                            @foreach($paper->getMedia('images') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                    <input type="hidden" name="images_id[]" value="{{ $media->id }}">
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if($errors->has('images'))
                        <p class="help-block">
                            {{ $errors->first('images') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('video', trans('quickadmin.papers.fields.video').'', ['class' => 'control-label']) !!}
                    {!! Form::text('video', old('video'), ['class' => 'form-control', 'placeholder' => 'Βίντεο του εργαστηρίου (Με link στην πλατφόρμα όπου το έχετε αναρτήσει: vod-new.sch.gr , vimeo.com, youtube.com κ.λπ.)']) !!}
                    <p class="help-block">Βίντεο του εργαστηρίου (με link στην πλατφόρμα όπου το έχετε αναρτήσει: vod-new.sch.gr , vimeo.com, youtube.com κ.λπ.)</p>
                    @if($errors->has('video'))
                        <p class="help-block">
                            {{ $errors->first('video') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bibliography', trans('quickadmin.papers.fields.bibliography').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('bibliography', old('bibliography'), ['class' => 'form-control editor', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('bibliography'))
                        <p class="help-block">
                            {{ $errors->first('bibliography') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('keywords', trans('quickadmin.papers.fields.keywords').'', ['class' => 'control-label']) !!}
                    {!! Form::text('keywords', old('keywords'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('keywords'))
                        <p class="help-block">
                            {{ $errors->first('keywords') }}
                        </p>
                    @endif
                </div>
            </div>
            @endif

            {{-- show only on accepted --}}
            @if (App\Paper::accepted()->where('id',$paper->id)->count() == 1)
            <div class="col-md-12{{-- row --}}">
                <div class="col-xs-12 form-group">
                    {!! Form::label('lab_approved', trans('Approved').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('lab_approved', 0) !!}
                    {!! Form::checkbox('lab_approved', 1, old('lab_approved', old('lab_approved')), []) !!}
                    <p class="help-block">Αποδοχή περιεχομένου για πρακτικά</p>
                    @if($errors->has('lab_approved'))
                        <p class="help-block">
                            {{ $errors->first('lab_approved') }}
                        </p>
                    @endif
                </div>
            </div>

            @endif            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
    {{-- <script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script> --}}
    <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>    
    <script>
        $('.editor').each(function () {
                  CKEDITOR.replace($(this).attr('id'),{
                    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
                    customConfig: '/js/ckeditor_config_paper_backend.js'
            });
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
