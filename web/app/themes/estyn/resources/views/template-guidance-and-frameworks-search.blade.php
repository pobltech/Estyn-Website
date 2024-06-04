{{--
	Template name: Guidance & Frameworks Search Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isGuidanceAndFrameworksSearch' => true
	])
@endsection