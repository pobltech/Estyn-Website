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

        $wtpTags = get_field('improvement_resources_tags', $term); // ACF repeater field. "Ways to Improve" section.

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

        $sectorResourcesCarouselItems = get_field('sector_resources_carousel_items', $term);
        
        if(!empty($sectorResourcesCarouselItems)) {
            // ACF repeater field, so get the subfields
            $sectorResourcesCarouselItems = array_map(function($item) {
                $image = null;
                $imageAlt = null;
                $resourcePost = get_post($item['resource'][0]); // 'resource' subfield is a relationship field. Max 1 post so we can use the first array item.
                if(!empty($item['image'])) {
                    $image = $item['image']['url'];
                    $imageAlt = $item['image']['alt'];
                } else {
                    // We try to use post's featured image, if it has one
                    $image = get_the_post_thumbnail_url($resourcePost, 'full');
                    $imageAlt = get_the_post_thumbnail_caption($resourcePost);
                }

                // If there's no image then we skip this one
                if(empty($image)) {
                    return null;
                }

                $resourceLink = get_permalink($resourcePost);

                // If the post has our custom taxonomy 'improvement_resource_type' and it's set to 'annual-report'
                // then we need to link to the resource file (e.g. the PDF) using the post's 'report_file' ACF file field,
                // or an attached PDF or PPTX file
                $reportFile = null;
                if(has_term('annual-report', 'improvement_resource_type', $resourcePost)) {
                    $reportFile = get_field('report_file', $resourcePost);
                }

                if(!empty($reportFile)) {
                    $resourceLink = $reportFile['url'];
                } else {
                    // If the post has an attached PDF or PPTX file, we use that instead
                    $attachedFiles = get_attached_media('application/pdf', $resourcePost);
                    if(!empty($attachedFiles)) {
                        $resourceLink = wp_get_attachment_url(array_values($attachedFiles)[0]->ID);
                    }
                }

                $subText = $item['sub_text'];

                if(empty($subText)) {
                    // Use the post excerpt but truncate it to 20 words
                    $subText = wp_trim_words($resourcePost->post_excerpt, 20, '...');
                }

                return [
                    'title' => $resourcePost->post_title,
                    'excerpt' => $subText, //$resourcePost->post_excerpt,
                    'link' => $resourceLink,
                    'featured_image_src' => $image,
                    'featured_image_alt' => $imageAlt,
                ];
            }, $sectorResourcesCarouselItems);

            // If there are any null items, we remove them
            $sectorResourcesCarouselItems = array_filter($sectorResourcesCarouselItems);
        }



        return [
            'term' => $term,
            'wtpTags' => $wtpTags,
            'wtpTagLinkDotColours' => $wtpTagLinkDotColours,
            'sectorResourcesCarouselItems' => $sectorResourcesCarouselItems
        ];
    }
}