@php
	$ctaUniqueID = $ctaUniqueID ?? 'estyn-cta-' . uniqid();
@endphp
<section class="cta my-5 position-relative {{ isset($ctaContainerExtraClasses) ? $ctaContainerExtraClasses : '' }}" id="{{ $ctaUniqueID }}">
	<div class="container {{ isset($noPY) && $noPY === false ? 'py-5' : '' }} px-md-4 px-xl-5">
		<div class="row px-md-5 justify justify-content-center">
			<div class="col-12 col-md-10">
				<div class="card card-cta">
					@if(isset($imageBreakOut) && $imageBreakOut === true)
						<div class="card-body my-2 mx-0 my-sm-5 mx-sm-4 my-lg-5 mx-lg-4 mb-0 mb-sm-2 mb-lg-3">
					@else
						<div class="card-body my-2 mx-0 my-sm-5 mx-sm-4 my-lg-5 mx-lg-4">
					@endif
						@if(empty($ctaCarouselItems))
						<div class="row">
							@if(isset($ctaImageURL))
							<div class="col-12 col-lg-6 col-xl-5 col-xxl-4 mb-4 mb-md-0 pb-md-5">
							@else
							<div class="col-12">
							@endif
								<div class="pt-cta-content">
									<h2 class="mb-3 mb-md-4">{{ $ctaHeading }}</h2>
									@if(!empty($ctaContent))
										{!! $ctaContent !!}
									@elseif(isset($ctaText))
										<p>{{ $ctaText }}</p>
									@endif
									@if(!empty($ctaButtons))
										@foreach($ctaButtons as $ctaButton)
											<a class="btn btn-primary me-3 mb-3" href="{{ $ctaButton['link'] }}">
												{{ $ctaButton['text'] }}
											</a>
										@endforeach
									@elseif(!empty($ctaButtonText) && !empty($ctaButtonLinkURL))
										<a class="btn btn-primary" href="{{ $ctaButtonLinkURL }}">
											{{ $ctaButtonText }}
											@if(isset($ctaButtonIconClasses))
												<i class="{{ $ctaButtonIconClasses }}"></i>
											@endif
										</a>
									@endif
								</div>
							</div>
							<div class="col-12 col-lg-6 offset-xl-1 position-relative px-5 px-md-0 text-center text-lg-end {{ isset($showSearchBox) && ($showSearchBox === true) ? 'cta-search-col' : '' }}">
								@if(isset($ctaImageURL))
									<img src="{{ $ctaImageURL }}" class="img-fluid pt-cta-image {{ isset($imageBreakOut) && ($imageBreakOut == true) ? 'breakOut' : '' }} {{ $imageExtraClasses ?? ''}}" alt="{{ $ctaImageAlt }}" />
								@endif
								@if(isset($showSearchBox) && ($showSearchBox === true))
									<div class="d-flex justify-content-center justify-content-lg-end ctaSearchBoxContainer">
										<div class="estyn-search-container input-group mb-3 shadow rounded">
											<div class="modal estyn-search-results-modal" tabindex="-1" id="{{ $ctaUniqueID }}-search-results-modal">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title">{{ __('Search results', 'sage') }}</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close', 'sage') }}"></button>
													</div>
													<div class="modal-body">
														<div class="row">
														<div class="col">
															<ul class="estyn-search-results-list list-group list-group-flush">
															{{-- Search results will be added here --}}
															</ul>
														</div>
														</div>
													</div>
													</div>
												</div>
											</div>
											<input type="text" class="form-control estyn-search-box" data-posttype="estyn_eduprovider" list="{{ $ctaUniqueID }}-search-datalist-options" placeholder="Primary schools" aria-label="Primary schools" aria-describedby="button-addon2">
											<button class="estyn-search-box-button btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#{{ $ctaUniqueID }}-search-results-modal"><i class="fa-solid fa-magnifying-glass"></i></button>
											<datalist class="search-datalist" id="{{ $ctaUniqueID }}-search-datalist-options">

                    						</datalist>
										</div>
									</div>
								@endif
							</div>
						</div>
						@else
						<div class="row cta-carousel">
							<div class="col-12 col-md-4">
								<h2 class="mb-3 mb-md-4">{{ $ctaHeading }}</h2>
								<!-- Carousel Indicators and Captions -->
								{{--<ol class="carousel-indicators">
									@for($i = 0; $i < count($ctaCarouselItems); $i++)
										<li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
									@endfor
								</ol>--}}
								<div class="carousel-captions">
									@for($i = 0; $i < count($ctaCarouselItems); $i++)
										<div class="carousel-caption {{ $i != 0 ? 'd-none' : '' }}" id="caption-{{ $i }}">{!! $ctaCarouselItems[$i]['caption'] !!}</div>
									@endfor
								</div>
							</div>
							<div class="col-12 col-md-8 position-relative">
									<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
										<div class="carousel-inner">
											@foreach($ctaCarouselItems as $i => $carouselItem)
												<div class="carousel-item {{ $i == 0 ? 'active' : '' }}">
													<div class="cta-carousel-item-container">
														<div class="cta-carousel-item-image-container">
															<img class="cta-carousel-image img-fluid" src="{{ $carouselItem['image'] }}" alt="{{ $carouselItem['alt'] }}">
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
									<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
										<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Previous</span>
									</button>
									<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="visually-hidden">Next</span>
									</button>
							</div>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
	@if((!isset($noArc) || $noArc === false))
		@if(isset($darkArc) && ($darkArc === true))
			<!-- Arc for larger screens -->
			<div class="ctaArcMap position-absolute w-100 d-none d-md-block">
				<svg width="1600" height="364" viewBox="0 0 1600 364" preserveAspectRatio="none">
				<path d=
				"M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v310H0V54.7z" 
				fill="#2A7AB0" />
				</svg>
			</div>
			<!-- Arc for smaller screens -->
			<div class="ctaArcMap position-absolute w-100 d-block d-md-none">
				<svg width="1600" height="182" viewBox="0 0 1600 364" preserveAspectRatio="none">
				<path d=
				"M0,54.7C0,54.7,392,0,792,0s808,54.7,808,54.7v310H0V54.7z" 
				fill="#2A7AB0" />
				</svg>
			</div>
			<div class="ctaArcMapBGFiller position-absolute w-100 bg-blue"></div>
			<div class="w-100 bg-blue pt-md-5 pb-md-5">
				<div class="container py-5 px-md-4 px-xl-5">
					<div class="row d-flex justify-content-center">
						<div class="col-12 col-sm-10 col-xl-8">
							<div class="row">
								@php
									$sectors = isset($sectors) ? $sectors : get_terms([
										'taxonomy' => 'sector',
										'hide_empty' => false,
										/*'orderby' => 'count',
										'order' => 'DESC'*/
										'orderby' => 'term_order',
									]);
								@endphp
								@foreach($sectors as $sector)
								    @if($loop->iteration > 12) {{-- Only show the first 12 items --}}
										@continue
									@endif
									@php
										// We want the last word of the sector name to be contained within a span (with class no-wrap)
										// and next to it we want the arrow icon
										$sectorNameParts = explode(' ', $sector->name);
										$sectorNamePartsCount = count($sectorNameParts);
										$sectorNameLastWord = $sectorNameParts[$sectorNamePartsCount - 1];
										$sectorNameParts[$sectorNamePartsCount - 1] = '<span class="text-nowrap">' . $sectorNameLastWord . ' <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span>';
										$sectorName = implode(' ', $sectorNameParts);
									@endphp
									<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
										<a href="{{ get_term_link($sector) }}" class="ctaMapLink">{!! $sectorName !!}</a>
									</div>
								@endforeach
								{{--<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink">Non-maintained <span class="text-nowrap">nurseries <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink">Non-maintained <span class="text-nowrap">nurseries <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink">Non-maintained <span class="text-nowrap">nurseries <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Primary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Primary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Primary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>--}}
							</div>
							<div class="row collapse" id="{{ $ctaUniqueID }}-collapseSectors">
								@foreach($sectors as $sector)
									@if($loop->iteration < 13) {{-- Only show the 13th item onwards --}}
										@continue
									@endif
									<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
										<a href="{{ get_term_link($sector) }}" class="ctaMapLink">{{ $sector->name }} <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></a>
									</div>
								@endforeach
								{{--<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">All-age <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">All-age <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>
								<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
									<a href="#" class="ctaMapLink"><span class="text-nowrap">All-age <i class="fa-sharp fa-regular fa-arrow-up-right text-decoration-underline"></i></span></a>
								</div>--}}
							</div>
							<div class="row">
								<div class="col-12 d-flex justify-content-center mt-4">
									<a id="{{ $ctaUniqueID }}-toggle-show-more" class="btn btn-outline-primary px-5 text-white bg-transparent-even-when-active border-white rounded-5 cta-toggle-more-less" data-bs-toggle="collapse" href="#{{ $ctaUniqueID }}-collapseSectors" role="button" aria-expanded="false" aria-controls="{{ $ctaUniqueID }}-collapseSectors">{{ __('See more') }}</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@else
			<!-- Arc for larger screens -->
			<div class="ctaArc position-absolute w-100 d-none d-md-block">
				<svg width="1600" height="200" viewBox="0 0 1600 200" preserveAspectRatio="none">
				<path d=
				"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
				fill="#ffffff" />
				</svg>
			</div>
			<!-- Arc for smaller screens -->
			<div class="ctaArc position-absolute w-100 d-block d-md-none">
				<svg width="1600" height="100" viewBox="0 0 1600 200" preserveAspectRatio="none">
				<path d=
				"M0,0v66.7C0,66.7,392,12,792,12s808,54.7,808,54.7V0H0z" 
				fill="#ffffff" />
				</svg>
			</div>
		@endif
	@endif
</section>
@push('scripts')
    @if( (isset($darkArc) && ($darkArc === true)) )
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
				//console.log('Initializing CTA with ID {{ $ctaUniqueID }}');
				const ctaUniqueID = "{{ $ctaUniqueID }}";
				const ctaToggleShowMore = document.getElementById("{{ $ctaUniqueID }}-toggle-show-more");
				const ctaCollapseSectors = document.getElementById("{{ $ctaUniqueID }}-collapseSectors");

				/*ctaToggleShowMore.addEventListener('click', function() {
					console.log('aria-expanded: ' + ctaToggleShowMore.getAttribute('aria-expanded'));
					if(ctaToggleShowMore.getAttribute('aria-expanded') === 'false') {
						ctaToggleShowMore.innerHTML = 'Show less';
					} else {
						ctaToggleShowMore.innerHTML = 'Show more';
					}
				});*/

				ctaCollapseSectors.addEventListener('hidden.bs.collapse', event => {
					ctaToggleShowMore.innerHTML = 'Show more';
				});
				ctaCollapseSectors.addEventListener('shown.bs.collapse', event => {
					ctaToggleShowMore.innerHTML = 'Show less';
				});
			});
		</script>
	@endif
	@if( (!isset($noJavaScript)) || $noJavaScript === false )
		<script>
			// Scale the image so it looks good in relation to the height of
			// the text content
			jQuery(document).ready(function($) {
				const contentHeight = $('#{{ $ctaUniqueID }} .pt-cta-content').height();
				const height = contentHeight * 1.25; // 125% of the text content's height
				$('#{{ $ctaUniqueID }} .pt-cta-image:not(.breakOut)').css('height', height);

				// Code for managing captions with the carousel
				if($('#carouselExampleIndicators').length > 0) {
					$('#carouselExampleIndicators').on('slide.bs.carousel', function (e) {
						// Hide all captions
						$('.carousel-caption').addClass('d-none');
						
						// Show the caption corresponding to the next slide
						var nextSlideIndex = e.to;
						$('#caption-' + nextSlideIndex).removeClass('d-none');
					});
				}
			});
		</script>
	@endif
@endpush