@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.content-pages.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.title')</th>
                            <td field-key='title'>{{ $content_page->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.alias')</th>
                            <td field-key='alias'>{{ $content_page->alias }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.category-id')</th>
                            <td field-key='category_id'>
                                @foreach ($content_page->category_id as $singleCategoryId)
                                    <span class="label label-info label-many">{{ $singleCategoryId->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.page-text')</th>
                            <td field-key='page_text'>{!! $content_page->page_text !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.excerpt')</th>
                            <td field-key='excerpt'>{!! $content_page->excerpt !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.featured-image')</th>
                            <td field-key='featured_image'>@if($content_page->featured_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $content_page->featured_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $content_page->featured_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.content-pages.fields.tag-id')</th>
                            <td field-key='tag_id'>
                                @foreach ($content_page->tag_id as $singleTagId)
                                    <span class="label label-info label-many">{{ $singleTagId->title }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>
@can('content_page_edit')
    <a href="{{ route('admin.content_pages.edit',[$content_page->id]) }}" class="btn btn-info">@lang('quickadmin.qa_edit')</a>
@endcan
<p>&nbsp;</p>

            <a href="{{ route('admin.content_pages.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
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
