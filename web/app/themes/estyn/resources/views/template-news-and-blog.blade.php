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
			$(document).ready(function() {
				let searchBoxTypingTimer;
				let searchBoxTypingInterval = 500;
				
				$(".search-filters input:not([type='text'])").on("change", function() {
					applyFilters();
				});

				$("#search-box-container input[type='text']").on("keyup", function(key) {
					clearTimeout(searchBoxTypingTimer);
					
					if($(this).val().length == 0) {
						applyFilters();
						return;
					}

					if(key.keyCode === 13) {
						applyFilters();
						return;
					}

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
				$(".search-results-loading-indicator").show();
				$("#search-results").html("");

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
						$("#search-results").html(response);

						$(".search-results-loading-indicator").hide();
					}
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
		})(jQuery);
	</script>
@endpush