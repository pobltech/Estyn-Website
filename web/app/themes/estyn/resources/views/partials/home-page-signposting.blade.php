@include('components.signposting', [
	'heading' => __('I want to...', 'sage'),
	'signposts' => [
		[
			'bgColourClass' => 'bg-signpost-blue',
			'svg' => asset('images/estyn-logo-icon-only-darkblue.svg'),
			'title' => __('Learn more about Estyn', 'sage'),
			'description' => __('Who we are and what we do', 'sage'),
			'linkURL' => App\get_permalink_by_template('template-about.blade.php')
		],
		[
			'bgColourClass' => 'bg-signpost-lime',
			'iconClasses' => 'fa-regular fa-chart-line-up',
			'title' => __('Improve my setting', 'sage'),
			'description' => __('Explore ways to improve with Estyn', 'sage'),
			'linkURL' => App\get_permalink_by_template('template-search.blade.php')
		],
		[
			'bgColourClass' => 'bg-signpost-verylightbrown',
			'iconClasses' => 'fa-regular fa-calendar-days',
			'title' => __('View the inspection schedule', 'sage'),
			'description' => __('Details on when we\'ll be visiting providers', 'sage'),
			'linkURL' => 'https://www.google.co.uk'
		],
		[
			'bgColourClass' => 'bg-signpost-lightpink',
			'iconClasses' => 'fa-solid fa-clipboard-check',
			'title' => __('Find an inspection report', 'sage'),
			'description' => __('View all our inspection reports', 'sage'),
			'linkURL' => App\get_permalink_by_template('template-inspection-report-search.blade.php')
		],
		[
			'bgColourClass' => 'bg-signpost-darkpink',
			'iconClasses' => 'fa-solid fa-clipboard-list-check',
			'title' => __('What to expect ahead of an inspection', 'sage'),
			'description' => __('Help and support for providers', 'sage'),
			'linkURL' => 'https://www.google.co.uk'
		],
		[
			'bgColourClass' => 'bg-signpost-green',
			'iconClasses' => 'fa-solid fa-users-rectangle',
			'title' => __('Work for Estyn', 'sage'),
			'description' => __('Our current vacancies and opportunities', 'sage'),
			'linkURL' => App\get_permalink_by_template('template-vacancies.blade.php')
		]
	]
])