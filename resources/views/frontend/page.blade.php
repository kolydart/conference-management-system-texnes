@extends('frontend.app')

@section('title'){{$page->title}}@endsection

@section('content')

	{{$page->excerpt}}
	{{$page->page_text}}

@endsection