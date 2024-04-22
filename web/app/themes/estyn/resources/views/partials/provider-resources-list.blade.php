@php
    $resources = get_posts(array(
        'post_type' => 'estyn_imp_resource',
        'meta_query' => array(
            array(
                'key' => 'resource_creator',
                'value' => $providerPost->ID,
                'compare' => 'LIKE'
            )
        )
    ));

    if(!empty($resources)) {
        $items = [];
        foreach ($resources as $resource) {
            $items[] = [
                'linkURL' => get_permalink($resource->ID),
                'title' => get_the_title($resource->ID),
                'superText' => get_the_terms($resource->ID, 'improvement_resource_type')[0]->name,
                'superDate' => get_the_date('d/m/Y', $resource->ID),
                'dateOnRight' => true
            ];
        }
    }

    wp_reset_postdata();
@endphp
@if(!empty($resources))
    <h2 class="h2">{{ __('Other resources from this provider', 'sage') }}</h2>
    @include('components.resource-list', [
        'items' => $items,
        'noMarginBottom' => true
    ])
@endif