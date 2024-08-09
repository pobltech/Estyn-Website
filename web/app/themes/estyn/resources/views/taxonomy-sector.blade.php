@extends('layouts.app')

@section('content')
    @php
        $term = $term ?? get_queried_object();

        $heroImage = get_field('hero_image', $term);
        $heroImageID = null;
        $heroImageSrc = null;
        if(empty($heroImage)) {
            $heroImageSrc = asset('images/sectordefaulthero1.jpg');
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
            $introImageSrc = asset('images/sectordefaulthero1.jpg');
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
        'cropIntroImagePortrait' => true,
        'introLinks' => array_map(function($button) {
            return [
                'url' => $button['button_link_external'] ?: get_permalink($button['button_link'][0]->ID), // ACF Relationship field. Custom URL field has priority.
                'text' => $button['button_label']
            ];
        }, get_field('intro_buttons', $term) ?: []), // ACF Repeater field
    ])

    <div class="container px-md-4 px-xl-5 mt-5 pt-4 pt-sm-5">
        <div class="row pt-md-5">
            <div class="col-12">
                @include('partials.ways-to-improve', ['term' => $term, 'wtpTags' => $wtpTags, 'wtpTagLinkDotColours' => $wtpTagLinkDotColours])
                @if(!empty($sectorResourcesCarouselItems))
                    @include('partials.slider', [
                        'carouselID' => 'sector-resources-carousel',
                        'carouselHeading' => __('Featured ' . $term->name . ' resources', 'sage'),
                        'carouselHeadingNumber' => 3,
                        /*'carouselDescription' => __('The latest resources for the ' . $term->name . ' sector.', 'sage'),*/
                        'carouselButtonText' => __('All resources', 'sage'),
                        'carouselButtonLink' => App\get_permalink_by_template('template-search.blade.php') . '?sector=' . rawurlencode($term->name),
                        'carouselSectionClass' => 'pobl-tech-carousel-block mt-5 mb-5',
                        'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
                        'carouselItems' => $sectorResourcesCarouselItems,
                        'doNotDoJavaScript' => false
                    ])
                @endif
                {{--@include('partials.slider', [
                    'carouselID' => 'sector-resources-carousel',
                    'carouselHeading' => __('Featured ' . $term->name . ' resources', 'sage'),
                    'carouselHeadingNumber' => 3,
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
                ])--}}

                <div class="pt-md-5 pb-5">
                @include('partials.cta', [
                    'ctaHeading' => get_field('cta_heading', $term) ?? __('What to expect ahead of an inspection', 'sage'),
                    'ctaText' => get_field('cta_text', $term) ?? __('Our guide on what to expect during an inspection of your setting.', 'sage'),
                    'ctaButtonLinkURL' => (!empty(get_field('cta_button_link', $term))) ? get_field('cta_button_link', $term) : App\get_permalink_by_template('template-inspections.blade.php'),
                    'ctaButtonText' => get_field('cta_button_text', $term) ?? __('My inspection guide', 'sage'),
                    'ctaImageURL' => get_field('cta_image', $term) ?? asset('images/inspectionctaplaceholder.png'),
                    'ctaImageAlt' => get_field('cta_image_alt', $term) ?? __('Education in the ' . $term->name . ' sector', 'sage')
                ])
                </div>

                @if(!empty($sectorLatestArticlesCarouselItems))
                    <div class="pt-md-5">
                    @include('partials.slider', [
                        'carouselID' => 'sector-articles-carousel',
                        'carouselHeading' => __('Latest articles', 'sage'),
                        'carouselDescription' => __('Blog posts and news articles relating to the ' . $term->name . ' sector.', 'sage'),
                        'carouselButtonText' => __('All articles', 'sage'),
                        'carouselButtonLink' => App\get_permalink_by_template('template-news-and-blog.blade.php') . '?sector=' . rawurlencode($term->name),
                        'carouselSectionClass' => 'pobl-tech-carousel-block',
                        'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
                        'carouselItems' => $sectorLatestArticlesCarouselItems,
                        'doNotDoJavaScript' => false
                    ])
                    </div>
                @else
                    <div class="pt-md-5">
                    @include('partials.slider', [
                        'carouselID' => 'sector-articles-carousel',
                        'carouselHeading' => __('Latest articles', 'sage'),
                        'carouselDescription' => __('Our latest news and blog posts', 'sage'),
                        'carouselButtonText' => __('All articles', 'sage'),
                        'carouselButtonLink' => App\get_permalink_by_template('template-news-and-blog.blade.php'),
                        'carouselSectionClass' => 'pobl-tech-carousel-block',
                        'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
                        'carouselItems' => $latestNewsAndBlogPostsCarouselItems,
                        'doNotDoJavaScript' => false
                    ])
                    </div>                    
                @endif

                {{--@include('partials.slider', [
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
                ])--}}
                

                <div class="reportMain pt-md-5 pb-5">
                    <div class="container px-md-4 px-xl-5 pb-md-5">
                        @if(!empty($sectorLatestInspectionReports))
                            @include('partials.inspection-and-report-schedule', [
                                'inspectionReports' => $sectorLatestInspectionReports,
                            ])
                        @endif
                    </div>
                </div>
                {{--<div class="pb-5">
                @include('partials.cta', [
                    'ctaHeading' => __('Our education map of Wales', 'sage'),
                    'ctaText' => __('Find providers across Wales using our handy map', 'sage'),
                    'ctaButtonLinkURL' => App\get_permalink_by_template('provider-search.blade.php'),
                    'ctaButtonText' => __('Search the map', 'sage'),
                    'ctaImageURL' => asset('images/map.svg'),
                    'ctaImageAlt' => __('Map of Wales', 'sage'),
                    'imageBreakOut' => true,
                    'imageExtraClasses' => 'ctaSearchMap',
                    'showSearchBox' => true,
                    'ctaContainerExtraClasses' => 'ctaSearchMapContainer'
                ])
                </div>--}}
            </div>
        </div>
    </div>
@endsection