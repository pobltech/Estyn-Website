@extends('layouts.app')

@section('content')
    @php
        $term = $term ?? get_queried_object();

        $heroImage = get_field('hero_image', $term);
        $heroImageID = null;
        $heroImageSrc = null;
        if(empty($heroImage)) {
            $heroImageSrc = asset('images/sectordefaulthero.jpg');
            $heroImageAlt = __('Education in the ' . $term->name . ' sector', 'sage');
        } else {
            $heroImageID = $heroImage['ID'];
            $heroImageSrc = $heroImage['url'];
            $heroImageAlt = $heroImage['alt'];
        }

        $introImage = get_field('intro_image', $term);
        $introImageID = null;
        $introImageSrc = null;
        if(empty($introImage)) {
            $introImageSrc = asset('images/sectordefaulthero.jpg');
            $introImageAlt = __('Education in the ' . $term->name . ' sector', 'sage');
        } else {
            $introImageID = $introImage['ID'];
            $introImageSrc = $introImage['url'];
            $introImageAlt = $introImage['alt'];
        }


    @endphp
    @include('partials.inside-hero', [
        'title' => $term->name,
        'super' => __('Education Sector', 'sage'),
        'heroImageSrc' => $heroImageSrc,
        'heroImageAlt' => $heroImageAlt,
        'heroImageID' => $heroImageID,
        'secondHeading' => __('Education in the ' . $term->name . ' sector', 'sage'),
        'introContent' => (!empty(get_field('intro_summary', $term))) ? get_field('intro_summary', $term) : '<p>' . __('Information about the ' . $term->name . ' sector in Wales.') . '</p><p>' . __('Find out more about what Estyn can do to help ' . $term->name . ' sector providers, and where to find guidance and news', 'sage') . '</p>',
        'introImageSrc' => $introImageSrc,
        'introImageAlt' => $introImageAlt,
        'introImageID' => $introImageID,
        'cropIntroImagePortrait' => true
    ])

    <div class="container px-md-4 px-xl-5 mt-5 pt-4 pt-sm-5">
        <div class="row">
            <div class="col-12">
                @include('partials.ways-to-improve', ['term' => $term, 'wtpTags' => $wtpTags, 'wtpTagLinkDotColours' => $wtpTagLinkDotColours])
                @include('partials.slider', [
                    'carouselID' => 'sector-resources-carousel',
                    'carouselHeading' => __('Featured ' . $term->name . ' resources', 'sage'),
                    'carouselDescription' => __('The latest resources for the ' . $term->name . ' sector.', 'sage'),
                    'carouselButtonText' => __('All resources', 'sage'),
                    'carouselSectionClass' => 'pobl-tech-carousel-block mt-5 mb-5',
                    'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
                    'carouselItems' => [
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ]
                    ],
                    'doNotDoJavaScript' => false
                ])

                @include('partials.cta', [
                    'ctaHeading' => get_field('cta_heading', $term) ?? __('What to expect ahead of an inspection', 'sage'),
                    'ctaText' => get_field('cta_text', $term) ?? __('Our guide on what to expect during an inspection of your setting.', 'sage'),
                    'ctaButtonLinkURL' => get_field('cta_button_link', $term) ?? '#',
                    'ctaButtonText' => get_field('cta_button_text', $term) ?? __('My inspection guide', 'sage'),
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
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
                        ],
                        [
                            'featured_image_src' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
                            'title' => 'Attendance and attitudes to learning',
                            'excerpt' => 'Attendance and attitudes to learning are important factors in learners\' achievement and wellbeing.'
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
                    <div class="container px-md-4 px-xl-5">
                        @include('partials.inspection-and-report-schedule')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection