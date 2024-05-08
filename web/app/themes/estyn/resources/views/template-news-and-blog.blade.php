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
				$(".search-filters input").on("change", function() {
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
						console.log(response);
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

				let year = $("#flush-collapseTwo input:checked").val();
				
				return {
					postType: postType,
					year: year
				};
			}
		})(jQuery);
	</script>
@endpush