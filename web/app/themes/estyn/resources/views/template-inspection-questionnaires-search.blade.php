{{--
	Template name: Inspection Questionnaires Search Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isInspectionQuestionnairesSearch' => true
	])
@endsection