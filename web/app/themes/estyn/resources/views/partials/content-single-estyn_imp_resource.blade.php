<article @php(post_class('h-entry pb-5'))>
<?php
    $pageHeaderArgs = [
        'title' => $title ?? get_the_title(),
        'subtitle' => $subtitle ?? null,
        'readTime' => $readTime ?? null,
        'showShareButton' => true,
        'date' => $date ?? null
    ];

    $resourceTypes = get_the_terms(get_the_ID(), 'improvement_resource_type');
    
    $isThematicReport = false;
    $isEffectivePractice = false;
    $isAnnualReport = false;
    $isAdditionalResource = false;

    if($resourceTypes) {
        $resourceTypeString = '';

        foreach($resourceTypes as $resourceType) {
            // echo the slug in a h2 for debugging
             //echo '<h2>' . $resourceType->slug . '</h2>';

            if($resourceTypeString == '') {
              $resourceTypeString .= $resourceType->name;
            } else {
              $resourceTypeString .= ', ' . $resourceType->name;
            }

            // TODO: DEV NOTE: If the slugs change, update the conditions below
            if( ($resourceType->slug == __('thematic-report', 'sage')) || ($resourceType->slug == 'thematic-report') || (get_term(pll_get_term($resourceType->term_id, 'en'))->slug == 'thematic-report') ) {
              //$pageHeaderArgs['fullWidth'] = true;

              //echo '<h2>' . __('Thematic Report', 'sage') . '</h2>';

              $isThematicReport = true;
            } elseif ($resourceType->slug == __('effective-practice', 'sage') || $resourceType->slug == 'effective-practice' || (get_term(pll_get_term($resourceType->term_id, 'en'))->slug == 'effective-practice') ) {
              $isEffectivePractice = true;
            } elseif ($resourceType->slug == __('annual-report', 'sage') || $resourceType->slug == 'annual-report' || (get_term(pll_get_term($resourceType->term_id, 'en'))->slug == 'annual-report') ) {
              $isAnnualReport = true;
            } elseif ($resourceType->slug == __('additional-resource', 'sage') || $resourceType->slug == 'additional-resource' || (get_term(pll_get_term($resourceType->term_id, 'en'))->slug == 'additional-resource') ) {
              $isAdditionalResource = true;
            }
        }

        $pageHeaderArgs['subtitle'] = $resourceTypeString;
    }

    $providerPostID = null;

    $reportResources = null; // For Thematic Reports


    if($isThematicReport) {
      $reportResources = get_field('report_resources');

      $pageHeaderArgs['extraButtons'] = [
          ['text' => __('Download report', 'sage') . ($thematicReportData['fullReportLanguage'] != pll_current_language() ? (pll_current_language() == 'cy' ? ' (Saesneg)' : ' (Welsh)') : ''), 'url' => $thematicReportData['fullReportDownloadURL'] ?? '#', 'iconClasses' => 'fa-sharp fa-solid fa-file-arrow-down']
      ];

      if(!empty($thematicReportResources)) {
        $pageHeaderArgs['dropdownButtons'] = [];
        $dropdownButtons = [];
        foreach($thematicReportResources as $resource) {
          $dropdownButtons[] = ['title' => $resource['title'], 'url' => $resource['file']];
        }

        $pageHeaderArgs['dropdownButtons'][] = ['buttonLabel' => __('Resources', 'sage'), 'iconClasses' => 'fa-sharp fa-solid fa-chevron-down', 'items' => $dropdownButtons];
      }

      if($reportResources) {
        $pageHeaderArgs['extraButtons'][] = ['text' => __('Resources', 'sage'), 'url' => '#resources', 'iconClasses' => 'fa-sharp fa-solid fa-chevron-down'];
      }
    } elseif($isEffectivePractice) {
        $providerPost = get_field('resource_creator');

        if($providerPost) {
          $providerPostID = $providerPost->ID;
        }
    }

    if($providerPostID) {
        $providerName = get_the_title($providerPostID);
        $providerIconImage = get_field('icon_image', $providerPostID) ? get_field('icon_image', $providerPostID) : null;
        $providerNumPupils = get_field('number_of_pupils', $providerPostID) ? get_field('number_of_pupils', $providerPostID) : null;
        $providerAgeRange = get_field('age_range', $providerPostID) ? get_field('age_range', $providerPostID) : null;

        $pageHeaderArgs['providerDetails'] = [
            'name' => $providerName,
            'icon_image' => $providerIconImage,
            'number_of_pupils' => $providerNumPupils,
            'age_range' => $providerAgeRange
        ];
    }
?>
@include('partials.page-header', $pageHeaderArgs)
@if($isThematicReport)
    <div class="reportMain">
		<div class="container px-md-4 px-xl-5">
			<div class="row d-flex justify-content-center">
				<div class="col-12 col-lg-10 col-xl-8">
					<div class="row">
						<div class="col-12">
              <?php
                /**
                 * Thematic Reports have a lot of meta fields, possible attachments,
                 * possible images, mostly from the import of old site data, but newer
                 * reports will have different meta etc. The OLD stuff:
                 * 
                 * Post Meta:
                 *
                 * document_node_files_uris, documents_uris, pdfs_uris
                 *    - Any of these that are not empty should contain at least
                 *      one URL to the PDF (or in a handful of cases, PPTX).
                 *      If there are multiple, they are separated by a pipe (|).
                 *    - The URLs are in the form private/files/... or files/... so
                 *      they need to be prefixed with the site's uploads folder URL +
                 *      /estyn_old_files/ to be usable.
                 *    - It's possible they were attached to the post during import, so
                 *      you should check for attachments (of type PDF and PPTX) first.
                 *
                 *  document_thumbnails_uris
                 *    - This is a thumbnail image for the document, if it exists.
                 *    - It's possible that there are multiple, separated by a pipe (|).
                 *    - The URLs are the full URL to the image, so they should be usable, IF
                 *    a search-and-replace for "http://127.0.0.1:8013" on the database has been done.
                 *    Alternatively, just use the post's featured image. Hopefully, in all cases, there
                 *    was only one image found and therefore got set as the featured image during import.
                 *
                 *    There's also featured_providers, which is a list of provider post IDs separated by a comma,
                 *    and last_updated (yyyymmdd) BUT both of these should be ACF fields which are used by
                 *    by all thematic reports, old and new and may have overriden the old meta fields, so
                 *    you should try get_field('featured_providers') and get_field('last_updated') first.
                 *
                 *
                 *    The NEW stuff:
                 *
                 *    ACF Fields:
                 *
                 *    featured_providers (ACF Relationship field),
                 *    last_updated (ACF Date field),
                 *    report_resources (ACF Relationship field),
                 *    full_report_file (ACF File field)
                 */

                /*if (has_post_thumbnail()) {
                  the_post_thumbnail(null, ['class' => 'w-100 img-fluid rounded-3 mb-4']);
                }*/

                // If there's an explicitly defined excerpt, show it, else show the content
                //if (get_the_excerpt() && !preg_match('/\[\.\.\.\]$/', get_the_excerpt())) {
                if(has_excerpt()) {
                  the_excerpt();
                
                  if(!empty(get_the_content())) {
                    echo '<hr>';
                  }
                }

                if(!empty(get_the_content())) {
                  the_content();
                }
                
              ?>
              @if(get_field('featured_providers') || get_post_meta(get_the_ID(), 'featured_providers', true))
                <?php
                  $featuredProviders = get_field('featured_providers');

                  if(!$featuredProviders) {
                    $featuredProviders = get_post_meta(get_the_ID(), 'featured_providers', true);
                  }

                  /*echo('<pre>');
                  var_dump($featuredProviders);
                  echo('</pre>');*/
                  
                  if(!empty($featuredProviders)) {
                    if(is_string($featuredProviders)) {
                        $featuredProviders = explode(',', $featuredProviders);

                        // Remove any empty values
                        $featuredProviders = array_filter($featuredProviders);

                        // If there are no values, set it to null
                        if(empty($featuredProviders)) {
                          $featuredProviders = null;
                        } else {
                          // Get the provider post objects
                          $featuredProviders = array_map(function($providerID) {
                            return get_post($providerID);
                          }, $featuredProviders);
                        }
                    }
                  } else {
                    $featuredProviders = null;
                  }
                ?>
              @endif
              @if(!empty($featuredProviders))
                <hr>
							  <h3>{{ __('Featured providers', 'sage') }}</h3>
                <?php
                  $items = [];
                  foreach($featuredProviders as $provider) {
                    $items[] = [
                      'linkURL' => get_permalink($provider->ID),
                      'title' => $provider->post_title
                    ];
                  }

                  // Order by title
                  usort($items, function($a, $b) {
                    return $a['title'] <=> $b['title'];
                  });

                  // Remove duplicates
                  $items = array_map("unserialize", array_unique(array_map("serialize", $items)));
                ?>
                @include('components.resource-list', ['items' => $items])
              @endif
							{{--<div class="list-group list-group-flush reportProviders my-4">
								<a href="#" class="list-group-item list-group-item-action">St Teilo's C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Coedcae School</a>
								<a href="#" class="list-group-item list-group-item-action">The Bishop Of Llandaff C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">St Alban's R.C. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Cefn Hengoed Community School</a>
								<a href="#" class="list-group-item list-group-item-action">Bassaleg School</a>--}}
							</div>
              <?php
                //$reportResources = get_field('report_resources');

                if($reportResources) {
                  $items = [];

                  foreach($reportResources as $resource) {
                    $items[] = [
                      'linkURL' => get_permalink($resource->ID),
                      'title' => $resource->post_title
                    ];
                  }
                }
              ?>
              @if($reportResources)
                <hr id="resources">
                <h3>{{ __('Resources', 'sage') }}</h3>
                @include('components.resource-list', ['items' => $items])
              @endif
							{{--<hr id="resources">
							<h3>{{ __('Resources', 'sage') }}</h3>
							<div class="list-group list-group-flush resourceList my-4">
								<a href="#" class="list-group-item list-group-item-action">St Teilo's C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Coedcae School</a>
								<a href="#" class="list-group-item list-group-item-action">The Bishop Of Llandaff C.I.W. High School</a>
								<a href="#" class="list-group-item list-group-item-action">St Alban's R.C. High School</a>
								<a href="#" class="list-group-item list-group-item-action">Cefn Hengoed Community School</a>
								<a href="#" class="list-group-item list-group-item-action">Bassaleg School</a>
							</div>--}}
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
		'ctaButtonLinkURL' => $thematicReportData['fullReportDownloadURL'] ?? '#',
		'ctaButtonText' => __('Download the full report', 'sage'),
		'ctaButtonIconClasses' => 'fa-sharp fa-solid fa-file-arrow-down',
		'ctaContainerExtraClasses' => 'pb-md-5',
	])
{{--   <div class="reportMain pt-md-4">
    <div class="container px-md-4 px-xl-5">
      <div class="row d-flex justify-content-between">
        <div class="col-12 col-md-4">
          <div class="row">
            <div class="col-12 col-md-11">
              <button class="btn btn-outline-info d-md-none" data-bs-toggle="collapse" data-bs-target="#contents"><span>{{ __('Contents', 'sage' ) }}</span><i class="fa-sharp fa-solid fa-chevron-down"></i></button>
              <hr class="d-md-none">

              <div class="search-filters collapse d-md-block pb-5" id="contents">
                <h3 class="mb-4">Contents</h3>

                <div class="reportContents list-group list-group-flush">
                  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    The current link item
                  </a>
                  <a href="#" class="list-group-item list-group-item-action">A second link item</a>
                  <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                  <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="col-12 col-md-8">
          @php(the_content())

          @if ($pagination)
            <footer>
              <nav class="page-nav" aria-label="Page">
                {!! $pagination !!}
              </nav>
            </footer>
          @endif
        </div>
      </div>
    </div>
  </div> --}}
@else
  <div class="reportMain">
    <div class="container px-md-4 px-xl-5">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
              <div class="row">
                <div class="col-12">
                    @if (has_post_thumbnail())
                      @php(the_post_thumbnail(null, ['class' => 'w-100 img-fluid rounded-3 mb-4']))
                    @endif

                    @if($isEffectivePractice)
                      @if(!empty($quickLinks))
                        <div class="quick-links mt-5">
                          <p class="mb-1"><strong>{{ __('Quick links', 'sage') . ':' }}</strong></p>
                          <ul class="list-unstyled">
                            @foreach($quickLinks as $quickLink)
                              <li><a href="{{ $quickLink['link'] }}">{{ $quickLink['title'] }}</a></li>
                            @endforeach
                          </ul>
                        </div>
                        <hr>
                      @endif
                    @endif

                    @if($isAdditionalResource)
                      <?php
                        if (get_the_excerpt() && !preg_match('/\[\.\.\.\]$/', get_the_excerpt())) {
                          the_excerpt();
                        
                          if(!empty(get_the_content())) {
                            echo '<hr>';
                          }
                        }

                        if(!empty(get_the_content())) {
                          the_content();
                        }
                      ?>
                    @else
                      @php(the_content())
                    @endif

                    @if($isAdditionalResource)
                      @if(!empty(get_field('resources')))
                        <hr>
                        <h3>{{ __('Resources', 'sage') }}</h3>
                        <?php
                          $items = [];
                          $resourcePosts = get_field('resources');
                          foreach($resourcePosts as $resourcePost) {
                            $items[] = [
                              'linkURL' => get_permalink($resourcePost->ID),
                              'title' => $resourcePost->post_title
                            ];
                          }
                        ?>
                        @include('components.resource-list', ['items' => $items])
                      @endif
                    @endif

                    @if ($pagination)
                      <footer>
                        <nav class="page-nav" aria-label="Page">
                          {!! $pagination !!}
                        </nav>
                      </footer>
                    @endif

                  <hr>
                  @if($providerPostID)
                    @include('partials.provider-resources-list',
                      [
                        'providerPostID' => $providerPostID,
                        'excludeResource' => get_the_ID(),
                      ]
                    )
                  @endif
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
@endif
</article>
@if($isEffectivePractice)
  @push('scripts')
    <script>
      // Clever script to add the functionality to the Quick Links section

      document.addEventListener('DOMContentLoaded', function() {
        const headings = document.querySelectorAll('.reportMain h2, .reportMain h3, .reportMain h4, .reportMain h5, .reportMain h6');

        headings.forEach(function(heading) {
          if(!heading.id) {
            let id = heading.textContent.toLowerCase().replace(/[^a-z0-9]/g, '-');
            id = id.replace(/-+$/, '');
            heading.id = id;
          }
        });

        const quickLinks = document.querySelectorAll('.quick-links a');

        quickLinks.forEach(function(quickLink) {
          const href = quickLink.getAttribute('href');

          // Set the href to the heading ID
          quickLink.setAttribute('href', '#' + headings[Array.from(headings).findIndex(heading => heading.textContent === quickLink.textContent)].id);
        });
      });
    </script>
  @endpush
@endif