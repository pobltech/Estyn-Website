{{--
  Template Name: Front Page
--}}

@extends('layouts.app')

@section('content')
  <div class="homeHero">
    <div class="container h-100 w-100 d-flex align-items-end mb-5 pb-5 px-md-4 px-xl-5">
      <div class="row flex-fill">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 homeHeroContent">
          <h1>Placing learners at the heart of our work</h1>
          <a class="btn btn-link mt-4">Read more about what we do <i class="fa-sharp fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <div class="heroImage">
      <img src="https://annual-report.estyn.gov.wales/app/uploads/2023/12/attendance-and-attitudes-to-learning-photo-2-BPF-ESP-55.jpg"/>
    </div>
    <div class="heroOverlay"></div>
  </div>
  <!-- Arc for larger screens -->
  <div class="insideIntroArc position-relative w-100 d-none d-md-block">
    <svg width="1600" height="71" viewBox="0 0 1600 71" preserveAspectRatio="none">
      <path d=
      "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v16.4H0V54.7z" 
      fill="#2A7AB0" />
    </svg>
  </div>
  <!-- Arc for smaller screens -->
  <div class="insideIntroArc position-relative w-100 d-block d-md-none">
    <svg width="1600" height="35" viewBox="0 0 1600 71" preserveAspectRatio="none">
      <path d=
      "M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v16.4H0V54.7z" 
      fill="#2A7AB0" />
    </svg>
  </div>
  <div class="homeIntro position-relative w-100">
    <div class="container px-md-4 px-xl-5">
      <div class="row d-flex justify justify-content-center">
        <div class="col-12 my-5">
          <div class="row">
            <div class="col-12 col-md-6 homeProviderCol">
              <div class="row">
                <div class="col-12 col-md-10">
                  <h2>Find a provider</h2>
                  <label for="providerSearch" class="form-label">Search our education & training providers</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="" aria-label="providerSearch" aria-describedby="providerSearch">
                    <button class="btn btn-secondary" type="button" id="providerSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-5 offset-md-1">
              <h2>Estyn for you</h2>
              <p>Search our education & training providers</p>
              <div class="d-flex align-items-start flex-column flex-xxl-row">
                <a class="btn btn-outline-light me-4 mb-3">Parents, carers & learners</a>
                <a class="btn btn-outline-light me-4 mb-3">Education professionals</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.signposting')
  @include('partials.cta', [
    'ctaHeading' => 'Who are Estyn?',
    'ctaText' => 'Estyn inspects education and training in Wales. Find out how and why we exist, and our vision for education in Wales',
    'ctaButtonLinkURL' => '/about-us',
    'ctaButtonText' => 'About Estyn',
    'ctaImageURL' => @asset('images/inspection1.png'),
    'ctaImageAlt' => 'Estyn inspection'
  ])

  @php
    $query1 = new WP_Query([
      'post_type' => 'post',
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
    'carouselID' => 'estyn-home-carousel',
    'carouselHeading' => 'Ways to improve',
    'carouselDescription' => 'Our most recent resources to help you improve your setting',
    'carouselButtonText' => 'All resources',
    'carouselItems' => $sliderItems,
    'doNotDoJavaScript' => false
  ])

{{-- 'Our work' section (old design) --}}
{{--
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
--}}
  @include('partials.cta', [
    'ctaHeading' => 'Our education map of Wales',
    'ctaText' => 'Find providers across Wales using our handy map',
    'ctaButtonLinkURL' => '/news',
    'ctaButtonText' => 'Search the map',
    'ctaImageURL' => asset('images/map.svg'),
    'ctaImageAlt' => 'Map of Wales',
    'imageBreakOut' => true,
    'imageExtraClasses' => 'ctaSearchMap',
    'showSearchBox' => true,
    'darkArc' => true
  ])

@include('partials.slider', [
    'carouselID' => 'estyn-home-latest-news-carousel',
    'carouselHeading' => 'Latest articles',
    'carouselDescription' => 'Blog posts and news articles from Estyn',
    'carouselButtonText' => 'All articles',
    'carouselItems' => $sliderItems,
    'doNotDoJavaScript' => false
  ])

  @while(have_posts()) @php(the_post())
    {{-- @include('partials.content-page') --}}
  @endwhile
@endsection
