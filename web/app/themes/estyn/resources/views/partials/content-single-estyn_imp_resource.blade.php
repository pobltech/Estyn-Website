<article @php(post_class('h-entry'))>
<?php
    $pageHeaderArgs = [
        'title' => $title ?? get_the_title(),
        'subtitle' => $subtitle ?? null,
        'readTime' => $readTime ?? null,
        'shareLinkURL' => $shareLinkURL ?? '#',
        'date' => $date ?? null
    ];

    $providerPost = get_field('resource_creator')[0];

    if($providerPost) {
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
    
    if($resourceTypes) {
        $resourceTypeString = '';

        foreach($resourceTypes as $resourceType) {
            if($resourceTypeString == '') {
              $resourceTypeString .= $resourceType->name;
            } else {
              $resourceTypeString .= ', ' . $resourceType->name;
            }
        }

        $pageHeaderArgs['subtitle'] = $resourceTypeString;
    }
?>
@include('partials.page-header', $pageHeaderArgs)
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
      
              </div>
            </div>
      </div>
    </div>
  </div>
</div>
</article>