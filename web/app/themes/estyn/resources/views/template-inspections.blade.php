{{-- 
    Template name: Inspections
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [
        'title' => get_the_title(),
        'heroImageImgTag' => get_the_post_thumbnail(get_the_ID(), 'full') ?: '<img src="' . asset('attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg') . '" alt="Primary school children in red polo shirts, playing outside their school." />',
        'secondHeading' => get_field('inside_hero_heading') ?: __('Estyn inspections', 'sage'),
        'introContent' => get_field('inside_hero_content') ?: '
            <p>Estyn carry out inspections with the aim of improving the quality of education and training for all learners in Wales.</p>
            <p>We have a new approach to inspection across Wales. Rather than focusing on a grading, our reports will detail how well providers are helping learners to learn.</p>
            <a class="btn btn-outline-primary">The current inspection process</a><br/>
            <a class="btn btn-outline-primary">Inspection from 2024-2030</a>
        ',
        'introImageSrc' => get_field('inside_hero_image') ? get_field('inside_hero_image')['url'] : asset('images/cta-example.png'),
        'introImageAlt' => get_field('inside_hero_image') ? get_field('inside_hero_image')['alt'] : 'A cartoon hand is holding a phone or tablet which is displaying some questionnaire data, while some cheerful people are pointing at it and discussing it.',
        'introLinks' => array_map(function($button) {
            return [
                'url' => $button['custom_url'] ?: get_permalink($button['content_to_link_to'][0]->ID), // ACF Relationship field. Custom URL field has priority.
                'text' => $button['text']
            ];
        }, get_field('inside_hero_buttons') ?: []), // ACF Repeater field
    ])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5 pt-md-5">
        @include('partials.inspection-and-report-schedule')
        <div class="mt-5 pt-5">
        @include('partials.slider', [
            'carouselID' => 'inspections-page-carousel',
            'carouselHeading' => __('Guidance & frameworks', 'sage'),
            'carouselDescription' => __('Access all our guidance and frameworks', 'sage'),
            'carouselButtonText' => __('All guidance & frameworks', 'sage'),
            'doNotDoJavaScript' => false,
            'carouselSectionClass' => 'pobl-tech-carousel-block',
            'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
            'carouselItems' => [
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ],
                [
                    'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                    'title' => 'Attendance and attitudes to learning',
                    'excerpt' => 'Attendance and attitudes to learning are important factors in learners’ achievement and wellbeing.'
                ]
            ]
        ])
        </div>

        <div class="mt-5 pt-md-5 pb-md-5">
        @include('partials.cta', [
            'ctaHeading' => __('Inspection Questionnaires', 'sage'),
            'ctaText' => __('Been asked to fill out an inspection questionnaire?', 'sage'),
            'ctaButtonLinkURL' => App\get_permalink_by_template('template-inspection-questionnaires-search.blade.php'),
            'ctaButtonText' => __('View questionnaires', 'sage'),
            'ctaImageURL' => asset('images/cta-example.png'),
            'ctaImageAlt' => __('A cartoon hand is holding a phone or tablet which is displaying some questionnaire data, while some cheerful people are pointing at it and discussing it.', 'sage')
        ])
        </div>

        <div class="row mt-5 pb-5 mb-5">
            <div class="col-12 col-sm-6">
                <h2>{{ __('Feedback', 'sage') }}</h2>
                <p>{{ __('Have something to share? Your suggestions, compliments and complaints help us to improve.', 'sage') }}</p>
                <a class="btn btn-outline-primary" href="{!! App\get_permalink_by_template('template-inspection-schedule-search-page.blade.php') !!}">{{ __('View the full inspection schedule', 'sage') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection