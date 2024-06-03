{{--
	Template name: Annual Reports Archive Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isAnnualReportsSearch' => true
	])
@endsection