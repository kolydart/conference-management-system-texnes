@extends('frontend.app')

@section('content')
	
	@can('content_page_edit')
		<a href="{{route('admin.content_pages.edit',3)}}" class="btn btn-warning btn-sm m-4"><i class="fa fa-edit"></i> @lang('Edit')</a>
	@endif

	@php
		$homePage = App\ContentPage::where('alias','home')->first();
	@endphp
	
	@if ($homePage)
		@if (Auth::check())
			{!! str_replace('href="/register"', 'href="/page/faq"', $homePage->page_text) !!}
		@else
			{!! $homePage->page_text !!}
		@endif
	@else
		<div class="alert alert-info">
			<h2>Καλώς ήρθατε</h2>
			<p>Η αρχική σελίδα δεν έχει ρυθμιστεί ακόμα.</p>
		</div>
	@endif

	
@endsection