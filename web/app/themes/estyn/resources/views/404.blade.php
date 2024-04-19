@extends('layouts.app')

@section('content')
  @include('partials.page-header')
<div class="reportMain">
	<div class="container px-md-4 px-xl-5">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-8">
            <div class="row">
              <div class="col-12">
  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, but the page you are trying to view does not exist.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif
              </div>
            </div>
      </div>
    </div>
  </div>
@endsection
