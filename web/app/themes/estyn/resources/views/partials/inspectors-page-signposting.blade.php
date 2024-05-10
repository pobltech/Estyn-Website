@include('components.signposting', [
	'signposts' => [
		[
			'bgColourClass' => 'bg-signpost-blue',
			'iconClasses' => 'fas fa-search',
			'title' => __('Guidance', 'sage'),
			'description' => __('What and how inspect', 'sage'),
			'linkURL' => '#'
		],
		[
			'bgColourClass' => 'bg-signpost-lime',
			'iconClasses' => 'fas fa-user-plus',
			'title' => __('Supplementary guidance', 'sage'),
			'description' => __('List of supplementary guidance', 'sage'),
			'linkURL' => '#'
		],
		[
			'bgColourClass' => 'bg-signpost-verylightbrown',
			'iconClasses' => 'fas fa-user-edit',
			'title' => __('My local school', 'sage'),
			'description' => __('Welsh Government portal', 'sage'),
			'linkURL' => '#'
		],
		[
			'bgColourClass' => 'bg-signpost-pink',
			'iconClasses' => 'fas fa-question',
			'title' => __('My sector', 'sage'),
			'description' => __('Link to VWS', 'sage'),
			'linkURL' => '#'
		],
		[
			'bgColourClass' => 'bg-signpost-darkpink',
			'iconClasses' => 'fas fa-question',
			'title' => __('Lorem ipsumd dolor sit amet', 'sage'),
			'description' => __('Nulla vitae ipsum et metus lobortis', 'sage'),
			'linkURL' => '#'
		],
		[
			'bgColourClass' => 'bg-signpost-green',
			'iconClasses' => 'fas fa-question',
			'title' => __('Lorem ipsumd dolor sit amet', 'sage'),
			'description' => __('Nulla vitae ipsum et metus lobortis', 'sage'),
			'linkURL' => '#'
		]
	]
])