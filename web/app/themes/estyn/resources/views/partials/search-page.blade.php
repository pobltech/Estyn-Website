{{--
  Search page can be:

  News/blog posts.
  Inspection reports.
  Inspection schedule?
  Improvement resources.

  They may share some of the same search filters,
  but mostly have their own.

  News/blog posts:
  - Type (news/blog)(News Articles is a CPT, blog posts are Posts)
  - Dates (year)
  - [Tags? (blog posts only)]
  - Sort: Publication date, title, type

  Inspection reports:
  - Sector
  - Local authority
  - Sort: Latest updated, publication date, title

  Inspection schedule:
  - Sector
  - Local authority

  Improvement resources:
  - Sector
  - Local authority
  - Tags
  - Updated??
  - Type (Thematic Report, Effective Practice, or Additional Resource)
  - Year
  - Sort: Latest updated, publication date, title, type

  Provider search:
  - Sector
  - Local authority
  - Sort: Title

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
              <h3>{{ __('Filters', 'sage') }}</h3>
              <div class="accordion accordion-flush" id="accordionFlushExample">
                @if(isset($isNewsAndBlog) && $isNewsAndBlog)
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          {{ __('Type', 'sage') }}
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
                      {{ __('Sector', 'sage') }}
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
                      @foreach($sectors as $sector)
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="sector" value="{{ $sector->slug }}" id="flexCheckSector-{{ $sector->slug }}">
                          <label class="form-check-label" for="flexCheckSector-{{ $sector->slug }}">
                            {{ $sector->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                      {{ __('Local authority', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="localAuthority" value="Any" id="flexCheckLocalAuthority-any" checked>
                        <label class="form-check-label" for="flexCheckLocalAuthority-any">
                          {{ __('Any local authority', 'sage') }}
                        </label>
                      </div>
                      @foreach($localAuthorities as $localAuthority)
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="localAuthority" value="{{ $localAuthority->slug }}" id="flexCheckLocalAuthority-{{ $localAuthority->slug }}">
                          <label class="form-check-label" for="flexCheckLocalAuthority-{{ $localAuthority->slug }}">
                            {{ $localAuthority->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @if(isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch && isset($tags) && !empty($tags))
                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                      {{ __('Tags', 'sage') }}
                    </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                      @foreach($tags as $tag)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="{{ $tag->slug }}" name="tags[]">
                          <label class="form-check-label" for="flexCheckTags-{{ $tag->slug }}">
                            {{ $tag->name }}
                          </label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
                @endif
                @if(isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch && isset($improvementResourceTypes) && !empty($improvementResourceTypes))
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingFour">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                        {{ __('Type', 'sage') }}
                      </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="improvement_resource_type" value="any" id="flexCheckType-any" checked>
                          <label class="form-check-label" for="flexCheckType-any">
                            {{ __('Any type', 'sage') }}
                          </label>
                        </div>
                        @foreach($improvementResourceTypes as $improvementResourceType)
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="improvement_resource_type" value="{{ $improvementResourceType->slug }}" id="flexCheckType-{{ $improvementResourceType->slug }}">
                            <label class="form-check-label" for="flexCheckType-{{ $improvementResourceType->slug }}">
                              {{ $improvementResourceType->name }}
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                          {{ __('Year', 'sage') }}
                        </button>
                      </h2>
                      <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="year" id="flexCheckYearDefault" checked>
                            <label class="form-check-label" for="flexCheckYearDefault">
                              {{ __('Any year', 'sage') }}
                            </label>
                          </div>
                          @for ($i = 2005; $i <= intval(date('Y')); $i++)
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
                @endif
                @endif
              </div>
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

        if(isset($_GET['paged'])) {
          $searchArgs['paged'] = intval($_GET['paged']);
        }

        if($isNewsAndBlog) {
          $searchArgs = [
            'post_type' => ['estyn_newsarticle', 'post'],
            'posts_per_page' => 10,
            'orderby' => 'meta_value',
            'meta_key' => 'last_updated',
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['s'])) {
            $searchArgs['s'] = trim($_GET['s']);
          }
        } elseif($isImprovementResourcesSearch) {
          $searchArgs = [
            'post_type' => 'estyn_imp_resource',
            'posts_per_page' => 10,
            'orderby' => 'meta_value',
            'meta_key' => 'last_updated',
            'order' => 'DESC'
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['s'])) {
            $searchArgs['s'] = trim($_GET['s']);
          }

          // Sectors
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Local authorities
          if(isset($_GET['localAuthority']) && $_GET['localAuthority'] != 'Any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'local_authority',
                'field' => 'slug',
                'terms' => $_GET['localAuthority']
              ]
            ];
          }

          // Tags
          if(isset($_GET['tag']) && !empty($_GET['tag'])) {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'post_tag',
                'field' => 'slug',
                'terms' => $_GET['tag']
              ]
            ];
          }

          // Improvement resource type
          if(isset($_GET['improvement_resource_type']) && $_GET['improvement_resource_type'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'improvement_resource_type',
                'field' => 'slug',
                'terms' => $_GET['improvement_resource_type']
              ]
            ];
          }

          // Year
          if(isset($_GET['year']) && $_GET['year'] != 'any') {
            $searchArgs['date_query'] = [
              [
                'year' => $_GET['year']
              ]
            ];
          }

        } elseif($isInspectionReportsSearch) {
          $searchArgs = [
            'post_type' => 'estyn_inspectionrpt',
            'posts_per_page' => -1,
            'orderby' => 'modified',
          ];

          // If there's a Wordpress search query in the URL then add it to the search args
          if(isset($_GET['s'])) {
            $searchArgs['s'] = trim($_GET['s']);
          }

          // Sector
          if(isset($_GET['sector']) && $_GET['sector'] != 'any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'sector',
                'field' => 'slug',
                'terms' => $_GET['sector']
              ]
            ];
          }

          // Local authority
          if(isset($_GET['localAuthority']) && $_GET['localAuthority'] != 'Any') {
            $searchArgs['tax_query'] = [
              [
                'taxonomy' => 'local_authority',
                'field' => 'slug',
                'terms' => $_GET['localAuthority']
              ]
            ];
          }
        } elseif($isProviderSearch) {
          $searchArgs = [
            'post_type' => 'estyn_eduprovider',
            'posts_per_page' => 50,
            'orderby' => 'title',
          ];
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
                @if(!isset($isProviderSearch) || !$isProviderSearch)
                  <label class="text-nowrap me-3" for="sort-by">{{ __('Sort by', 'sage') }}</label>
                  <select id="sort-by" class="form-select">
                    @if((!isset($isNewsAndBlog) || !$isNewsAndBlog) && (!isset($isProviderSearch) || !$isProviderSearch) && (!isset($isInspectionScheduleSearch) || !$isInspectionScheduleSearch) )
                      <option value="lastUpdated">{{ __('Latest updated', 'sage') }}</option>
                    @endif
                    @if(!isset($isProviderSearch) || !$isProviderSearch)
                      <option value="date">{{ __('Publication date', 'sage') }}</option>
                    @endif
                    <option value="title">{{ __('Title', 'sage') }}</option>
                    @if((isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch) || (isset($isNewsAndBlog) && $isNewsAndBlog))
                      <option value="type">{{ __('Type', 'sage') }}</option>
                    @endif
                  </select>
                @endif
              </span>
						</div>
						<hr class="hrGreen my-3">
					</div>
					<div class="col-12 position-relative">
            <div class="search-results-loading-indicator-container d-flex justify-content-center">
              <div class="search-results-loading-indicator spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div id="search-results-container">
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
            <div class="d-flex justify-content-between mt-3">
              <button class="search-results-prev-button btn btn-outline-primary">{{ __('Previous', 'sage') }}</button>
              <button class="search-results-next-button btn btn-outline-primary">{{ __('Next', 'sage') }}</button>
            </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@push('scripts')
	<script>
		(function($) {
			let searchBoxTypingTimer = setTimeout(function() {}, 0);
			const searchBoxTypingInterval = 500;
      let currentPage = 1;

			$(document).ready(function() {
				hideSearchResultsLoadingIndicator();

				$(".search-filters input:not([type='text'])").on("change", function() {
          currentPage = 1;
					applyFilters();
				});

				$("#search-box-container input[type='text']").on("keydown keyup", function(key) {
					if(key.keyCode === 13) {
						clearTimeout(searchBoxTypingTimer);

						applyFilters();

						return;
					}
				});

				$("#search-box-container input[type='text']").on("input", function() {
					clearTimeout(searchBoxTypingTimer);

					searchBoxTypingTimer = setTimeout(function() {
            currentPage = 1;
						applyFilters();
					}, searchBoxTypingInterval);
				});

				$("#search-box-container button").on("click", function() {
          currentPage = 1;
					applyFilters();
				});

				$("#sort-by").on("change", function() {
					applyFilters();
				});

        @if(!empty($searchArgs))
          applyFilters(true);
        @endif
			});

			function applyFilters(firstApply = false) {
				clearTimeout(searchBoxTypingTimer);
				showSearchResultsLoadingIndicator();

        if(!firstApply) {
          // Set the height of the search results container to the current height of the search results,
          // to help prevent the page from jumping/flashing
          $("#search-results-container").css('height', $("#search-results").height() + 'px');
        }

				$("#search-results").fadeOut(250, function() {
					let searchFilters = getSearchFilters();
          // Add a 'language' key and value to the searchFilters object
          searchFilters.language = "{{ pll_current_language() }}";
          //console.log('Language: ' + searchFilters.language);
          searchFilters.paged = currentPage;

					$.ajax({
						url: estyn.resources_search_rest_url,
						type: "GET",
						data: searchFilters,
						beforeSend: function(xhr) {
							xhr.setRequestHeader('X-WP-Nonce', estyn.nonce);
						},
						success: function(response) {
							//console.log(response);
							
								$("#search-results").html(response.html);
								$("#search-results").fadeIn(250, function() {
                  $("#search-results-container").css('height', 'auto');
                });
								$(".search-results-number").text(response.totalPosts);

                $(".search-results-prev-button, .search-results-next-button").off("click").hide();
                if(response.totalPosts > 10) {
                  if(response.prevPage) {
                    $(".search-results-prev-button").on("click", function() {
                      currentPage = response.prevPage;
                      applyFilters();
                    }).show();
                  }
                  if(response.nextPage) {
                    $(".search-results-next-button").on("click", function() {
                      currentPage = response.nextPage;
                      applyFilters();
                    }).show();
                  }
                }

							
							
							hideSearchResultsLoadingIndicator();
						}
					});
				});
			}

      @if(isset($isNewsAndBlog) && $isNewsAndBlog)        
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
      @elseif(isset($isInspectionReportsSearch) && $isInspectionReportsSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_inspectionrpt",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val()
        };
      }

      @elseif(isset($isInspectionScheduleSearch) && $isInspectionScheduleSearch)

      @elseif(isset($isProviderSearch) && $isProviderSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_eduprovider",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim()
        };
      }
      @elseif(isset($isImprovementResourcesSearch) && $isImprovementResourcesSearch)
      function getSearchFilters() {
        return {
          postType: "estyn_imp_resource",
          sector: $("#flush-collapse-sector input:checked").val(),
          localAuthority: $("#flush-collapseTwo input:checked").val(),
          searchText: $("#search-box-container input[type='text']").val().trim(),
          sort: $("#sort-by").val(),
          tags: $("#flush-collapseThree input:checked").map(function() {
            return $(this).val();
          }).get(),
          improvementResourceType: $("#flush-collapseFour input:checked").val(),
          year: $("#flush-collapseFive input:checked").val()
        };
      }
      @endif

			function hideSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 0
				}, 1000);
			}

			function showSearchResultsLoadingIndicator() {
				$(".search-results-loading-indicator-container").animate({
					opacity: 1
				}, 250);
			}
		})(jQuery);
	</script>
@endpush