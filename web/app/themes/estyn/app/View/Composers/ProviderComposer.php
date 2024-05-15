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
            'hasInspectionReports' => $this->hasInspectionReports()
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
        
        return !empty($resources);
    }

    public function hasInspectionReports() {
        $inspectionReports = get_posts(array(
            'post_type' => 'estyn_inspectionrpt',
            'meta_query' => array(
                array(
                    'key' => 'provider',
                    'value' => get_the_ID(),
                    'compare' => 'LIKE'
                )
            )
        ));
        
        return !empty($inspectionReports);
    }
}