@php
	$ctaUniqueID = 'estyn-cta-' . uniqid();
@endphp
<section class="cta position-relative {{ isset($ctaContainerExtraClasses) ? $ctaContainerExtraClasses : '' }}" id="{{ $ctaUniqueID }}">
	<div class="container {{ isset($noPY) && $noPY === false ? 'py-5' : '' }} px-md-4 px-xl-5">
		<div class="row justify justify-content-center">
			<div class="col-12 col-md-10">
				<div class="card card-cta">
					@if(isset($imageBreakOut) && $imageBreakOut === true)
						<div class="card-body my-2 mx-0 my-sm-5 mx-sm-4 my-lg-5 mx-lg-4 mb-0 mb-sm-2 mb-lg-3">
					@else
						<div class="card-body my-2 mx-0 my-sm-5 mx-sm-4 my-lg-5 mx-lg-4">
					@endif
						<div class="row">
							<div class="col-12 col-lg-6 col-xl-5 col-xxl-4 mb-4 mb-md-0 pb-md-5">
								<div class="pt-cta-content">
									<h2 class="mb-3 mb-md-4">{{ $ctaHeading }}</h2>
									<p>{{ $ctaText }}</p>
									<a class="btn btn-primary" href="{{ $ctaButtonLinkURL }}">{{ $ctaButtonText }}</a>
								</div>
							</div>
							<div class="col-12 col-lg-6 offset-xl-1 position-relative px-5 px-md-0 text-center text-lg-end {{ isset($showSearchBox) && ($showSearchBox === true) ? 'cta-search-col' : '' }}">
								<img src="{{ $ctaImageURL }}" class="img-fluid pt-cta-image {{ isset($imageBreakOut) && ($imageBreakOut == true) ? 'breakOut' : '' }} {{ $imageExtraClasses ?? ''}}" alt="{{ $ctaImageAlt }}" />
								@if(isset($showSearchBox) && ($showSearchBox === true))
									<div class="d-flex justify-content-center justify-content-lg-end ctaSearchBoxContainer">
										<div class="input-group mb-3 shadow rounded">
											<input type="text" class="form-control" placeholder="Primary schools" aria-label="Primary schools" aria-describedby="button-addon2">
											<button class="btn btn-primary" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
										</div>
									</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
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
		<div class="w-100 bg-blue pt-5">
			<div class="container py-5 px-md-4 px-xl-5">
				<div class="row d-flex justify-content-center">
					<div class="col-12 col-sm-10 col-xl-8">
						<div class="row">
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Non-maintained nurseries <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Non-maintained nurseries <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Non-maintained nurseries <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Primary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Primary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Primary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
						</div>
						<div class="row collapse" id="{{ $ctaUniqueID }}-collapseSectors">
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Secondary <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">All-age <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">All-age <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 text-center text-lg-start col-sm-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">All-age <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-flex justify-content-center my-4">
								<a id="{{ $ctaUniqueID }}-toggle-show-more" class="btn btn-outline-primary px-5 text-white bg-transparent-even-when-active border-white rounded-3 cta-toggle-more-less" data-bs-toggle="collapse" href="#{{ $ctaUniqueID }}-collapseSectors" role="button" aria-expanded="false" aria-controls="{{ $ctaUniqueID }}-collapseSectors">{{ __('See more') }}</a>
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
			});
		</script>
	@endif
@endpush