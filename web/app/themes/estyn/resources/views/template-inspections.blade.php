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
        'cropIntroImagePortrait' => true
    ])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5 pt-md-5">
        @if(!empty($latestInspectionReportsResourceListItems))
            @include('partials.inspection-and-report-schedule', [
                'inspectionReports' => $latestInspectionReportsResourceListItems,
                'inspectionsScheduleListItems' => $inspectionScheduleResourceListItems,
            ])
        @endif
        <div class="mt-5 pt-5">
        @if(!empty($inspectionGuidancePostsCarouselItems))
            @include('partials.slider', [
                'carouselID' => 'inspections-page-carousel',
                'carouselHeading' => __('Guidance & frameworks', 'sage'),
                'carouselDescription' => __('Access all our guidance and frameworks', 'sage'),
                'carouselButtonText' => __('All guidance & frameworks', 'sage'),
                'carouselButtonLink' => App\get_permalink_by_template('template-inspection-guidance-search-page.blade.php'),
                'doNotDoJavaScript' => false,
                'carouselSectionClass' => 'pobl-tech-carousel-block',
                'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
                'carouselItems' => $inspectionGuidancePostsCarouselItems
            ])
        @endif
        {{--@include('partials.slider', [
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
        ])--}}
        </div>

        <div class="mt-5 pt-md-5 pb-md-5">
        @include('partials.cta', [
            'ctaHeading' => get_field('inspections_cta_heading'),
            'ctaContent' => get_field('inspections_cta_text'),
            /*'ctaButtonLinkURL' => \App\get_permalink_by_template('template-vacancies.blade.php'),
            'ctaButtonText' => __('Vacancies', 'sage'),*/
            'ctaImageURL' => get_field('inspections_cta_image')['url'],
            'ctaImageAlt' => get_field('inspections_cta_image')['alt'],
            'ctaButtons' => array_map(function($button) {
                return [
                    // NOTE: external_link is a text field, link is post object (from ACF relationship field with max 1 post allowed)
                    'link' => empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'],
                    'text' => $button['label']
                ];
            }, get_field('inspections_cta_buttons'))
        ])
        </div>

        <div class="row mt-5 pb-5 mb-5">
            <div class="col-12 col-sm-6">
                <h2>{{ get_field('inspections_bottom_content_heading') }}</h2>
                {!! get_field('inspections_bottom_content_text') !!}
                @if(get_field('inspections_bottom_content_buttons'))
                    @foreach(get_field('inspections_bottom_content_buttons') as $button)
                        <a class="btn btn-outline-primary mb-3 me-3" href="{{ empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'] }}">{{ $button['label'] }}</a>
                    @endforeach
                @endif
                {{--<h2>{{ __('Feedback', 'sage') }}</h2>
                <p>{{ __('Have something to share? Your suggestions, compliments and complaints help us to improve.', 'sage') }}</p>
                <a class="btn btn-outline-primary" href="{!! App\get_permalink_by_template('template-inspection-schedule-search-page.blade.php') !!}">{{ __('View the full inspection schedule', 'sage') }}</a>--}}
            </div>
        </div>
    </div>
</div>
@endsection