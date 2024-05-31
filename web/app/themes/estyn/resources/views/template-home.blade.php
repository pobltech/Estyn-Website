{{--
  Template Name: Front Page
--}}

@extends('layouts.app')

@section('content')
  <div class="homeHero">
    <div class="container h-100 w-100 d-flex align-items-end mb-5 pb-5 px-md-4 px-xl-5">
      <div class="row flex-fill">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6 homeHeroContent">
          <h1>{{ get_field('home_hero_heading') }}</h1>
          <a href="{{ get_permalink(get_field('home_hero_subheading_text_page_to_link_to')) }}" class="btn btn-link mt-1">{{ get_field('home_hero_subheading_text') }} <i class="fa-sharp fa-solid fa-arrow-right"></i></a>
        </div>
      </div>
    </div>
    <div class="heroImage">
      {{-- If there's a featured image, we'll use Wordpress' function, otherwise we use asset('images/homeherofallback.png') --}}
      @if(has_post_thumbnail())
        {!! the_post_thumbnail('full') !!}
      @else
        <img src="{{ asset('images/homeherofallback.png') }}" alt="{{ __('Several children in a bright, Chemistry classroom') }}" />
      @endif
    </div>
    <div class="heroOverlay"></div>
  </div>
  <!-- Arc for larger screens -->
  <div id="homeInsideIntroArcLarge" class="insideIntroArc position-relative w-100 d-none d-md-block">
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
  <div id="homeIntro" class="homeIntro position-relative w-100">
    <div class="container px-md-4 px-xl-5">
      <div class="row d-flex justify justify-content-center">
        <div class="col-12 my-4 my-sm-5">
          <div class="row">
            <div id="homeProviderCol" class="col-12 col-md-6 homeProviderCol">
              <div class="row">
                <div class="col-12 col-md-10">
                  <h2 class="mb-0 mb-sm-2">{{ __('Find a provider', 'sage') }}</h2>
                  <label for="providerSearch" class="form-label mb-2 mb-md-4">{{ __('Search our education & training providers', 'sage') }}</label>
                  <div class="estyn-search-container input-group mb-3">
                    <input type="text" list="home-provider-search-datalist-options" class="estyn-search-box form-control" data-posttype="estyn_eduprovider" placeholder="" aria-label="providerSearch" aria-describedby="providerSearch">
                    <button class="estyn-search-box-button btn btn-secondary" type="button" id="providerSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    <datalist class="search-datalist" id="home-provider-search-datalist-options">

                    </datalist>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-5 offset-md-1">
              <h2 class="d-none d-md-block mb-sm-2">{{ __('Estyn for you', 'sage') }}</h2>
              <p class="d-none d-md-block mb-2 mb-md-4">{{ __('Sub text explaining more detail', 'sage') }}</p>
              <div class="d-flex align-items-start flex-column flex-sm-row flex-md-column flex-xxl-row">
                @if(!empty($homeData['intro_buttons']))
                  @foreach($homeData['intro_buttons'] as $button)
                    <a class="btn btn-outline-light me-4 mb-3" href="{{ $button['url'] }}">{{ $button['text'] }}</a>
                  @endforeach
                @endif                
                {{--<a class="btn btn-outline-light me-4 mb-3">{{ __('Parents, carers & learners', 'sage') }}</a>
                <a class="btn btn-outline-light me-4 mb-3">{{ __('Education professionals', 'sage') }}</a>--}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('partials.home-page-signposting')

  <div class="pb-md-5">
  @include('partials.cta', [
    'ctaHeading' => $homeData['cta']['heading'],
    'ctaText' => $homeData['cta']['text'],
    'ctaButtonLinkURL' => $homeData['cta']['button_link'],
    'ctaButtonText' =>  $homeData['cta']['button_text'],
    'ctaImageURL' => $homeData['cta']['image_url'],
    'ctaImageAlt' => $homeData['cta']['image_alt'],
    'noPY' => true
  ])
  </div>

  @php
    $query1 = new WP_Query([
      'post_type' => ['post', 'estyn_newsarticle'],
      'posts_per_page' => 20,
      'status' => 'publish'
    ]);

    $sliderItems = [];

    if($query1->have_posts()) {
      while($query1->have_posts()) {
        $query1->the_post();
        // Do something with the post data
        if(empty(get_the_post_thumbnail_url())) {
          continue;
        }

        $sliderItems[] = [
          'featured_image_src' => get_the_post_thumbnail_url(),
          'title' => get_the_title(),
          'excerpt' => get_the_excerpt(),
          'link' => get_the_permalink(),
          'date' => get_the_date('d F Y'),
        ];
      }

      wp_reset_postdata();
    }

    // For TESTING: Append a copy of $sliderItems to $sliderItems to make the carousel longer
    //$sliderItems = array_merge($sliderItems, $sliderItems);
  @endphp

<div class="mt-4 mt-sm-5 pb-md-5">
  @if(!empty($homeData['ways_to_improve_carousel_items']))
    @include('partials.slider', [
      'carouselID' => 'estyn-home-carousel',
      'carouselHeading' => __('Ways to improve', 'sage'),
      'carouselDescription' => __('Our most recent resources to help you improve your setting', 'sage'),
      'carouselButtonText' => __('All resources', 'sage'),
      'carouselItems' => $homeData['ways_to_improve_carousel_items'],
      'doNotDoJavaScript' => false
    ])
  @endif
</div>

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
<div id="home-map-search-section" class="pt-md-5">
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
    'darkArc' => true,
    'ctaContainerExtraClasses' => 'ctaSearchMapContainer'
  ])
</div>

  <div class="pt-md-5 mt-5 pb-md-5">
    @php
      $query1 = new WP_Query([
        'post_type' => ['post', 'estyn_newsarticle'],
        'posts_per_page' => 20,
        'status' => 'publish'
      ]);

      $sliderItems = [];

      if($query1->have_posts()) {
        while($query1->have_posts()) {
          $query1->the_post();
          // Do something with the post data
          if(empty(get_the_post_thumbnail_url())) {
            continue;
          }

          $sliderItems[] = [
            'featured_image_src' => get_the_post_thumbnail_url(),
            'title' => get_the_title(),
            'link' => get_the_permalink(),
            'date' => get_the_date('d F Y'),
          ];
        }

        wp_reset_postdata();
      }
    @endphp

    <div class="pb-md-5">
    @include('partials.slider', [
        'carouselID' => 'estyn-home-latest-news-carousel',
        'carouselHeading' => __('Latest articles', 'sage'),
        'carouselDescription' => __('Blog posts and news articles from Estyn', 'sage'),
        'carouselButtonText' => __('All articles', 'sage'),
        'carouselItems' => $sliderItems,
        'carouselButtonLink' => App\get_permalink_by_template('template-news-and-blog.blade.php') ?? (pll_current_language() == 'en' ? '/news-and-blog' : '/cy/newyddion-a-blog'),
        'doNotDoJavaScript' => false
      ])
    </div>
  </div>

  @while(have_posts()) @php(the_post())
    {{-- @include('partials.content-page') --}}
  @endwhile
@endsection
