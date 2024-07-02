@include('components.signposting', [
	'heading' => __('I want to...', 'sage'),
	'signposts' => $homePageSignposts,
	'sectionClasses' => 'pt-md-5'
])