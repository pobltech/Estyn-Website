{{--
	Template name: Improvement Resources Search Page
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

		// Get all the tags
		$tags = get_terms([
			'taxonomy' => 'post_tag',
			'hide_empty' => false,
		]);
	@endphp
	@include('partials.search-page', [
		'isImprovementResourcesSearch' => true,
		'localAuthorities' => $localAuthorities,
		'sectors' => $sectors,
		'tags' => $tags
	])
@endsection
