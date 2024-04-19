{{-- 
    Template name: Inspections
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [
        'title' => __('Inspections', 'sage'),
        'heroImageSrc' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
        'heroImageAlt' => 'Attendance and attitudes to learning photo 2 BPF ESP 55',
        'secondHeading' => __('Estyn inspections', 'sage'),
        'introContent' => '
            <p>Estyn carry out inspections with the aim of improving the quality of education and training for all learners in Wales.</p>
            <p>We have a new approach to inspection across Wales. Rather than focusing on a grading, our reports will detail how well providers are helping learners to learn.</p>
            <a class="btn btn-outline-primary">The current inspection process</a><br/>
            <a class="btn btn-outline-primary">Inspection from 2024-2030</a>
        ',
        'introImageSrc' => asset('images/cta-example.png'),
        'introImageAlt' => 'CTA example'
    ])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5 pt-5">
        <div class="row pt-5">
            <div class="col-12">
                <h2>{{ __('Inspection and report schedule', 'sage') }}</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <h3>{{ __('Inspection schedule', 'sage') }}</h3>
                @include('components.resource-list', ['items' => [
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ]
                ]])
                <a class="btn btn-outline-primary" href="#">{{ __('View the full inspection schedule', 'sage') }}</a>
            </div>
            <div class="col-12 col-md-6">
                <h3>{{ __('Latest inspection reports', 'sage') }}</h3>
                @include('components.resource-list', ['items' => [
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ],
                    [
                        'linkURL' => '#',
                        'superText' => 'Adult Learning in the Community',
                        'superDate' => '05/02/2024',
                        'title' => 'Ceredigion Adult Learning in the Community Partnership'
                    ]
                ]])
                <a class="btn btn-outline-primary" href="#">{{ __('See all inspection reports', 'sage') }}</a>
            </div>
        </div>
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
        @include('partials.cta', [
            'ctaHeading' => __('Inspection Questionnaires', 'sage'),
            'ctaText' => 'Been asked to fill out an inspection questionnaire?',
            'ctaButtonLinkURL' => '#',
            'ctaButtonText' => __('View questionnaires', 'sage'),
            'ctaImageURL' => asset('images/cta-example.png'),
            'ctaImageAlt' => 'CTA example'
        ])

        <div class="row">
            <div class="col-12 col-sm-4">
                <h2>{{ __('Feedback', 'sage') }}</h2>
                <p>Have something to share? Your suggestions, compliments and complaints help us to improve.</p>
                <a class="btn btn-outline-primary" href="#">{{ __('View the full inspection schedule', 'sage') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection