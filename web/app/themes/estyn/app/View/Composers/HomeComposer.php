<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class HomeComposer extends Composer
{
    protected static $views = [
        'template-home'
    ];

    public function with()
    {
        return [
            'homeData' => $this->homeData()
        ];
    }
    private function homeData() {
        $homeData = [];

        $homeData['intro_buttons'] = $this->heroIntroButtons();

        $homeData['cta'] = [
            'heading' => get_field('home_cta_heading'),
            'text' => get_field('home_cta_text'),
            'image_url' => get_field('home_cta_image')['url'],
            'image_alt' => get_field('home_cta_image')['alt'],
            'button_text' => get_field('home_cta_button_text'),
            'button_link' => get_permalink(get_field('home_cta_button_content_to_link_to_post'))
        ];
        
        return $homeData;
    }

    private function heroIntroButtons() {
        // There should be an ACF repeater field called home-hero-inside-hero-buttons. (Don't ask why it's hyphenated instead of underscored.)
        // Each should have button_label and content_to_link_to_post_object subfields

        $buttons = get_field('home-hero-inside-hero-buttons');
        $buttonData = [];

        if ($buttons) {
            foreach ($buttons as $button) {
                $buttonData[] = [
                    'text' => $button['button_label'],
                    'url' => get_permalink($button['content_to_link_to_post_object'])
                ];
            }
        }

        return empty($buttonData) ? null : $buttonData;
    }
}