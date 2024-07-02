<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

use Geocoder\Query\GeocodeQuery;
use Geocoder\Query\ReverseQuery;
use Http\Adapter\Guzzle6\Client;
use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\StatefulGeocoder;

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
        $fields = ['address_line_1', 'address_line_2', 'address_line_3', 'address_line_4', 'town', 'county', 'postcode', 'phone', 'email'];//, 'latitude', 'longitude'];
        $data = [];

        foreach ($fields as $field) {
            $value = get_field($field);
            $data[$field] = !empty($value) ? $value : '';
        }

        $latAndLong = $this->latitudeAndLongitude();

        $data['latitude'] = $latAndLong['latitude'];
        $data['longitude'] = $latAndLong['longitude'];

        return $data;
    }

    private function latitudeAndLongitude() {
        // We'll use geocoding/address lookup to try to get
        // precise lat and long.
        // If no good then we go with the get_field('latitude') and get_field('longitude')
        // which came from the old DB but aren't as precise

        $placeName = get_the_title();
        $addressLine1 = get_field('address_line_1');
        $addressLine2 = get_field('address_line_2');
        $addressLine3 = get_field('address_line_3');
        $addressLine4 = get_field('address_line_4');
        $town = get_field('town');
        $county = get_field('county');
        $postcode = get_field('postcode');

        $latitudeACF = get_field('latitude');
        $longitudeACF = get_field('longitude');

        $GoogleMapsAPIKey = env('GOOGLE_MAPS_API_KEY');

        $fallbackReturn = ['latitude' => $latitudeACF, 'longitude' => $longitudeACF];

        if(empty($postcode) || empty($GoogleMapsAPIKey)) {
            return $fallbackReturn;
        }

        try {
            $geocodingHttpClient = new \GuzzleHttp\Client();
            $geocodingProvider = new GoogleMaps($geocodingHttpClient, null, $GoogleMapsAPIKey);
            $geocoder = new StatefulGeocoder($geocodingProvider, 'en');
        } catch(\Exception $e) {
            error_log('Error creating geocoder: ' . $e->getMessage());
            return $fallbackReturn;
        }

        $postcode = trim($postcode);
        $addressLine1 = trim($addressLine1);

        $addressLine2 = empty($addressLine2) ? '' : trim($addressLine2);
        $addressLine3 = empty($addressLine3) ? '' : trim($addressLine3);
        $addressLine4 = empty($addressLine4) ? '' : trim($addressLine4);
        $town = empty($town) ? '' : trim($town);
        $county = empty($county) ? '' : trim($county);

        // Concatenate the address fields, but only include them if they're not empty
        $address = $placeName;

        if(!empty($addressLine1)) {
            $address .= ', ' . $addressLine1;
        }
        if(!empty($addressLine2)) {
            $address .= ', ' . $addressLine2;
        }
        if(!empty($addressLine3)) {
            $address .= ', ' . $addressLine3;
        }
        if(!empty($addressLine4)) {
            $address .= ', ' . $addressLine4;
        }
        if(!empty($town)) {
            $address .= ', ' . $town;
        }
        if(!empty($county)) {
            $address .= ', ' . $county;
        }
        $address .= ', ' . $postcode;

        try {
            $geocodeQuery = GeocodeQuery::create($address);
            $result = $geocoder->geocodeQuery($geocodeQuery);
            $coordinates = $result->first()->getCoordinates();
            return ['latitude' => $coordinates->getLatitude(), 'longitude' => $coordinates->getLongitude()];
        } catch(\Exception $e) {
            error_log('Error geocoding address: ' . $e->getMessage());
            return $fallbackReturn;
        }

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
                    'compare' => '='
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
                    'compare' => '='
                )
            ),
        ));

        // Sort them by inspection date, descending
        usort($inspectionReports, function($a, $b) {
            $dateA = get_field('inspection_date', $a->ID);
            $dateB = get_field('inspection_date', $b->ID);

            return strtotime($dateB) - strtotime($dateA);
        });

        // Add the report file link to each report
        foreach($inspectionReports as $report) {
            $report->report_file_url = $this->getInspectionReportFileLink($report);
        }
        
        return $inspectionReports;
    }

    private function getInspectionReportFileLink($reportPost) {
        // We use get_field('report_file') to get the PDF attachment.
        // If that returns null, then we'll try the 'report_file_from_old_site' custom field (using get_post_meta()),
        // prepending the value with the uploads directory path + '/estyn_old_files/'
        $reportFile = get_field('report_file', $reportPost->ID);
        if(!$reportFile) {
            $reportFile = get_post_meta($reportPost->ID, 'report_file_from_old_site', true);
            if($reportFile) {
                // report_file_from_old_site is the filename of the PDF prepended with the old folder structure, either 'private/files' or just 'files'
                // So for example, 'private/files/filename.pdf' or 'files/filename.pdf'
                // We've emulated it this by moving the private and files folders to uploads/estyn_old_files
                $reportFile = ESTYN_OLD_FILES_URL . $reportFile;
                // Now we have to deal with the fact that some of the filenames literally have "%20" in them!
                $reportFile = explode('/', $reportFile);
                $reportFilename = array_pop($reportFile);
                $reportFile = implode('/', $reportFile) . '/' . rawurlencode($reportFilename);
            }
        } else {
            $reportFile = $reportFile['url'];
        }

        return $reportFile;
    }

    // Get the date of the next inspection report publication date,
    // or the most recent inspection report's date,
    // based on get_field('next_report_publication_date'),
    // get_post_meta('report_publication_date_old_db'),
    // or the most recent inspection report's get_field('inspection_date')
    public function reportPublicationDate() {
        $nextReportPublicationDate = get_field('next_report_publication_date');
        if(!empty($nextReportPublicationDate)) {
            // Only return it if the date is today or in the future
            $nextReportPublicationDate = get_field('next_report_publication_date');
            if(strtotime($nextReportPublicationDate) >= strtotime('today')) {
                return $nextReportPublicationDate;
            }
        }

        $nextReportPublicationDate = get_post_meta(get_the_ID(), 'report_publication_date_old_db', true);
        if(!empty($nextReportPublicationDate)) {
            // Only return it if the date is today or in the future
            if(strtotime($nextReportPublicationDate) >= strtotime('today')) {
                return $nextReportPublicationDate;
            }
        }
        
        // If we want to use the most recent inspection report's date
        // then uncomment all this
/*         if(!$this->hasInspectionReports()) {
            return null;
        }

        $reports = $this->getInspectionReports(); // Note: Already sorted by inspection date, descending

        return get_field('inspection_date', $reports[0]->ID);    */ 
        
        return null;
    }

    public function getNextInspectionDate() {
        if(!empty(get_field('next_scheduled_inspection_date'))) {
            return get_field('next_scheduled_inspection_date');
        }

        if(!empty(get_post_meta(get_the_ID(), 'next_visit_date_old_db', true))) {
            return get_post_meta(get_the_ID(), 'next_visit_date_old_db', true);
        }

        return null;
    }
}