<article @php(post_class('h-entry'))>
<?php
    $pageHeaderArgs = [
        'title' => $title ?? get_the_title(),
        'subtitle' => $subtitle ?? null,
        'readTime' => $readTime ?? null,
        'shareLinkURL' => $shareLinkURL ?? '#',
        'date' => $date ?? null
    ];

    $providerPost = get_field('resource_creator');

    if($providerPost) {
        $providerPost = $providerPost[0]; // Get the first one; there should only be one
        $providerName = get_the_title($providerPost->ID);
        $providerIconImage = get_field('icon_image', $providerPost->ID) ? get_field('icon_image', $providerPost->ID) : null;
        $providerNumPupils = get_field('number_of_pupils', $providerPost->ID) ? get_field('number_of_pupils', $providerPost->ID) : null;
        $providerAgeRange = get_field('age_range', $providerPost->ID) ? get_field('age_range', $providerPost->ID) : null;

        $pageHeaderArgs['providerDetails'] = [
            'name' => $providerName,
            'icon_image' => $providerIconImage,
            'number_of_pupils' => $providerNumPupils,
            'age_range' => $providerAgeRange
        ];
    }

    $resourceTypes = get_the_terms(get_the_ID(), 'improvement_resource_type');
    
    $isThematicReport = false;

    if($resourceTypes) {
        $resourceTypeString = '';

        foreach($resourceTypes as $resourceType) {
            if($resourceTypeString == '') {
              $resourceTypeString .= $resourceType->name;
            } else {
              $resourceTypeString .= ', ' . $resourceType->name;
            }

            // If this is a Thematic Report then we want full width
            if($resourceType->slug == 'thematic-report') {
              $pageHeaderArgs['fullWidth'] = true;

              $isThematicReport = true;
            }
        }

        $pageHeaderArgs['subtitle'] = $resourceTypeString;
    }
?>
@include('partials.page-header', $pageHeaderArgs)
@if($isThematicReport)
  <div class="reportMain pt-md-4">
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

          {{-- comments_template(); --}}
        </div>
      </div>
    </div>
  </div>
@else
  <div class="reportMain">
    <div class="container px-md-4 px-xl-5">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
              <div class="row">
                <div class="col-12">
                    @if (has_post_thumbnail())
                      @php(the_post_thumbnail(null, ['class' => 'img-fluid rounded-3 mb-4']))
                    @endif

                    @php(the_content())

                    @if ($pagination)
                      <footer>
                        <nav class="page-nav" aria-label="Page">
                          {!! $pagination !!}
                        </nav>
                      </footer>
                    @endif

                  <hr>
                  @if($providerPost)
                    @include('partials.provider-resources-list',
                      ['providerPost' => $providerPost]
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