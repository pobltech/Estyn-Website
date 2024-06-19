<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AnnualReportComposer extends Composer
{
    protected static $views = [
        'template-annual-report',
    ];

    public function with()
    {
        return [
            'annualReportArchiveResourceListItems' => $this->annualReportArchiveResourceListItems(),            
        ];
    }

    private function annualReportArchiveResourceListItems() {
        /**
         * Get all 'estyn_imp_resource' posts of type ('improvement_resource_type' taxonomy) 'annual-report'.
         * For each one, get the associated report file URL using get_field('report_file').
         * 
         * Return an array like this:
         * 
         * [[ 'link' => 'http://example.com/report.pdf', 'title' => 'Report Title'], ...]
         */

        $args = [
            'post_type' => 'estyn_imp_resource',
            'tax_query' => [
                [
                    'taxonomy' => 'improvement_resource_type',
                    'field' => 'slug',
                    'terms' => 'annual-report',
                ],
            ],
        ];

        $query = new \WP_Query($args);

        $resources = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $resources[] = [
                    'linkURL' => get_field('report_file')['url'],
                    'title' => get_the_title(),
                ];
            }
        }

        wp_reset_postdata();

        return $resources;
    }
}