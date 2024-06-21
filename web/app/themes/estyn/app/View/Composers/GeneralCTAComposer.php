<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class GeneralCTAComposer extends Composer
{
    protected static $views = [
        'template-vacancies',
    ];

    public function with()
    {
        return [
            'generalCTAPartialArgs' => $this->generalCTAPartialArgs(),            
        ];
    }

    private function generalCTAPartialArgs() {
        /*
        @include('partials.cta', [
            'ctaHeading' => get_field('general_cta_heading'),
            'ctaContent' => get_field('general_cta_text'),
            'ctaImageURL' => get_field('general_cta_image')['url'],
            'ctaImageAlt' => get_field('general_cta_image')['alt'],
            'ctaButtons' => array_map(function($button) {
                return [
                    // NOTE: external_link is a text field, link is post object (from ACF relationship field with max 1 post allowed)
                    'link' => empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'],
                    'text' => $button['label']
                ];
            }, get_field('general_cta_buttons'))
        ])
        */

        $args = [];

        $args['ctaHeading'] = get_field('general_cta_heading');
        $args['ctaContent'] = get_field('general_cta_text');
        $args['ctaImageURL'] = get_field('general_cta_image')['url'];
        $args['ctaImageAlt'] = get_field('general_cta_image')['alt'];
        $args['ctaButtons'] = array_map(function($button) {
            return [
                'link' => empty($button['external_link']) ? get_permalink($button['link'][0]->ID) : $button['external_link'],
                'text' => $button['label']
            ];
        }, get_field('general_cta_buttons'));

        return $args;
    }
}