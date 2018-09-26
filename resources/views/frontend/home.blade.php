@extends('frontend.app')

@section('content')
	
	@can('content_page_edit')
		<a href="{{route('admin.content_pages.edit',3)}}" class="btn btn-warning btn-sm m-4"><i class="fa fa-edit"></i> @lang('Edit')</a>
	@endif

	@if (Auth::check())
		{!! str_replace('href="/register"', 'href="/page/faq"', App\ContentPage::where('alias','home')->first()->page_text); !!}
	@else
		{!! App\ContentPage::where('alias','home')->first()->page_text !!}
	@endif

	
@endsection