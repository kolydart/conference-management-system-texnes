@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.papers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>id</th>
                            <td field-key='id'>{{ $paper->id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.title')</th>
                            <td field-key='title'>{{ $paper->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.art')</th>
                            <td field-key='art'>
                                @foreach ($paper->art as $singleArt)
                                    <span class="label label-info label-many">{{ $singleArt->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.type')</th>
                            <td field-key='type'>{{ $paper->type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.duration')</th>
                            <td field-key='duration'>{{ $paper->duration }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.session')</th>
                            <td field-key='session'>
                                @if ($paper->session)
                                    <a href="{{route('admin.sessions.show',$paper->session->id)}}">{{ $paper->session->title or '' }}</a>    
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.name')</th>
                            <td field-key='name'>{{ $paper->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.email')</th>
                            <td field-key='email'>{{ $paper->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.attribute')</th>
                            <td field-key='attribute'>{{ $paper->attribute }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.phone')</th>
                            <td field-key='phone'>{{ $paper->phone }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.document')</th>
                            <td field-key='document's> @foreach($paper->getMedia('document') as $media)
                                <p class="form-group">
                                    <a href="{{ "/storage/".$media->id."/".rawurlencode($media->file_name) }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.abstract')</th>
                            <td field-key='abstract'>{!! $paper->abstract !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.bio')</th>
                            <td field-key='bio'>{!! $paper->bio !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.assign')</th>
                            <td field-key='assign'>
                                @foreach ($paper->assign as $singleAssign)
                                    <span class="label label-info label-many">{{ $singleAssign->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.status')</th>
                            <td field-key='status'>{{ $paper->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.papers.fields.informed')</th>
                            <td field-key='informed'>{{ $paper->informed }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
@can('paper_edit')
    <a href="{{ route('admin.papers.edit',[$paper->id]) }}" class="btn btn-info">@lang('quickadmin.qa_edit')</a>
@endcan
<p>&nbsp;</p>
            
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#fullpaper" aria-controls="fullpaper" role="tab" data-toggle="tab">Τελικά κείμενα</a></li>
<li role="presentation" class=""><a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Κρίσεις</a></li>
<li role="presentation" class=""><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Μηνύματα</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="fullpaper">
<table class="table table-bordered table-striped {{ count($fullpapers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.fullpaper.fields.paper')</th>
            <th>@lang('quickadmin.fullpaper.fields.finaltext')</th>
                        <th>@lang('quickadmin.fullpaper.fields.description')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($fullpapers) > 0)
            @foreach ($fullpapers as $fullpaper)
                <tr data-entry-id="{{ $fullpaper->id }}">
                    <td field-key='paper'>{{ $fullpaper->paper->title or '' }}</td>
                                <td field-key='finaltext'>@foreach($fullpaper->getMedia('finaltext') as $media)
                                <p class="form-group">
                                    <a href="{{ "/storage/".$media->id."/".rawurlencode($media->file_name) }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                                <td field-key='description'>{{ $fullpaper->description }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('fullpaper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.restore', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('fullpaper_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.perma_del', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('fullpaper_view')
                                    <a href="{{ route('admin.fullpapers.show',[$fullpaper->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('fullpaper_edit')
                                    <a href="{{ route('admin.fullpapers.edit',[$fullpaper->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('fullpaper_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.fullpapers.destroy', $fullpaper->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="reviews">
<table class="table table-bordered table-striped {{ count($reviews) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.reviews.fields.user')</th>
                        <th>@lang('quickadmin.reviews.fields.review')</th>
                        <th>@lang('quickadmin.reviews.fields.comment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($reviews) > 0)
            @foreach ($reviews as $review)
                <tr data-entry-id="{{ $review->id }}">
                    <td field-key='user'>{{ $review->user->name or '' }}</td>
                                <td field-key='review'>{{ $review->review }}</td>
                                <td field-key='comment'>{!! $review->comment !!}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('review_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.restore', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('review_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.perma_del', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('review_view')
                                    <a href="{{ route('admin.reviews.show',[$review->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('review_edit')
                                    <a href="{{ route('admin.reviews.edit',[$review->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('review_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.reviews.destroy', $review->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="messages">
<table class="table table-bordered table-striped {{ count($messages) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.messages.fields.name')</th>
                        <th>@lang('quickadmin.messages.fields.title')</th>
                        <th>@lang('quickadmin.messages.fields.paper')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($messages) > 0)
            @foreach ($messages as $message)
                <tr data-entry-id="{{ $message->id }}">
                    <td field-key='name'>{{ $message->name }}</td>
                                <td field-key='title'>{{ $message->title }}</td>
                                <td field-key='paper'>{{ $message->paper->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('message_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.restore', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('message_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.perma_del', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('message_view')
                                    <a href="{{ route('admin.messages.show',[$message->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('message_edit')
                                    <a href="{{ route('admin.messages.edit',[$message->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('message_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.messages.destroy', $message->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.papers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
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
