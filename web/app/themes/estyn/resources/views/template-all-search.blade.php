{{--
	Template name: All Search Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isAllSearch' => true
	])
@endsection