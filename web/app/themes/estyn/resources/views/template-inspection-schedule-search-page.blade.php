{{--
	Template name: Inspection schedule page
 --}}
@extends('layouts.app')

@section('content')
	@php
		// Get all the 'Local Authority' terms
		$localAuthorities = get_terms([
			'taxonomy' => 'local_authority',
			'hide_empty' => false,
		]);

		// Get all the 'Sector' terms
		$sectors = get_terms([
			'taxonomy' => 'sector',
			'hide_empty' => false,
		]);
	@endphp

	@include('partials.search-page', [
		'isInspectionScheduleSearch' => true
	])
@endsection