{{--
	Template name: Provider Search Page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
        'isProviderSearch' => true
    ])
@endsection
