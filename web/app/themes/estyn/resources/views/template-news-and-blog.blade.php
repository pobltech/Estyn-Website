{{--
	Template name: News and blog page
 --}}
@extends('layouts.app')

@section('content')
	@include('partials.search-page', [
		'isNewsAndBlog' => true
	])
@endsection
@section('scripts')
	<script>
		(function($) {
			$(document).ready(function() {
				$(".search-filters input").on("change", function() {
					applyFiltersAjax();
				});
			});

			function applyFiltersAjax() {
				console.log("Applying filters");
				var searchFilters = getSearchFilters();
				$.ajax({
					url: "/wp-admin/admin-ajax.php",
					type: "POST",
					data: {
						action: "apply_filters_to_search_page",
						searchFilters: searchFilters
					},
					success: function(response) {
						console.log(response);
						$(".searchResultsMain").html(response);
					}
				});
			}

			function getSearchFilters() {
				var searchFilters = {};
				$(".search-filters input").each(function() {
					var $this = $(this);
					var name = $this.attr("name");
					var value = $this.val();
					if ($this.is(":checked")) {
						if (searchFilters[name]) {
							searchFilters[name].push(value);
						} else {
							searchFilters[name] = [value];
						}
					}
				});
				return searchFilters;
			}
		})(jQuery);
	</script>
@endsection