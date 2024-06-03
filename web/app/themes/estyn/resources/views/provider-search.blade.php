{{--
	Template name: Providers Search Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isProviderSearch' => true
	])
@endsection
