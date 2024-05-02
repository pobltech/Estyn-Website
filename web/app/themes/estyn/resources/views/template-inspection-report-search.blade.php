{{--
	Template name: Latest Inspection Reports page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isInspectionReportsSearch' => true
	])
@endsection