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
            'latestInspectionReportsResourceListItems' => $this->getLatestInspectionReportsResourceListItems()
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
}