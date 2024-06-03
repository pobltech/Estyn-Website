{{--
	Template name: Inspection schedule page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isInspectionScheduleSearch' => true
	])
@endsection