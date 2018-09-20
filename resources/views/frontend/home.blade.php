@extends('frontend.app')

@section('content')

	{!! App\ContentPage::where('alias','home')->first()->page_text !!}
	
@endsection