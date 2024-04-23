{{-- 
    Template name: About page
--}}
@extends('layouts.app')
@section('content')
    @include('partials.inside-hero', [
        'title' => __('About Estyn', 'sage'),
        'heroImageSrc' => 'https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg',
        'heroImageAlt' => 'Attendance and attitudes to learning photo 2 BPF ESP 55',
        'secondHeading' => __('What do we do?', 'sage'),
        'introContent' => '
            <p>We want to make learning and training in Wales the best it can be for everyone.</p>
            <p>Our priority is to help our community to keep getting better by guiding them and giving them the tools to improve.</p>
            <a class="btn btn-outline-primary">Learn about Improvement</a><br/>
            <a class="btn btn-outline-primary">Learn about Inspections</a>
        ',
        'introImageSrc' => asset('images/cta-example.png'),
        'introImageAlt' => 'CTA example'
    ])
<div class="reportMain">
	<div class="container px-md-4 px-xl-5 pt-5">
        <h2>{{ __('Who are we?', 'sage') }}</h2>
        <p>{{ __('We\'re the Education and Training Inspectorate for Wales. Meet the Chief Inspector and his team.', 'sage') }}</p>

        @include('partials.slider', [
            'carouselID' => 'estyn-meet-the-team-carousel',
            'carouselHeading' => __('Meet the team', 'sage'),
            'carouselDescription' => null,
            'carouselButtonText' => __('Button?', 'sage'),
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
    <div class="w-100 bg-lightblue">
        <div class="container py-5 px-md-4 px-xl-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h2 class="mb-3 mb-md-4">Our work</h2>
                        <p>A short description of this section</p>
                    </div>
                </div>
                <div class="row">
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-4">
                        <div class="landscapeImg mb-4">
                            <img src="https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-4">
                        <div class="landscapeImg mb-4">
                            <img src="https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-4">
                        <div class="landscapeImg mb-4">
                            <img src="https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                    <!-- Box -->
                    <div class="col-12 col-md-6 py-4">
                        <div class="landscapeImg mb-4">
                            <img src="https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg" alt=""/>
                        </div>
            <h4 class="mb-0">Title</h4>
            <p>Desc</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
          'excerpt' => get_the_excerpt()
        ];
      }

      wp_reset_postdata();
    }

    // For TESTING: Append a copy of $sliderItems to $sliderItems to make the carousel longer
    $sliderItems = array_merge($sliderItems, $sliderItems);
  @endphp
  @include('partials.slider', [
    'carouselID' => 'estyn-home-latest-news-carousel',
    'carouselHeading' => 'Latest articles',
    'carouselDescription' => 'Blog posts and news articles from Estyn',
    'carouselButtonText' => 'All articles',
    'carouselItems' => $sliderItems,
    'doNotDoJavaScript' => false
  ])
    <div class="container px-md-4 px-xl-5 pt-5">
        <?php
            // TODO: Multiple buttons in CTA
        ?>
        @include('partials.cta', [
            'ctaHeading' => __('Working for us', 'sage'),
            'ctaText' => __('Our staff include corporate services, HMI and contracted trained inspectors.', 'sage'),
            'ctaButtonLinkURL' => '#',
            'ctaButtonText' => __('Vacancies', 'sage'),
            'ctaImageURL' => asset('images/cta-example.png'),
            'ctaImageAlt' => 'CTA example'
        ])

        <div class="row">
            <div class="col-12 col-sm-4">
                <h2>{{ __('Get in touch', 'sage') }}</h2>
                <p>{{ __('Whatever you need, get in touch', 'sage') }}.</p>
                <a class="btn btn-outline-primary" href="#">{{ __('General inquiries', 'sage') }}</a>
                <a class="btn btn-outline-primary" href="#">{{ __('Feedback', 'sage') }}</a>
                <a class="btn btn-outline-primary" href="#">{{ __('Contact the press office', 'sage') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection