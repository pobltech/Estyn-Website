<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FooterComposer extends Composer
{
    protected static $views = [
        'sections.footer'
    ];

    public function with()
    {
        return [
            'footerData' => $this->footerData()
        ];
    }

    private function globalItemsPost() {
        $globalItems = get_posts([
            'post_type' => 'global',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ]);

        return $globalItems[0];
    }

    private function footerData() {
        $globalItemsPost = $this->globalItemsPost();

        return [
            'address' => get_field('address', $globalItemsPost->ID),
            'phone' => get_field('phone_number', $globalItemsPost->ID),
            'email' => get_field('email_address', $globalItemsPost->ID),
            'x_twitter_url' => get_field('x_twitter_url', $globalItemsPost->ID),
            'facebook_url' => get_field('facebook_url', $globalItemsPost->ID),
            'linkedin_url' => get_field('linkedin_url', $globalItemsPost->ID),
        ];
    }

}