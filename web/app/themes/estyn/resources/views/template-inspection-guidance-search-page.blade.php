{{--
	Template name: Inspection guidance search page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isInspectionGuidanceSearch' => true
	])
@endsection