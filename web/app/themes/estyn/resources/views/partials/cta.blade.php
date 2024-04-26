@php
	$ctaUniqueID = 'estyn-cta-' . uniqid();
@endphp
<section class="cta position-relative {{ isset($ctaContainerExtraClasses) ? $ctaContainerExtraClasses : '' }}" id="{{ $ctaUniqueID }}">
	<div class="container {{ isset($noPY) && $noPY === false ? 'py-5' : '' }} px-md-4 px-xl-5">
		<div class="row justify justify-content-center">
			<div class="col-12 col-md-10">
				<div class="card card-cta">
					<div class="card-body my-2 mx-0 my-sm-5 mx-sm-4 my-lg-5 mx-lg-4">
						<div class="row">
							<div class="col-12 col-md-6 mb-4 mb-md-0 pb-md-5">
								<div class="pt-cta-content">
									<h2 class="mb-3 mb-md-4">{{ $ctaHeading }}</h2>
									<p>{{ $ctaText }}</p>
									<a class="btn btn-primary mt-sm-5" href="{{ $ctaButtonLinkURL }}">{{ $ctaButtonText }}</a>
								</div>
							</div>
							<div class="col-12 col-md-6 col-xl-5 offset-xl-1 position-relative px-5 px-md-0 text-center {{ isset($showSearchBox) && ($showSearchBox === true) ? 'cta-search-col' : '' }}">
								<img src="{{ $ctaImageURL }}" class="img-fluid pt-cta-image {{ isset($imageBreakOut) && ($imageBreakOut == true) ? 'breakOut' : '' }} {{ $imageExtraClasses ?? ''}}" alt="{{ $ctaImageAlt }}" />
								@if(isset($showSearchBox) && ($showSearchBox === true))
									<div class="d-flex justify-content-end">
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
			<svg width="1600" height="420" viewBox="0 0 1600 364" preserveAspectRatio="none">
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
		<div class="w-100 bg-blue">
			<div class="container py-5 px-md-4 px-xl-5">
				<div class="row d-flex justify-content-center">
					<div class="col-12 col-lg-10 col-xl-8">
						<div class="row">
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
						</div>
						<div class="row collapse" id="{{ $ctaUniqueID }}-collapseSectors">
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-6 col-lg-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
							<div class="col-12 col-md-4 mb-3">
								<a href="#" class="ctaMapLink">Some stuff here <i class="fa-sharp fa-regular fa-arrow-up-right"></i></a>
							</div>
						</div>
						<div class="row">
							<div class="col-12 d-flex justify-content-center my-4">
								<a id="{{ $ctaUniqueID }}-toggle-show-more" class="btn btn-outline-light cta-toggle-more-less" data-bs-toggle="collapse" href="#{{ $ctaUniqueID }}-collapseSectors" role="button" aria-expanded="false" aria-controls="{{ $ctaUniqueID }}-collapseSectors">Show more</a>
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
				console.log('Initializing CTA with ID {{ $ctaUniqueID }}');
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
	@else
		<script>
			//console.log("No JavaScript for CTA with ID {{ $ctaUniqueID }}");
		</script>
	@endif
	@if( (!isset($noJavaScript)) || $noJavaScript === false ) )
		<script>
			// Scale the image so it looks good in relation to the height of
			// the text content
			jQuery(document).ready(function($) {
				var contentHeight = $('#{{ $ctaUniqueID }} .pt-cta-content').height();
				var height = contentHeight * 1.25; // 125% of the text content's height
				$('#{{ $ctaUniqueID }} .pt-cta-image').css('height', height);
			});
		</script>
	@endif
@endpush