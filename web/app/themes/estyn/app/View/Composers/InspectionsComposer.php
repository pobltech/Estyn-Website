<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class InspectionsComposer extends Composer
{
    protected static $views = [
        'template-inspections'
    ];

    public function with()
    {
        return [
            'latestInspectionReportsResourceListItems' => $this->getLatestInspectionReportsResourceListItems(),
            'inspectionScheduleResourceListItems' => $this->getInspectionScheduleResourceListItems(),
            'inspectionGuidancePostsCarouselItems' => $this->inspectionGuidancePostsCarouselItems(),
        ];
    }

    private function getLatestInspectionReportsResourceListItems()
    {
        $latestInspectionReports = get_posts([
            'post_type' => 'estyn_inspectionrpt',
            'posts_per_page' => 50,
            'orderby' => 'meta_value',
            'meta_key' => 'inspection_date',
        ]);

        $latestInspectionReportsResourceListItems = array_map(function($report) {
            $reportURL = \App\getInspectionReportFileURL($report);

            if(empty($reportURL)) {
                return null;
            }

            return [
                'linkURL' => $reportURL,
                'title' => $report->post_title,
                'superDate' => empty(get_field('inspection_date', $report)) ? get_the_date('', $report) : get_field('inspection_date', $report),
                'superText' => (!empty(get_the_terms($report, 'sector'))) ? get_the_terms($report, 'sector')[0]->name : null,
            ];
        }, $latestInspectionReports);

        // If there are any null items, we remove them
        $latestInspectionReportsResourceListItems = array_filter($latestInspectionReportsResourceListItems);

        // Cut it down to maximum of 6 items
        $latestInspectionReportsResourceListItems = array_slice($latestInspectionReportsResourceListItems, 0, 6);
        

        return $latestInspectionReportsResourceListItems;
    }

    private function getInspectionScheduleResourceListItems() {
        /**
         * Get all Providers (estyn_eduprovider) that have ACF field
         * 'next_scheduled_inspection_date' that's not empty or,
         *  'next_visit_date_old_db' custom meta field that's not empty
         */
        $providers = get_posts([
            'post_type' => 'estyn_eduprovider',
            'posts_per_page' => -1,
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key' => 'next_scheduled_inspection_date',
                    'value' => '',
                    'compare' => '!=',
                ],
                [
                    'key' => 'next_visit_date_old_db',
                    'value' => '',
                    'compare' => '!=',
                ],
            ],
        ]);

        $inspectionScheduleResourceListItems = array_map(function($provider) {
            $nextScheduledInspectionDate = get_field('next_scheduled_inspection_date', $provider);
            $nextVisitDateOldDB = get_post_meta($provider->ID, 'next_visit_date_old_db', true);

            // If the date has past, return null
            if(!empty($nextScheduledInspectionDate) && strtotime($nextScheduledInspectionDate) < time()) {
                return null;
            }
            if(!empty($nextVisitDateOldDB) && strtotime($nextVisitDateOldDB) < time()) {
                return null;
            }

            return [
                'linkURL' => get_permalink($provider),
                'title' => $provider->post_title,
                'superDate' => $nextScheduledInspectionDate ?? $nextVisitDateOldDB,
                'superText' => (!empty(get_the_terms($provider, 'sector'))) ? get_the_terms($provider, 'sector')[0]->name : null,
            ];
        }, $providers);

        // Remove any null items
        $inspectionScheduleResourceListItems = array_filter($inspectionScheduleResourceListItems);

        // Sort by date
        usort($inspectionScheduleResourceListItems, function($a, $b) {
            return strtotime($a['superDate']) - strtotime($b['superDate']);
        });

        // Cut it down to maximum of 6 items
        $inspectionScheduleResourceListItems = array_slice($inspectionScheduleResourceListItems, 0, 6);

        return $inspectionScheduleResourceListItems;
    }

    private function inspectionGuidancePostsCarouselItems() {
        $inspectionGuidancePosts = get_posts([
            'post_type' => 'estyn_inspguidance',
            'posts_per_page' => 50
        ]);

        $inspectionGuidancePostsCarouselItems = array_map(function($post) {
            $link = \App\getInspectionGuidanceFileURL($post);
            
            if(empty($link)) {
                $link = get_permalink($post);
            }

            $featuredImageURL = get_the_post_thumbnail_url($post, 'full');

            if(empty($featuredImageURL)) {
                $featuredImageURL = \App\getInspectionGuidancePostPlaceholderImageURL($post);
            }

            $title = $post->post_title;

            $excerpt = get_the_excerpt($post);
            

            return [
                'link' => $link,
                'featured_image_src' => $featuredImageURL,
                'title' => $title,
                'excerpt' => $excerpt                
            ];
        }, $inspectionGuidancePosts);

        // Cut it down to maximum of 6 items
        $inspectionGuidancePostsCarouselItems = array_slice($inspectionGuidancePostsCarouselItems, 0, 6);

        return $inspectionGuidancePostsCarouselItems;
    }
}