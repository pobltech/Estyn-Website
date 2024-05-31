<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SectorComposer extends Composer
{
    protected static $views = [
        'taxonomy-sector'
    ];

    public function with()
    {
        $term = get_queried_object();

        $wtpTags = get_field('improvement_resources_tags', $term); // ACF repeater field

        $wtpTagLinkDotColours = [
            'bg-signpost-blue',
            'bg-signpost-lime',
            'bg-signpost-verylightbrown',
            'bg-signpost-lightpink',
            'bg-signpost-darkpink',
            'bg-signpost-green'
        ];

        if(empty($wtpTags)) {
            // We'll use the default tags (Numeracy, Welsh Language, etc.)
            $wtpTags = [2605, 2697, 2589, 2529, 2627, 2503];
        } else {
            // 
            $wtpTags = array_map(function($tag) {
                return $tag['tag']; // The subfield name in the repeater field, which is a term ID
            }, $wtpTags);
        }
        
        $wtpTags = array_map(function($tag) {
            $tagData = get_term(pll_get_term($tag));

            return [
                'name' => $tagData->name,
                'slug' => $tagData->slug,
                'url' => \App\get_permalink_by_template('template-search.blade.php') . '?tag=' . rawurlencode($tagData->name),
            ];
        }, $wtpTags);
    

        return [
            'term' => $term,
            'wtpTags' => $wtpTags,
            'wtpTagLinkDotColours' => $wtpTagLinkDotColours
        ];
    }
}