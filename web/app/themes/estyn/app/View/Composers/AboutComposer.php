<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AboutComposer extends Composer
{
    protected static $views = [
        'template-about',
    ];

    public function with()
    {
        return [
            
        ];
    }
}