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
				let searchBoxTypeingTimer;
				let searchBoxTypingInterval = 500;
				
				$(".search-filters input:not([type='text'])").on("change", function() {
					applyFilters();
				});

				$("#search-box-container input[type='text']").on("keyup", function(key) {
					clearTimeout(searchBoxTypeingTimer);
					
					if($(this).val().length == 0) {
						applyFilters();
						return;
					}

					if(key.keyCode === 13) {
						applyFilters();
						return;
					}

					searchBoxTypeingTimer = setTimeout(function() {
						applyFilters();
					}, searchBoxTypingInterval);
				});

				$("#search-box-container button").on("click", function() {
					applyFilters();
				});
			});

			function applyFilters() {
				var searchFilters = getSearchFilters();
				$.ajax({
					url: "{{ rest_url('estyn/v1/newsandblogposts') }}",
					type: "GET",
					data: searchFilters,
					success: function(response) {
						//console.log(response);
						$("#search-results").html(response);
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
				
				return {
					postType: postType,
					year: $("#flush-collapseTwo input:checked").val(),
					searchText: $("#search-box-container input[type='text']").val().trim()
				};
			}
		})(jQuery);
	</script>
@endpush