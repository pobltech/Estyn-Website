<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class InspectorsComposer extends Composer
{
    protected static $views = [
        'template-inspectors',
        'partials.inspectors-page-signposting'
    ];

    public function with()
    {
        return [
            'signpostingComponentItems' => $this->signpostingComponentItems(),
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
}