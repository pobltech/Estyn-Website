@extends('layouts.app')

@section('content')
    @php
        $term = get_queried_object();
    @endphp
    @include('partials.inside-hero', [
        'title' => $term->name,
        'super' => __('Education Sector', 'sage'),
        'heroImageSrc' => get_field('hero_image', $term) ?? asset('images/sectordefaulthero.jpg'),
        'heroImageAlt' => get_field('hero_image_alt', $term) ?? $term->name,
        'secondHeading' => __('Education in the ' . $term->name . ' sector', 'sage'),
        'introContent' => get_field('intro_summary', $term) ?? __('Find out what Estyn can do to help providers in the ' . $term->name . ' sector.', 'sage'),
        'introImageSrc' => get_field('intro_image', $term) ?? asset('images/sectordefaultintro.jpg'),
        'introImageAlt' => get_field('intro_image_alt', $term) ?? __('Education in the ' . $term->name . ' sector', 'sage'),
    ])

    <div class="container px-md-4 px-xl-5 mt-5 pt-sm-5">
        <div class="row mt-5">
            <div class="col-12">
                @include('partials.ways-to-improve')
                @include('partials.slider', [
                    'carouselID' => 'sector-resources-carousel',
                    'carouselHeading' => __('Featured secondary resources', 'sage'),
                    'carouselDescription' => __('The latest resources for the ' . $term->name . ' sector.', 'sage'),
                    'carouselButtonText' => __('All resources', 'sage'),
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
                    ],
                    'doNotDoJavaScript' => false
                ])

                @include('partials.cta', [
                    'ctaHeading' => get_field('cta_heading', $term) ?? __('Find out more about Estyn', 'sage'),
                    'ctaText' => get_field('cta_text', $term) ?? __('Find out what Estyn can do to help providers in the ' . $term->name . ' sector.', 'sage'),
                    'ctaButtonLinkURL' => get_field('cta_button_link', $term) ?? '#',
                    'ctaButtonText' => get_field('cta_button_text', $term) ?? __('Find out more', 'sage'),
                    'ctaImageURL' => get_field('cta_image', $term) ?? asset('images/inspection1.png'),
                    'ctaImageAlt' => get_field('cta_image_alt', $term) ?? __('Education in the ' . $term->name . ' sector', 'sage')
                ])

                @include('partials.slider', [
                    'carouselID' => 'sector-articles-carousel',
                    'carouselHeading' => __('Latest articles', 'sage'),
                    'carouselDescription' => __('Blog posts and news articles relating to the ' . $term->name . ' sector.', 'sage'),
                    'carouselButtonText' => __('All articles', 'sage'),
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
                    ],
                    'doNotDoJavaScript' => false
                ])
                
                @include('partials.cta', [
                    'ctaHeading' => 'Our education map of Wales',
                    'ctaText' => 'Find providers across Wales using our handy map',
                    'ctaButtonLinkURL' => '#',
                    'ctaButtonText' => 'Search the map',
                    'ctaImageURL' => asset('images/map.svg'),
                    'ctaImageAlt' => 'Map of Wales',
                    'imageBreakOut' => true,
                    'imageExtraClasses' => 'ctaSearchMap',
                    'showSearchBox' => true
                ])
                <div class="reportMain">
                    <div class="container px-md-4 px-xl-5 pt-5">
                        @include('partials.inspection-and-report-schedule')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection