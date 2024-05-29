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

        $homeData['intro_buttons'] = [
            [
                'text' => __('Parents, carers & learners', 'sage'),
                'url' => get_permalink(pll_get_post(431)) // Improvement Resources
            ],
            [
                'text' => __('Education professionals', 'sage'),
                'url' => get_permalink(pll_get_post(431)) // Improvement Resources
            ]
        ];
        
        return $homeData;
    }
}