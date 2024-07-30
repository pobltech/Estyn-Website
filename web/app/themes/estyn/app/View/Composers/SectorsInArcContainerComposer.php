<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SectorsInArcContainerComposer extends Composer
{
    protected static $views = [
        'partials.sectors-inside-full-width-arc-container'
    ];

    public function with()
    {
        return [
            'sectors' => $this->sectors(),
            'elemUniqueID' => uniqid()
        ];
    }

    public function sectors()
    {
        $sectors = get_terms([
            'taxonomy' => 'sector',
            'hide_empty' => false,
            /* 'orderby' => 'count', */
            'orderby' => 'term_order',
            /* 'order' => 'DESC' */
        ]);

        // Format them as an array of items, each being an array with 'title' and 'linkURL' keys
        $sectors = array_map(function($sector) {
            return [
                'title' => $sector->name,
                'linkURL' => get_term_link($sector)
            ];
        }, $sectors);

        return $sectors;
    }
}