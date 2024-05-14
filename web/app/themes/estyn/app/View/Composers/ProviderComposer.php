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
            'providerData' => $this->providerData()
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
}