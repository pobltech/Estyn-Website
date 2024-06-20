{{-- 
    Template name: Events page
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', $insideHeroPartialArgs)
    {{--@include('partials.inside-hero', [
        'title' => get_the_title(),
        'heroImageImgTag' => get_the_post_thumbnail(),
        'secondHeading' => __('Our events', 'sage'),
        'introContent' => '
            <p>Events are a key activity for Estyn. Our stakeholder events raise awareness of our work and offer thought leadership within the Welsh education sector. We arrange training both to become an Inspector and update training ensuring those attending inspections are as informed and as up to date as possible.</p>',
        'introImageID' => get_field('intro_image')
    ])--}}
<div class="reportMain pt-5 pb-5">
	<div class="container px-md-4 px-xl-5 mt-5">
        @include('partials.slider', [
            'carouselID' => 'estyn-events-carousel',
            'carouselHeading' => __('Upcoming events', 'sage'),
            'carouselHeadingNumber' => 2,
            'carouselDescription' => __('Our upcoming events from Estyn', 'sage'),
            'doNotDoJavaScript' => false,
            'carouselSectionClass' => 'pobl-tech-carousel-block pb-5',
            'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
            'carouselItems' => $eventsCarouselItems
        ])

        <div class="mb-md-5">
        @include('partials.cta', [
            'ctaHeading' => get_field('past_events_cta_heading'),
            'ctaCarouselItems' => $pastEventsCTACarouselItems,
        ])
        </div>
    </div>
</div>
@endsection