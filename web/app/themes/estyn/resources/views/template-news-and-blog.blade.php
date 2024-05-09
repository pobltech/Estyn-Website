{{--
	Template name: News and blog page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isNewsAndBlog' => true
	])
@endsection
@push('scripts')
	<script>
		(function($) {
			let searchBoxTypingTimer = setTimeout(function() {}, 0);
			const searchBoxTypingInterval = 500;

			$(document).ready(function() {
				hideSearchResultsLoadingIndicator();

				$(".search-filters input:not([type='text'])").on("change", function() {
					applyFilters();
				});

				$("#search-box-container input[type='text']").on("keydown keyup", function(key) {
					if(key.keyCode === 13) {
						clearTimeout(searchBoxTypingTimer);

						applyFilters();

						return;
					}
				});

				$("#search-box-container input[type='text']").on("input", function() {
					clearTimeout(searchBoxTypingTimer);

					searchBoxTypingTimer = setTimeout(function() {
						applyFilters();
					}, searchBoxTypingInterval);
				});

				$("#search-box-container button").on("click", function() {
					applyFilters();
				});

				$("#sort-by").on("change", function() {
					applyFilters();
				});
			});

			function applyFilters() {
				clearTimeout(searchBoxTypingTimer);
				showSearchResultsLoadingIndicator();

				$("#search-results").fadeOut(250, function() {
					var searchFilters = getSearchFilters();
					$.ajax({
						url: estyn.news_and_blog_posts_search_rest_url,
						type: "GET",
						data: searchFilters,
						beforeSend: function(xhr) {
							xhr.setRequestHeader('X-WP-Nonce', estyn.nonce);
						},
						success: function(response) {
							//console.log(response);
							
								$("#search-results").html(response.html);
								$("#search-results").fadeIn(250);
								$(".search-results-number").text(response.totalPosts);
							
							
							hideSearchResultsLoadingIndicator();
						}
					});
				});
			}

			function getSearchFilters() {
				let postType = "";
				if($("#flexCheckNews").is(":checked")) {
					postType = $("#flexCheckNews").val();
				} else if($("#flexCheckBlog").is(":checked")) {
					postType = $("#flexCheckBlog").val();
				}

				let sort = $("#sort-by").val();
				
				return {
					postType: postType,
					year: $("#flush-collapseTwo input:checked").val(),
					searchText: $("#search-box-container input[type='text']").val().trim(),
					sort: sort
				};
			}

			function hideSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 0
				}, 1000);
			}

			function showSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 1
				}, 250);
			}
		})(jQuery);
	</script>
@endpush