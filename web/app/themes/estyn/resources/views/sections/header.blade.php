<header class="banner sticky-top">
{{--   <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}
  </a> --}}
<nav class="navbar navbar-expand-xl navbar-light bg-white">
  <div class="container my-2 my-sm-3 px-md-4 px-xl-5">
    <a class="navbar-brand order-xl-1" href="{{ home_url('/') }}"><img src="@asset('images/estyn-logo.svg')" alt="{!! $siteName !!}" width="138"/></a>
    <div class="collapse navbar-collapse order-3 order-xl-2" id="navbarNavDropdown">
		<hr class="p-0 m-0 w-100 d-block d-xl-none">
      <ul class="navbar-nav ms-auto mt-5 mt-xl-0">
        <!-- Parents Carers and learners -->
        <li class="nav-item dropdown mb-4 mb-xl-0">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	<div class="d-flex justify-content-between d-xl-inline-block">
				<div>
					<span class="nav-item-sub">{{ __('Estyn for', 'sage') }}</span>
					<span class="nav-item-main">{{ __('Parents, carers & learners', 'sage') }}</span>
				</div>
				<div class="d-block d-xl-none">
					<!-- Font awesome right arrow (with stem) icon -->
					<i class="fa-sharp fa-solid fa-arrow-right pt-3"></i>
				</div>
			</div>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 px-0 col-lg-8">
          				<h3 class="mb-4">{{ __('Parents, carers & learners', 'sage') }}</h3>
          				<div class="row w-100">
          					<div class="col-12 col-md-6 megaMenuFeature">
          						<div class="row">
												@php
													// Get the nav menu items from the nav menu that is assigned to the 'main_nav_parents_carers_and_learners_signposts' menu location
													$navMenuLocations = get_nav_menu_locations();
													$navMenuItems = wp_get_nav_menu_items($navMenuLocations['main_nav_parents_carers_and_learners_signposts']);
												@endphp
												@foreach($navMenuItems as $navMenuItem)
													@php
														$useEstynLogoAsIcon = get_field('use_estyn_logo_for_the_icon', $navMenuItem->ID) === 'true' ? true : false;
													@endphp
													<div class="col-12 mb-4 position-relative">
														@include('components.signpost', [
															'bgColour' => get_field('signpost_colour', $navMenuItem->ID),
															'iconClasses' => 'fa-solid ' . get_field('icon_class', $navMenuItem->ID),
															'useEstynLogoAsIcon' => $useEstynLogoAsIcon,
															'title' => $navMenuItem->title,
															'description' => get_field('description', $navMenuItem->ID),
															'linkURL' => $navMenuItem->url,
															'arrow' => true
														])
													</div>
												@endforeach
												{{--<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'iconClasses' => 'fa-solid fa-magnifying-glass',
														'title' => __('Provider search', 'sage'),
														'description' => __('Find an education & training provider', 'sage'),
														'linkURL' => is_front_page() ? '#homeInsideIntroArcLarge' : get_home_url() . '/#homeInsideIntroArcLarge',
														'arrow' => true
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-location-dot',
														'title' => __('Provider map', 'sage'),
														'description' => __('Find an education & training provider', 'sage'),
														'linkURL' => is_front_page() ? '/#home-map-search-section' : get_home_url() . '/#home-map-search-section',
														'arrow' => true
													])
												</div>--}}
											</div>
					        	</div>
						        <div class="col-12 col-md-6 megaMenuMain">
						        	<div class="row mt-4 mt-md-0">
						        		<div class="col-md-10 offset-md-2">
{{-- 								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="/about-us">{{ __('What Estyn does', 'sage') }}</a></li>
								            <li><a href="/parents-and-care">{{ __('Parents and carers community', 'sage') }}</a></li>
								            <li><a href="#">{{ __('What happens during an inspection?', 'sage') }}</a></li>
											<li><a href="#">{{ __('How do I contact Estyn?', 'sage') }}</a></li>
								          </ul>	 --}}
										  {{-- Insert our WordPress 'parents, carers, and learners right-hand-side nav' --}}
										  {!! wp_nav_menu(['theme_location' => 'main_nav_parents_carers_and_learners_right_hand_side_links', 'menu_class' => '']) !!}
								        </div>
								      </div>
						      	</div>
					    		</div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>
        <!-- Education Proffessionals -->
        <li class="nav-item dropdown mb-4 mb-xl-0">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		    <div class="d-flex justify-content-between d-xl-inline-block">
				<div>
					<span class="nav-item-sub">{{ __('Estyn for', 'sage') }}</span>
					<span class="nav-item-main">{{ __('Education professionals', 'sage') }}</span>
				</div>
				<div class="d-block d-xl-none">
					<!-- Font awesome right arrow (with stem) icon -->
					<i class="fa-sharp fa-solid fa-arrow-right pt-3"></i>
				</div>
			</div>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 px-0 col-lg-8">
          				<h3 class="mb-4">{{ __('Educational professionals', 'sage') }}</h3>
          				<div class="row w-100">
          					<div class="col-12 col-md-6 megaMenuFeature">
          						<div class="row">
												@php
													// Get the nav menu items from the nav menu that is assigned to the 'main_nav_education_professionals_signposts' menu location
													$navMenuItems = wp_get_nav_menu_items($navMenuLocations['main_nav_education_professionals_signposts']);
												@endphp
												@foreach($navMenuItems as $navMenuItem)
													@php
														$useEstynLogoAsIcon = get_field('use_estyn_logo_for_the_icon', $navMenuItem->ID) === 'true' ? true : false;
													@endphp
													<div class="col-12 mb-4 position-relative">
														@include('components.signpost', [
															'bgColour' => get_field('signpost_colour', $navMenuItem->ID),
															'iconClasses' => 'fa-solid ' . get_field('icon_class', $navMenuItem->ID),
															'useEstynLogoAsIcon' => $useEstynLogoAsIcon,
															'title' => $navMenuItem->title,
															'description' => get_field('description', $navMenuItem->ID),
															'linkURL' => $navMenuItem->url,
															'arrow' => true
														])
													</div>
												@endforeach
												{{--<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'iconClasses' => 'fa-solid fa-file',
														'title' => __('Improvement Resources', 'sage'),
														'description' => __('Resources to help providers improve', 'sage'),
														'linkURL' => '#',
														'arrow' => true
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-folder-open',
														'title' => __('Inspection reports', 'sage'),
														'description' => __('Search for an inspection report', 'sage'),
														'linkURL' => '/latest-inspection-reports',
														'arrow' => true
													])
												</div>--}}
								</div>
					        </div>
						        <div class="col-12 col-md-6 megaMenuMain">
						        	<div class="row mt-4 mt-md-0">
						        		<div class="col-12 col-md-10 offset-md-2">
											{!! wp_nav_menu(['theme_location' => 'main_nav_education_professionals_right_hand_side_links', 'menu_class' => '']) !!}
								          {{--<ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>--}}
								        </div>
								      </div>
						      	</div>
					    		</div>
					    		<hr class="hrnav">
							    <div class="row mt-4 mt-md-0 w-100">
							    	<div class="col-12">
							    		<h4 class="mb-3">{{ __('Find my sector', 'sage') }}</h4>
												<div class="row">
													@foreach($sectors as $sector)
														<div class="col-12 col-lg-6 col-xl-4 mb-2">
															<a href="{{ get_term_link($sector) }}" class="findmysector">{{ $sector->name }}</a>
														</div>
													@endforeach
													{{--<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>
													<div class="col-12 col-lg-6 col-xl-4 mb-2">
														<a href="#" class="findmysector">Some stuff here</a>
													</div>--}}
													
												</div>


							    	</div>
							    </div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>
        <!-- About -->
        <li class="nav-item nav-item-no-border dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarProfessionalDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          	<div class="d-flex justify-content-between d-xl-inline-block">
				<div>          	
					<span class="nav-item-sub">{{ __('Who we are', 'sage') }}</span>
					<span class="nav-item-main">{{ __('About Estyn', 'sage') }}</span>
				</div>
				<div class="d-block d-xl-none">
					<!-- Font awesome right arrow (with stem) icon -->
					<i class="fa-sharp fa-solid fa-arrow-right pt-3"></i>
				</div>
			</div>
          </a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 px-0 col-lg-8">
          				<h3 class="mb-4">{{ __('About Estyn', 'sage') }}</h3>
          				<div class="row w-100">
          					<div class="col-12 col-md-6 megaMenuFeature">
          						<div class="row">
												@php
													// Get the nav menu items from the nav menu that is assigned to the 'main_nav_about_estyn_signposts' menu location
													$navMenuItems = wp_get_nav_menu_items($navMenuLocations['main_nav_about_estyn_signposts']);
												@endphp
												@foreach($navMenuItems as $navMenuItem)
													@php
														$useEstynLogoAsIcon = get_field('use_estyn_logo_for_the_icon', $navMenuItem->ID) === 'true' ? true : false;
													@endphp
													<div class="col-12 mb-4 position-relative">
														@include('components.signpost', [
															'bgColour' => get_field('signpost_colour', $navMenuItem->ID),
															'iconClasses' => 'fa-solid ' . get_field('icon_class', $navMenuItem->ID),
															'useEstynLogoAsIcon' => $useEstynLogoAsIcon,
															'title' => $navMenuItem->title,
															'description' => get_field('description', $navMenuItem->ID),
															'linkURL' => $navMenuItem->url,
															'arrow' => true
														])
													</div>
												@endforeach
												{{--<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-lightpink2',
														'svg' => asset('images/estyn-logo-icon-only-darkblue.svg'),
														'title' => __('About Estyn', 'sage'),
														'description' => __('Who we are and what we do', 'sage'),
														'linkURL' => 'https://www.google.co.uk',
														'arrow' => true
													])
												</div>
												<div class="col-12 mb-4 position-relative">
													@include('components.signpost', [
														'bgColourClass' => 'bg-signpost-green2',
														'iconClasses' => 'fa-solid fa-users-rectangle',
														'title' => __('Who\'s who', 'sage'),
														'description' => __('Meet the team', 'sage'),
														'linkURL' => 'https://www.google.co.uk',
														'arrow' => true
													])
												</div>--}}
											</div>
					        	</div>
						        <div class="col-12 col-md-6 megaMenuMain">
						        	<div class="row mt-4 mt-md-0">
						        		<div class="col-12 col-md-10 offset-md-2">
											{!! wp_nav_menu(['theme_location' => 'main_nav_about_estyn_right_hand_side_links', 'menu_class' => '']) !!}
								          {{--<ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>	--}}
								        </div>
								      </div>
						      	</div>
					    		</div>
			      		</div>
			    		</div>
						</div>
      		</div>
        </li>{{--
        <!-- Language -->
        <li class="nav-item nav-language d-flex flex-column justify-content-center">
          <a class="nav-link" href="#">Cymraeg</a>
        </li>
        <!-- Search -->
        <li class="nav-item d-flex flex-column justify-content-center nav-search dropdown">
          <a class="nav-link pe-0" href="#" id="navbarSearchDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
          <div class="megaMenu dropdown-menu w-100 bg-white">
          	<div class="container my-4">
          		<div class="row d-flex justify-content-center">
          			<div class="col-12 col-md-8">
          				<div class="row">
          					<div class="col-6 megaMenuFeature">
          						<div class="row">
          							<div class="col-10">
		          						<h3 class="mb-4">Search Estyn</h3>
		          						<div class="input-group mb-3">
													  <input type="text" class="form-control" placeholder="" aria-label="estynSearch" aria-describedby="estynSearch">
													  <button class="btn btn-primary" type="button" id="estynSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
													</div>
												</div>
											</div>
					        	</div>
						        <div class="col-6 megaMenuMain">
						        	<div class="row">
						        		<div class="col-10 offset-2">
						        			<h3 class="mb-4">Popular</h3>
								          <ul aria-labelledby="navbarProfessionalDropdownMenuLink">
								            <li><a href="https://google.co.uk">Action</a></li>
								            <li><a href="#">Another action</a></li>
								            <li><a href="#">Something else here</a></li>
								          </ul>	
								        </div>
								      </div>
						      	</div>
					    		</div>
          			</div>
          		</div>
          	</div>
          </div>
        </li> --}}
      </ul>
    </div>
	<div class="d-flex flex-row justify-content-end order-2 order-xl-3">
		<ul class="d-flex flex-row navbar-nav">
			<!-- Language -->
			<li class="nav-item nav-language d-flex flex-column justify-content-center">
				<a class="nav-link" href="#">Cymraeg</a>
			</li>
			<!-- Search -->
			<li class="nav-item d-flex flex-column justify-content-center nav-search dropdown">
			<a class="nav-link ps-0 ps-xl-4 pe-5 pe-xl-0" href="#" id="navbarSearchDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
			<div class="megaMenu dropdown-menu w-100 bg-white search-menu">
				<div class="container my-4">
					<div class="row d-flex justify-content-center">
						<div class="col-12 col-md-10">
							<div class="row">
								<div class="col-md-6 megaMenuFeature">
									<div class="row">
										<div class="col-md-10 pb-4 pb-sm-0">
											<h3 class="mb-4">{{ __('Search Estyn') }}</h3>
											<div class="input-group mb-3">
														<input type="text" class="form-control" placeholder="" aria-label="estynSearch" aria-describedby="estynSearch">
														<button class="btn btn-primary" type="button" id="estynSearch"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
														</div>
													</div>
												</div>
									</div>
									<div class="col-md-6 megaMenuMain mt-5 mt-sm-0">
										<div class="row">
											<div class="col-md-10 offset-md-2">
												<h3 class="mb-4">{{ __('Popular', 'sage') }}</h3>
											<ul aria-labelledby="navbarProfessionalDropdownMenuLink">
												<li><a href="https://google.co.uk">Action</a></li>
												<li><a href="#">Another action</a></li>
												<li><a href="#">Something else here</a></li>
											</ul>	
											</div>
										</div>
									</div>
									</div>
						</div>
					</div>
				</div>
			</div>
		</li>
		</ul>
		<button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
  </div>
</nav>
</header>
@push('scripts')
	<script>
		jQuery(document).ready(function($) {
			/**
				On mobile, when clicking one of the main nav's dropdown toggles,
				we need the toggler to change to a 'Back' link with a left arrow,
				and hide the other dropdown toggles
			**/
			let navDropdownToggles = $('header .dropdown-toggle');
			let originalContent = [];
			$(navDropdownToggles).each(function(index, dropdownToggle) {
				originalContent.push($(dropdownToggle).html());
			});

			let applied = false;

			function resetDropdownToggles() {
				// Reset the dropdown toggles to their original state
				$('header .dropdown-toggle').each(function(index, dropdownToggle) {
					$(dropdownToggle).html(originalContent[index]);
				});

				// Show all the dropdown toggles' parent
				$('header .dropdown-toggle').parent().show();
			}

			function applyMainNavDropdownToggleMobileBehaviour() {
				$(navDropdownToggles).each(function(index, dropdownToggle) {
					$(dropdownToggle).on('show.bs.dropdown', function() {
						if($(window).width() >= 1200) {
							return;
						}
						// Dropdown is open, change to "Back" with left arrow
						$(this).html('<i class="fa-sharp fa-solid fa-arrow-left"></i> Back');

						// Hide the other .dropdown-toggle elements' parent
						$(navDropdownToggles).not(this).parent().hide();
					});

					$(dropdownToggle).on('hide.bs.dropdown', function() {
						if($(window).width() >= 1200) {
							return;
						}
						//console.log('Dropdown is closed');
						resetDropdownToggles();
					});
				});

				applied = true;
			}

			if ($(window).width() < 1200) {
				applyMainNavDropdownToggleMobileBehaviour();
			}

			// Monitor window size change
			$(window).on('resize', function() {
				if ($(window).width() < 1200) {
					if (!applied) {
						applyMainNavDropdownToggleMobileBehaviour();
					}
				} else {
					if(applied) {
						resetDropdownToggles();
					}
				}
			});

			// Monitor $('header .navbar-collapse') show/hide
			/*$('header .navbar-collapse').on('hide.bs.collapse', function() {
				if(applied) {
					resetDropdownToggles();
				}
			});*/
		});
	</script>
@endpush
