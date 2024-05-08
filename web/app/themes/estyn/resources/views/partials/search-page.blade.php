{{--
  Search page can be:

  News/blog posts.
  Inspection reports.
  Inspection schedule?
  Providers (schools etc.)
  Improvement resources.

  They may share some of the same search filters,
  but mostly have their own.

  News/blog posts:
  - Type (news/blog)(News Articles is a CPT, blog posts are Posts)
  - Dates

  Inspection reports:
  - Sector
  - Local authority

  Inspection schedule:
  - Sector
  - Local authority

  Providers:
  - Sector
  - Local authority
  - Tags
  - 'Similar settings to mine':
  -- Proximity
  -- Number of learners
  -- Language medium
  -- Age range

  Improvement resources:
  - Sector
  - Local authority
  - Tags
  - Updated
  - Type

--}}

<div class="searchHero mt-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<div class="col-12">
				<h1 class="mb-4">{{ get_the_title() }}</h1>
			</div>
		</div>
	</div>
</div>
<section class="searchBody mb-5">
	<div class="container px-md-4 px-xl-5">
		<div class="row">
			<!-- Search filter -->
			<div class="searchFilter col-12 col-md-4">
				<div class="row">
					<div class="col-12 col-md-11">

						<div id="search-box-container" class="input-group mb-4">
						  <input type="text" class="form-control" placeholder="" aria-label="Search filter" aria-describedby="searchFilter">
						  <button class="btn btn-primary" type="button" id="searchFilter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
						</div>

            <button class="btn btn-outline-info d-md-none" data-bs-toggle="collapse" data-bs-target="#search-filters">{{ __('Filter results', 'sage' ) }}</button>
            <hr class="d-md-none">

            <div class="search-filters collapse d-md-block pb-5" id="search-filters">
              <h3>Filters</h3>
              <div class="accordion accordion-flush" id="accordionFlushExample">
                @if(isset($isNewsAndBlog) && $isNewsAndBlog)
                              <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                      Type
                                    </button>
                                  </h2>
                                  <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="postType" id="flexCheckNewsAndBlog" checked>
                                        <label class="form-check-label" for="flexCheckNewsAndBlog">
                                          {{ __('All', 'sage') }}
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="postType" value="estyn_newsarticle" id="flexCheckNews">
                                        <label class="form-check-label" for="flexCheckNews">
                                          {{ __('News article', 'sage') }}
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="postType" value="post" id="flexCheckBlog">
                                        <label class="form-check-label" for="flexCheckBlog">
                                          {{ __('Blog post', 'sage') }}
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                              </div>
                              <div class="accordion-item">
                                  <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                      {{ __('Dates', 'sage') }}
                                    </button>
                                  </h2>
                                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                      <div class="form-check">
                                        <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                                        <label class="form-check-label" for="flexCheckYearDefault">
                                          {{ __('Any year', 'sage') }}
                                        </label>
                                      </div>
                                      @for ($i = 2013; $i <= intval(date('Y')); $i++)
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="year" value="{{ $i }}" id="flexCheckYear{{ $i }}">
                                          <label class="form-check-label" for="flexCheckYear{{ $i }}">
                                            {{ $i }}
                                          </label>
                                        </div>
                                      @endfor
                                    </div>
                                  </div>
                              </div>
                            @else
                            <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-heading-sector">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse-sector" aria-expanded="false" aria-controls="flush-collapse-sector">
                      Sector
                    </button>
                  </h2>
                  <div id="flush-collapse-sector" class="accordion-collapse collapse" aria-labelledby="flush-heading-sector" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                    <input class="form-check-input" type="radio" name="sector" value="any" id="flexCheckSector-any" checked>
                    <label class="form-check-label" for="flexCheckSector-any">
                      {{ __('Any sector', 'sage') }}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="sector" value="" id="flexCheckSector-Secondary">
                    <label class="form-check-label" for="flexCheckSector-Secondary">
                      {{ __('Secondary', 'sage') }}
                    </label>
                  </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      Local authority
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Controls</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      Tags
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">Controls</div>
                  </div>
                </div>
                            @endif
              </div>
              @if((!isset($isNewsAndBlog)) && (!isset($isInspectionReportsSearch)) && (!isset($isInspectionScheduleSearch)))
                <h3 class="mt-5">Similar settings to mine</h3>
                <div class="accordion accordion-flush" id="accordionFlushExample2">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne2" aria-expanded="false" aria-controls="flush-collapseOne2">
                        Proximity
                      </button>
                    </h2>
                    <div id="flush-collapseOne2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne2" data-bs-parent="#accordionFlushExample2">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">
                          <label class="form-check-label" for="flexCheckDefault2">
                            Default checkbox
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" checked>
                          <label class="form-check-label" for="flexCheckChecked2">
                            Checked checkbox
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>      
              @endif
            </div>
					</div>
				</div>
			</div>
			<!-- Search Results -->
      @php
        $isNewsAndBlog = isset($isNewsAndBlog) ? $isNewsAndBlog : false;
        $isInspectionReportsSearch = isset($isInspectionReportsSearch) ? $isInspectionReportsSearch : false;
        $isInspectionScheduleSearch = isset($isInspectionScheduleSearch) ? $isInspectionScheduleSearch : false;

        $isProviderSearch = isset($isProviderSearch) ? $isProviderSearch : false;

        $isImprovementResourcesSearch = isset($isImprovementResourcesSearch) ? $isImprovementResourcesSearch : false;

        $searchQuery = null;
        $searchArgs = null;

        if($isNewsAndBlog) {
          $searchArgs = [
            'post_type' => ['estyn_newsarticle', 'post'],
            'posts_per_page' => -1,
            'orderby' => 'modified',
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['s'])) {
            $searchArgs['s'] = trim($_GET['s']);
          }
        }

        if(!empty($searchArgs)) {
          $searchQuery = new WP_Query($searchArgs);
        }
      @endphp
			<div class="searchResultsMain col-12 col-md-8">
				<div class="row">
					<div class="col-12">
						<div class="d-flex align-items-center align-items-md-start justify-content-between">
							<span><span class="search-results-number">{{ (!empty($searchQuery)) && $searchQuery->have_posts() ? $searchQuery->found_posts : '0' }}</span> {{ __('result/s', 'sage') }}</span>
              <span class="d-flex align-items-center">
							<label class="text-nowrap me-3" for="sort-by">Sort by</label>
                <select id="sort-by" class="form-select" aria-label="Default select example">
                    <option value="modified">{{ __('Latest updated') }}</option>
                    <option value="title">{{ __('Title') }}</option>
                    <option value="date">{{ __('Publication date') }}</option>
                    <option value="type">{{ __('Type') }}</option>
                  </select>
                </span>
						</div>
						<hr class="hrGreen my-3">
					</div>
					<div class="col-12">
            <div class="d-flex justify-content-center">
              <div class="search-results-loading-indicator spinner-border text-primary" role="status" style="display: none;">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div id="search-results">
              <div class="list-group list-group-flush resourceList">
                @if(!empty($searchQuery))
                  @php
                    $items = [];
                  @endphp
                  @if($searchQuery->have_posts())
                    @while($searchQuery->have_posts())
                      @php
                        $searchQuery->the_post();

                        $postTypeName = (get_post_type_object(get_post_type()))->labels->singular_name;
                        if($postTypeName == 'Post') {
                          $postTypeName = __('Blog post', 'sage');
                        }

                        $postTypeName = ucfirst(strtolower($postTypeName));

                        $items[] = [
                          'linkURL' => get_the_permalink(),
                          'superText' => $postTypeName,
                          'superDate' => get_the_date('d/m/Y'),
                          'title' => get_the_title()
                        ];
                      @endphp
                    @endwhile

                    @php
                      wp_reset_postdata();
                    @endphp
                  @endif

                  @if(!empty($items))
                    @include('components.resource-list', [
                      'items' => $items
                    ])
                  @else
                    <p>{{ __('No results found', 'sage') }}</p>
                  @endif
                @else
                @if(isset($isNewsAndBlog) && $isNewsAndBlog)
                                  @include('components.resource-list', [
                                      'items' => [
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Improving teaching through an emphasis on professional learning'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Improving attendance in secondary schools'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Improving attendance in secondary schools - training materials'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Developing early communication skills with predominantly pre verbal pupils'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Motivating pupils to speak Welsh'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'News article',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Developing a programme to provide targeted support for vulnerable learners to improve their attendance'
                                          ]
                                      ]
                                  ])
                              @elseif(isset($isInspectionReportsSearch) && $isInspectionReportsSearch)
                                  @include('components.resource-list', [
                                      'items' => [
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'Inspection report',
                                              'superDate' => '24/01/2024',
                                              'title' => 'Cardiff High School'
                                          ],
                                          [
                                              'linkURL' => '#',
                                              'superText' => 'Inspection report',
                                              'superDate' => '21/03/2023',
                                              'title' => 'Cwmbran High School'
                                          ]
                                      ]
                                  ])
                              @elseif(isset($isInspectionScheduleSearch) && $isInspectionScheduleSearch)
                                @include('components.resource-list', [
                                  'items' => [
                                    [
                                      'linkURL' => '#',
                                      'superText' => 'Upcoming inspection',
                                      'superDate' => '05/11/2024',
                                      'title' => 'Cardiff High School'
                                    ],
                                    [
                                      'linkURL' => '#',
                                      'superText' => 'Upcoming inspection',
                                      'superDate' => '15/12/2024',
                                      'title' => 'Cwmbran High School'
                                    ]
                                  ]
                                ])
                              @else
                              @include('components.resource-list', [
                                  'items' => [
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Improving teaching through an emphasis on professional learning'
                                      ],
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Improving attendance in secondary schools'
                                      ],
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Improving attendance in secondary schools - training materials'
                                      ],
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Developing early communication skills with predominantly pre verbal pupils'
                                      ],
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Motivating pupils to speak Welsh'
                                      ],
                                      [
                                          'linkURL' => '#',
                                          'superText' => 'Effective practice',
                                          'superDate' => '24/01/2024',
                                          'title' => 'Developing a programme to provide targeted support for vulnerable learners to improve their attendance'
                                      ]
                                  ]
                              ])
                              @endif
                            @endif
              </div>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>