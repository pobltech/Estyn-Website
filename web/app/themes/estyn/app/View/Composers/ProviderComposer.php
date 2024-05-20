<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class ProviderComposer extends Composer
{
    protected static $views = [
        'partials.content-single-estyn_eduprovider'
    ];

    public function with()
    {
        return [
            'providerData' => $this->providerData(),
            'hasResources' => $this->hasResources(),
            'hasInspectionReports' => $this->hasInspectionReports(),
            'inspectionReports' => $this->getInspectionReports(),
            'reportPublicationDate' => $this->reportPublicationDate(),
            'nextInspectionDate' => $this->getNextInspectionDate()
        ];
    }

    public function providerData()
    {
        $fields = ['address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'town', 'county', 'postcode', 'phone', 'email', 'latitude', 'longitude'];
        $data = [];

        foreach ($fields as $field) {
            $value = get_field($field);
            $data[$field] = !empty($value) ? $value : '';
        }

        return $data;
    }

    public function hasResources() {
        $resources = $this->getResources();
        
        return !empty($resources);
    }

    public function getResources() {
        $resources = get_posts(array(
            'post_type' => 'estyn_imp_resource',
            'meta_query' => array(
                array(
                    'key' => 'resource_creator',
                    'value' => get_the_ID(),
                    'compare' => 'LIKE'
                )
            )
        ));
        
        return $resources;
    }

    public function hasInspectionReports() {
        $inspectionReports = $this->getInspectionReports();
        
        return !empty($inspectionReports);
    }

    public function getInspectionReports() {
        $inspectionReports = get_posts(array(
            'post_type' => 'estyn_inspectionrpt',
            'meta_query' => array(
                array(
                    'key' => 'inspected_provider',
                    'value' => get_the_ID(),
                    'compare' => 'LIKE'
                )
            ),
        ));

        // Sort them by inspection date, descending
        usort($inspectionReports, function($a, $b) {
            $dateA = get_field('inspection_date', $a->ID);
            $dateB = get_field('inspection_date', $b->ID);

            return strtotime($dateB) - strtotime($dateA);
        });
        
        return $inspectionReports;
    }

    // Get the date of the most recent inspection report, based on get_field('inspection_date')
    public function reportPublicationDate() {
        if(!$this->hasInspectionReports()) {
            return false;
        }

        $reports = $this->getInspectionReports();

        return get_field('inspection_date', $reports[0]->ID);     
    }

    public function getNextInspectionDate() {
        return get_field('next_scheduled_inspection_date') ?? null;
    }
}