<footer {{ isset($footerNoMT) ? 'class="mt-5"' : '' }}>
<section class="footer bg-darkblue pt-md-5">
	<div class="container px-md-4 px-xl-5 py-5">
		<div class="row pt-3 pt-md-5 pb-md-5">
			<div class="col-12 col-lg-3 mb-4">
				<img src="{{ asset('images/estyn-logo-white.svg') }}" alt="Estyn logo" class="mb-4" width="138" />
				<p class="mb-4">{!! nl2br(e($footerData['address'])) !!}</p>
				<ul class="fa-ul">
				  <li><span class="fa-li"><i class="fa-regular fa-envelope"></i></span><a href="mailto:{{ $footerData['email'] }}">{{ $footerData['email'] }}</a></li>
				  <li><span class="fa-li"><i class="fa-regular fa-mobile"></i></span>{{ $footerData['phone'] }}</li>
				</ul>
				<div class="row">
					<div class="col-12">
						<div class="mainNum mb-3 me-3">
							<div class="numrel">
								<div class="row numrow">
									<div class="w-100 h-100">
										<div class="rounded-circle w-100 h-100 d-flex">
											<span class="align-self-center mx-auto"><a href="{{ $footerData['facebook_url'] }}" class="stretched-link"><i class="fa-brands fa-facebook"></i></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mainNum mb-3 me-3">
							<div class="numrel">
								<div class="row numrow">
									<div class="w-100 h-100">
										<div class="rounded-circle w-100 h-100 d-flex">
											<span class="align-self-center mx-auto"><a href="{{ $footerData['x_twitter_url'] }}" class="stretched-link"><i class="fa-brands fa-x-twitter"></i></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="mainNum mb-3 me-3">
							<div class="numrel">
								<div class="row numrow">
									<div class="w-100 h-100">
										<div class="rounded-circle w-100 h-100 d-flex">
											<span class="align-self-center mx-auto"><a href="{{ $footerData['linkedin_url'] }}" class="stretched-link"><i class="fa-brands fa-linkedin"></i></a></span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 mb-4">
				<h5 class="mt-3 mb-4">{{ __('Popular', 'sage') }}</h5>
				<div class="list-group list-group-flush">
				  {{-- Nav location for footer_nav_1 --}}
				  @if (has_nav_menu('footer_nav_1'))
				    {!! wp_nav_menu(['theme_location' => 'footer_nav_1', 'menu_class' => 'list-group list-group-flush']) !!}
				  @endif
				  {{--<a href="#" class="list-group-item list-group-item-action">
				    The current link item
				  </a>
				  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>--}}
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 mb-4">
				<h5 class="mt-3 mb-4">{{ __('Publications and policies', 'sage') }}</h5>
				<div class="list-group list-group-flush">
				  {{-- Nav location for footer_nav_2 --}}
				  @if (has_nav_menu('footer_nav_2'))
				    {!! wp_nav_menu(['theme_location' => 'footer_nav_2', 'menu_class' => 'list-group list-group-flush']) !!}
				  @endif
				  {{--<a href="#" class="list-group-item list-group-item-action">
				    The current link item
				  </a>
				  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>--}}
				</div>
			</div>
			<div class="col-12 col-md-4 col-lg-3 mb-4">
				<h5 class="mt-3 mb-4">{{ __('Key inspection documentation', 'sage') }}</h5>
				<div class="list-group list-group-flush">
				  {{-- Nav location for footer_nav_3 --}}
				  @if (has_nav_menu('footer_nav_3'))
				    {!! wp_nav_menu(['theme_location' => 'footer_nav_3', 'menu_class' => 'list-group list-group-flush']) !!}
				  @endif				  
				  {{--<a href="#" class="list-group-item list-group-item-action">
				    The current link item
				  </a>
				  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
				  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>--}}
				</div>
			</div>
		</div>
	</div>
	<div class="w-100 py-4 bg-blue">
		<div class="container px-md-4 px-xl-5 py-4">
			@if (has_nav_menu('footer_bottom_nav'))
				{!! wp_nav_menu(['theme_location' => 'footer_bottom_nav', 'menu_class' => 'nav footer-bottom-nav flex-column flex-sm-row']) !!}
			@endif
			{{--<nav class="nav flex-column flex-sm-row">
			  <a class="nav-link active" aria-current="page" href="#">Contact us</a>
			  <a class="nav-link" href="#">Privacy policy</a>
			  <a class="nav-link" href="#">Accessibility</a>
			  <a class="nav-link" href="#">Terms of use</a>
			  <a class="nav-link" href="#">Sitemap</a>
			</nav>--}}
			<span class="nav-link text-white">© Estyn {{ __('All rights reserved', 'sage') }}</span>
		</div>
	</div>
</section>
</footer>
@push('scripts')
	<script>
		// Search boxes
		(function($) {
			$(document).ready(function() {
				if (!$('.estyn-search-box').length) {
					return;
				}

				function isMobile() {
					return window.matchMedia('(max-width: 767px)').matches;
				}

				let providerSearchPageURL = "{{ \App\get_permalink_by_template('provider-search.blade.php') }}";

				let searchBoxTypingTimer = setTimeout(function() {}, 0);
				const searchBoxTypingInterval = 500;

				let processSearchBoxChangeTimer = setTimeout(function() {}, 0);
				const processSearchBoxChangeInterval = 500;

				function processSearchBoxChange($elem) {
					clearTimeout(processSearchBoxChangeTimer);

					//console.log('processSearchBoxChange');
					//console.log($elem.val());
					// If the user selects an option from the datalist, redirect to the URL
					const $datalist = $elem.nextAll('datalist:first');
					const $selectedOption = $datalist.find(`option[value="${$elem.val()}"]`);
					if($selectedOption.length) {
						window.location.href = $selectedOption.data('link');
						return;
					}
					
					// Otherwise, search for the text
					clearTimeout(searchBoxTypingTimer);

					searchBoxTypingTimer = setTimeout(function($elem) {
						search($elem);						
					}, searchBoxTypingInterval, $elem);
				}

				$('.estyn-search-box').on('keyup', function() {
					//console.log('change');
					//console.log($(this).val());
					
					clearTimeout(processSearchBoxChangeTimer);
					processSearchBoxChangeTimer = setTimeout(function($elem) {
						processSearchBoxChange($elem);
					}, processSearchBoxChangeInterval, $(this));
				});

				$('.estyn-search-box').on('focus', function() {
					if(isMobile()) {
						$(this).prev('.estyn-search-results-modal').modal('show');
					}
				});

				$('.estyn-search-box-button').on('click', function() {
					//console.log('click');
					//$(this).prev('.estyn-search-results-modal').modal('show');

					// If the search box is for providers, redirect to the provider search page (on desktop)
					if( (!isMobile()) && $(this).hasClass('estyn-provider-search-button') ) {
						window.location.href = providerSearchPageURL + '?search=' + $(this).prev('input').val();
						return;
					}
					// If it's mobile and this is the MODAL's search button, then we'll do the redirect
					if( (isMobile()) && $(this).hasClass('estyn-provider-search-mobile-modal-button') ) {
						window.location.href = providerSearchPageURL + '?search=' + $(this).prev('input').val();
						return;
					}

					clearTimeout(processSearchBoxChangeTimer);
					processSearchBoxChangeTimer = setTimeout(function($elem) {
						processSearchBoxChange($elem);
					}, processSearchBoxChangeInterval, $(this).prev('input'));
				});

				function search($elem) {
					//console.log('search');
					//console.log($elem.val());
					if($elem.val().length < 3) {
						//console.log('Too short');
						return;
					}

					let searchArgs = {
						searchText: $elem.val(),
					};
					
					if($elem.data('posttype')) {
						//console.log('Post type = ' + $elem.data('posttype'));
						searchArgs.postType = [$elem.data('posttype')];
					}

					if($elem.data('language')) {
						//console.log('Language = ' + $elem.data('language'));
						searchArgs.language = $elem.data('language');
					}

					$.ajax({
						url: estyn.all_search_rest_url,
						type: 'GET',
						data: searchArgs,
						beforeSend: function(xhr) {
							xhr.setRequestHeader('X-WP-Nonce', estyn.nonce);
						},
						success: function(response) {
							//console.log(response);
							// Find the next <datalist> element
							const $datalist = $elem.nextAll('datalist:first');

							//const $modal = $elem.prevAll('.estyn-search-results-modal:first');
							// Use the element's data-bs-target attribute to find the modal
							let $modal = $($elem.next('button').data('bs-target'));

							if(!$modal.length) {
								// Assume the modal is a container of the search box
								$modal = $elem.closest('.estyn-search-results-modal');
							}
							
							//console.log('Modal ID = ' + $modal.attr('id'));


							const $modalUL = $modal.find('ul');
							$modalUL.empty();

							// Clear the <datalist>
							$datalist.empty();
							// Add the new options (if the response is not an empty array)
							if(!response.length) {
								//console.log('No results');
								return;
							}

							response.forEach(function(item) {
								$datalist.append(`<option value="${item.title}" data-link="${item.URL}">`);
								$modalUL.append(`<li class="list-group-item"><a href="${item.URL}">${item.title}</a></li>`);
							});
						},
					});
				}
			});
		})(jQuery);
	</script>
@endpush