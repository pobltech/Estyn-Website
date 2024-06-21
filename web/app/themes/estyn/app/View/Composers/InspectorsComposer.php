<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class InspectorsComposer extends Composer
{
    protected static $views = [
        'template-inspectors-page',
        'partials.inspectors-page-signposting'
    ];

    public function with()
    {
        return [
            'signpostingComponentItems' => $this->signpostingComponentItems(),
            'pictureLinks' => $this->pictureLinks(),
        ];
    }

    private function signpostingComponentItems() {
        $signposts = get_field('estyn_inspectors_signposts');

        $items = [];

        foreach($signposts as $signpost) {
            $items[] = [
                'bgColour' => $signpost['signpost_colour'],
                'iconClasses' => 'fa-solid ' . $signpost['icon'],
                'title' => $signpost['link_text'],
                'description' => $signpost['description'],
                'linkURL' => empty($signpost['custom_or_external_link']) ? get_permalink($signpost['link'][0]->ID) : $signpost['custom_or_external_link'],
            ];
        }

        return $items;
    }

    private function pictureLinks() {
        $pictureLinks = get_field('estyn_inspectors_picture_links');

        $items = [];

        foreach($pictureLinks as $pictureLink) {
            $items[] = [
                'imageID' => $pictureLink['image']['ID'],
                'linkText' => $pictureLink['link_text'],
                'linkURL' => empty($pictureLink['custom_or_external_link']) ? get_permalink($pictureLink['link'][0]->ID) : $pictureLink['custom_or_external_link'],
            ];
        }

        return $items;
    }
}