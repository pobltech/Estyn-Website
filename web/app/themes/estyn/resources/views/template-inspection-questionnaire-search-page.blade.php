{{--
	Template name: Inspection Questionnaires search page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isInspectionQuestionnairesSearch' => true
	])
@endsection