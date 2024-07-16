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
            'homeData' => $this->homeData(),
            'homePageSignposts' => $this->signposts()
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

        $waysToImproveCarouselItems = get_field('home_ways_to_improve_carousel_items');
        if(!empty($waysToImproveCarouselItems)) {
            $homeData['ways_to_improve_carousel_items'] = [];
            foreach($waysToImproveCarouselItems as $item) {
                $homeData['ways_to_improve_carousel_items'][] = [
                    'featured_image_src' => $item['image']['url'],
                    'featured_image_alt' => $item['image']['alt'],
                    'title' => $item['heading'],
                    'excerpt' => $item['subheading'],
                    'link' => empty($item['custom_link']) ? get_permalink($item['content_to_link_to_post']) : $item['custom_link']
                ];
            }
        }

        $faqs = get_field('home_faqs'); // ACF Repeater field, each with a question and answer
        if(!empty($faqs)) {
            $faqs = array_map(function($faq) {
                return [
                    'question' => $faq['question'],
                    'answer' => $faq['answer']
                ];
            }, $faqs);

            $homeData['faqs'] = $faqs;
        }
        
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

    private function signposts() {
        $signposts = get_field('estyn_home_signposts');

        if(empty($signposts)) {
            return [
                [
                    'bgColourClass' => 'bg-signpost-blue',
                    'svg' => asset('images/estyn-logo-icon-only-darkblue.svg'),
                    'title' => __('Learn more about Estyn', 'sage'),
                    'description' => __('Who we are and what we do', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-about.blade.php')
                ],
                [
                    'bgColourClass' => 'bg-signpost-lime',
                    'iconClasses' => 'fa-regular fa-chart-line-up',
                    'title' => __('Improve my setting', 'sage'),
                    'description' => __('Explore ways to improve with Estyn', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-search.blade.php')
                ],
                [
                    'bgColourClass' => 'bg-signpost-verylightbrown',
                    'iconClasses' => 'fa-regular fa-calendar-days',
                    'title' => __('View the inspection schedule', 'sage'),
                    'description' => __('Details on when we\'ll be visiting providers', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-inspection-schedule-search-page.blade.php')
                ],
                [
                    'bgColourClass' => 'bg-signpost-lightpink',
                    'iconClasses' => 'fa-solid fa-clipboard-check',
                    'title' => __('Find an inspection report', 'sage'),
                    'description' => __('View all our inspection reports', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-inspection-report-search.blade.php')
                ],
                [
                    'bgColourClass' => 'bg-signpost-darkpink',
                    'iconClasses' => 'fa-solid fa-clipboard-list-check',
                    'title' => __('What to expect ahead of an inspection', 'sage'),
                    'description' => __('Help and support for providers', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-inspections.blade.php')
                ],
                [
                    'bgColourClass' => 'bg-signpost-green',
                    'iconClasses' => 'fa-solid fa-users-rectangle',
                    'title' => __('Work for Estyn', 'sage'),
                    'description' => __('Our current vacancies and opportunities', 'sage'),
                    'linkURL' => \App\get_permalink_by_template('template-vacancies.blade.php')
                ]
            ];
        }

        return array_map(function($signpost) {
            return [
                'bgColourClass' => $signpost['signpost_colour'],
                'iconClasses' => 'fa-solid ' . $signpost['icon'],
                'title' => $signpost['link_text'],
                'description' => $signpost['description'],
                'linkURL' => empty($signpost['custom_or_external_link']) ? get_permalink($signpost['link'][0]->ID) : $signpost['custom_or_external_link'],
            ];
        }, $signposts);
    }
}