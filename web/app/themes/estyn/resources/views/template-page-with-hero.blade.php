{{-- 
    Template name: General Page with Hero
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', $insideHeroPartialArgs)

    <div class="reportMain pt-md-5 pb-5">
        <div class="container px-md-4 px-xl-5 mt-5 pb-md-5">
            @while(have_posts()) @php(the_post())
                @php(the_content())
            @endwhile
        </div>
    </div>
@endsection