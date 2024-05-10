{{--
	Template Name: Report Landing Page
--}}
@extends('layouts.app')

@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.page-header', [
	  'title' => get_the_title(),
	  'subtitle' => __('Thematic report', 'sage'),
	  'readTime' => 11,
	  'shareLinkURL' => '#',
	  'date' => '31 January 2024',
	  'extraButtons' => [
		['text' => __('Download report', 'sage'), 'url' => '#download-full-report', 'iconClasses' => 'fa-sharp fa-solid fa-file-arrow-down'],
		['text' => __('Resources', 'sage'), 'url' => '#resources', 'iconClasses' => 'fa-sharp fa-solid fa-chevron-down']
	  ]
	])

    <div class="reportMain">
		<div class="container px-md-4 px-xl-5">
			<div class="row d-flex justify-content-center">
				<div class="col-12 col-lg-10 col-xl-8">
					<div class="row">
						<div class="col-12">
							<p>This report focuses on the strategies and actions that secondary schools were employing in order to improve pupils' attendance. It also considers the support provided by local authorities. The report identifies strengths and areas for improvement in practice and the barriers school leaders identified to pupils attending school and therefore improving attendance. It also includes cameos and case studies of effective practice.</p>
							<hr>
							<h3>Recommendations</h3>
							<p><strong>Schools should:</strong>
							<ul>
								<li>Strengthen planning to strategically improve attendance, including making effective use of data to identify trends and in planning long term approaches to improving pupils' attendance</li>
								<li>Strengthen their approach to monitoring, evaluating and improving attendance</li>
								<li>Strengthen their work with parents/carers to explain why good attendance is important</li>
								<li>Develop more effective methods to gather the views of pupils who do not attend school regularly</li>
								<li>Ensure that teaching and the curriculum offer engages pupils in learning</li>
							</ul>
							<hr>
							<h3>Featured providers</h3>
							<div class="list-group list-group-flush reportProviders my-4">
								<a href="#" class="list-group-item list-group-item-action">St Teilo's C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Coedcae School</a>
								<a href="#" class="list-group-item list-group-item-action">The Bishop Of Llandaff C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">St Alban's R.C. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Cefn Hengoed Community School</a>
								<a href="#" class="list-group-item list-group-item-action">Bassaleg School</a>
							</div>
							<hr id="resources">
							<h3>Resources</h3>
							<div class="list-group list-group-flush resourceList my-4">
								<a href="#" class="list-group-item list-group-item-action">St Teilo's C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Coedcae School</a>
								<a href="#" class="list-group-item list-group-item-action">The Bishop Of Llandaff C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">St Alban's R.C. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Cefn Hengoed Community School</a>
								<a href="#" class="list-group-item list-group-item-action">Bassaleg School</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('partials.cta', [
		'noArc' => true,
		'ctaUniqueID' => 'download-full-report',
		'ctaHeading' => __('Download the full report', 'sage'),
		'ctaButtonLinkURL' => '#',
		'ctaButtonText' => __('Download the full report', 'sage'),
		'ctaButtonIconClasses' => 'fa-sharp fa-solid fa-file-arrow-down',
		'ctaContainerExtraClasses' => 'pb-md-5',
	])
  @endwhile
@endsection
