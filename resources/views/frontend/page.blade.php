@extends('frontend.app')

@section('title'){{$page->title}}@endsection

@section('content')

	@can('content_page_edit')
		<a href="{{route('admin.content_pages.edit',App\ContentPage::where('alias',$page->alias)->firstOrFail()->id)}}" class="btn btn-warning m-4 float-right"><i class="fa fa-edit"></i> @lang('Edit')</a>
	@endif
	{!!$page->excerpt!!}
	{!!$page->page_text!!}

@endsection