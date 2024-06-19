<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class HeroComposer extends Composer
{
    protected static $views = [
        'template-about',
        'template-events',
        'template-vacancies',
        'template-annual-report',
    ];

    public function with()
    {
        return [
            'insideHeroPartialArgs' => $this->insideHeroPartialArgs(),
        ];
    }

    public function insideHeroPartialArgs() {
        $title = get_the_title();

        $heroImage = get_field('hero_image');
        // Use Wordpress function to get the img tag
        //$heroImageTag = wp_get_attachment_image($heroImage['ID'], 'full');

        $introImage = get_field('hero_intro_image');

        $introHeading = get_field('hero_intro_heading');
        $introContent = get_field('hero_intro_content');

        $introLinks = [];
        $introButtons = get_field('hero_buttons');

        if(!empty($introButtons)) {
            foreach ($introButtons as $button) {
                $introLinks[] = [
                    'text' => $button['button_label'],
                    // 'Button link (external)' overrides 'Button link'
                    // 'Button Link' is an ACF relationship field. Max 1.
                    'url' => empty($button['button_link_external']) ? get_permalink($button['button_link'][0]) : $button['button_link_external'],
                ];
            }
        }

        $args = [
            'title' => $title,
            'heroImageID' => $heroImage['ID'],
            'introImageID' => $introImage['ID'],
            'secondHeading' => $introHeading,
            'introContent' => $introContent,
        ];

        if(!empty($introLinks)) {
            $args['introLinks'] = $introLinks;
        }

        return $args;
    }
}