<section class="signposting">
	<div class="container py-5 px-md-4 px-xl-5">
		<div class="row">
			<div class="col-12">
				<h2 class="mb-4">I want to...</h2>
				<div class="row">
					<!-- SP Item -->
					<div class="col-12 col-sm-6 col-xl-4 mb-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-blue',
							'svg' => asset('images/estyn-logo-icon-only-darkblue.svg'),
							'title' => __('Learn more about Estyn', 'sage'),
							'description' => __('Who we are and what we do', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])
					</div>
					<!-- SP Item -->
					<div class="col-12 col-md-6 col-xl-4 mb-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-lime',
							'iconClasses' => 'fa-regular fa-chart-line-up',
							'title' => __('Improve my setting', 'sage'),
							'description' => __('Explore ways to improve with Estyn', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])						
					</div>
					<!-- SP Item -->
					<div class="col-12 col-md-6 col-xl-4 mb-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-verylightbrown',
							'iconClasses' => 'fa-regular fa-calendar-days',
							'title' => __('View the inspection schedule', 'sage'),
							'description' => __('Details on when we\'ll be visiting providers', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])
					</div>
					<!-- SP Item -->
					<div class="col-12 col-md-6 col-xl-4 mb-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-lightpink',
							'iconClasses' => 'fa-solid fa-clipboard-check',
							'title' => __('Find an inspection report', 'sage'),
							'description' => __('View all our inspection reports', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])
					</div>
					<!-- SP Item -->
					<div class="col-12 col-md-6 col-xl-4 mb-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-darkpink',
							'iconClasses' => 'fa-solid fa-clipboard-list-check',
							'title' => __('What to expect ahead of an inspection', 'sage'),
							'description' => __('Help and support for providers', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])
					</div>
					<!-- SP Item -->
					<div class="col-12 col-md-6 col-xl-4 position-relative">
						@include('components.signpost', [
							'bgColourClass' => 'bg-signpost-green',
							'iconClasses' => 'fa-solid fa-users-rectangle',
							'title' => __('Work for Estyn', 'sage'),
							'description' => __('Our current vacancies and opportunities', 'sage'),
							'linkURL' => 'https://www.google.co.uk'
						])
					</div>
				</div>
			</div>
		</div>
	</div>
</section>