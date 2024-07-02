{{-- 
    Template name: About page
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', $insideHeroPartialArgs)
    {{--@include('partials.inside-hero', [
        'title' => __('About Estyn', 'sage'),
        'heroImageImgTag' => get_the_post_thumbnail(),
        'secondHeading' => __('What do we do?', 'sage'),
        'introContent' => '
            <p>We want to make learning and training in Wales the best it can be for everyone.</p>
            <p>Our priority is to help our community to keep getting better by guiding them and giving them the tools to improve.</p>',
        'introLinks' => [
            [ 'url' => '#', 'text' => 'Learn about Improvement'],
            [ 'url' => '#', 'text' => 'Learn about Inspections']
        ],
        'introImageID' => get_field('intro_image')
    ])--}}
<div class="reportMain pt-md-5">
	<div class="container px-md-4 px-xl-5 mt-5">
        {{--<h2>{{ __('Who are we?', 'sage') }}</h2>
        <p>{{ __('We\'re the Education and Training Inspectorate for Wales.', 'sage') }}<br/>
        {{ __('Meet the Chief Inspector and his team.', 'sage') }}</p>--}}
        {!! get_the_content() !!}

        @include('partials.slider', [
            'carouselID' => 'estyn-meet-the-team-carousel',
            'carouselHeading' => __('Meet the team', 'sage'),
            'carouselHeadingNumber' => 3,
            'carouselDescription' => null,
            'carouselLeftButtons' => array_map(function($teamMemberCategory) {
                return [
                    'link' => '#',
                    'text' => $teamMemberCategory->name,
                    'slug' => $teamMemberCategory->slug,
                    'id' => $teamMemberCategory->term_id
                ];
            }, $teamMemberCategories),
            'dynamicFiltering' => true,
            'doNotDoJavaScript' => false,
            'carouselSectionClass' => 'pobl-tech-carousel-block pb-5',
            'carouselSliderWrapperClass' => 'pobl-tech-carousel-block-slider',
            'carouselItems' => $teamMembersCarouselItems
        ])
        {{--@include('partials.slider', [
            'carouselID' => 'estyn-meet-the-team-carousel',
            'carouselHeading' => __('Meet the team', 'sage'),
            'carouselHeadingNumber' => 3,
            'carouselDescription' => null,
            'carouselLeftButtons' => [
                [
                    'link' => '#',
                    'text' => __('Strategic directors', 'sage')
                ],
                [
                    'link' => '#',
                    'text' => __('Assistant directors', 'sage')
                ],
                [
                    'link' => '#',
                    'text' => __('Non-executive directors', 'sage')
                ]
            ],
            'doNotDoJavaScript' => false,
            'carouselSectionClass' => 'pobl-tech-carousel-block pb-5',
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
    @include('partials.our-work')
  @php
    $query1 = new WP_Query([
      'post_type' => 'estyn_newsarticle',
      'posts_per_page' => 10,
      'status' => 'publish'
    ]);

    $sliderItems = [];

    if($query1->have_posts()) {
      while($query1->have_posts()) {
        $query1->the_post();
        // Do something with the post data
        $sliderItems[] = [
          'featured_image_src' => get_the_post_thumbnail_url(),
          'title' => get_the_title(),
          'excerpt' => get_the_excerpt(),
            'link' => get_the_permalink()
        ];
      }

      wp_reset_postdata();
    }

    // For TESTING: Append a copy of $sliderItems to $sliderItems to make the carousel longer
    //$sliderItems = array_merge($sliderItems, $sliderItems);
  @endphp
  @include('partials.slider', [
    'carouselID' => 'estyn-home-latest-news-carousel',
    'carouselHeading' => __('Latest articles', 'sage'),
    'carouselDescription' => __('Blog posts and news articles from Estyn', 'sage'),
    'carouselButtonText' => __('All articles', 'sage'),
    'carouselButtonLink' => \App\get_permalink_by_template('template-news-and-blog.blade.php'),
    'carouselItems' => $sliderItems,
    'doNotDoJavaScript' => false,
    'carouselSectionClass' => 'pobl-tech-carousel-block py-md-5',
  ])
    <div class="container px-md-4 px-xl-5 pt-5">
        <div class="mb-md-5">
        @include('partials.cta', [
            'ctaHeading' => get_field('about_cta_heading'),
            'ctaContent' => get_field('about_cta_text'),
            /*'ctaButtonLinkURL' => \App\get_permalink_by_template('template-vacancies.blade.php'),
            'ctaButtonText' => __('Vacancies', 'sage'),*/
            'ctaImageURL' => get_field('about_cta_image')['url'],
            'ctaImageAlt' => get_field('about_cta_image')['alt'],
            'ctaButtons' => array_map(function($button) {
                return [
                    // NOTE: external_link is a text field, link is post object (from ACF relationship field with max 1 post allowed)
                    'link' => empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'],
                    'text' => $button['label']
                ];
            }, get_field('about_cta_buttons'))
        ])
        </div>

        <div class="row pt-md-5 pb-5">
            <div class="col-12 col-sm-4">
                <h2>{{ get_field('about_bottom_content_heading') }}</h2>
                {!! get_field('about_bottom_content_text') !!}
                @if(get_field('about_bottom_content_buttons'))
                    @foreach(get_field('about_bottom_content_buttons') as $button)
                        <a class="btn btn-outline-primary mb-3 me-3" href="{{ empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'] }}">{{ $button['label'] }}</a>
                    @endforeach
                @endif

                {{--<a class="btn btn-outline-primary me-3 mb-3" href="#">{{ __('General inquiries', 'sage') }}</a>
                <a class="btn btn-outline-primary mb-3" href="#">{{ __('Feedback', 'sage') }}</a>
                <a class="btn btn-outline-primary" href="#">{{ __('Contact the press office', 'sage') }}</a>--}}
            </div>
        </div>
    </div>
</div>
@endsection