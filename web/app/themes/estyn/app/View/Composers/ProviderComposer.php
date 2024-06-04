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