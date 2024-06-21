<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class JobVacanciesComposer extends Composer
{
    protected static $views = [
        'template-vacancies',
    ];

    public function with()
    {
        return [
            'jobVacanciesListItems' => $this->jobVacanciesListItems(),            
        ];
    }

    private function jobVacanciesListItems() {
        /**
         * Get all the estyn_job_vacancy posts
         */
        $jobVacancies = get_posts([
            'post_type' => 'estyn_job_vacancy',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'ASC',
        ]);

        $jobVacanciesListItems = [];

        foreach($jobVacancies as $job) {
            $date = $job->post_date;
            if(!empty(get_field('application_deadline_date', $job->ID))) {
                // NOTE: ACF date field return format should be set Ymd e.g. 20240131
                $date = get_field('application_deadline_date', $job->ID);

                // If the date has passed, skip this job
                if(new \DateTime($date) < new \DateTime()) {
                    continue;
                }
            }

            $args = [];

            $args['title'] = $job->post_title;

            $args['linkURL'] = get_permalink($job->ID);

            // A job is "featured" (if it has a recruitment_start_date and recruitment_end_date,
            // and the recruitment_start_date is only 2 weeks away from now
            $recruitmentStartDate = get_field('recruitment_start_date', $job->ID);
            $recruitmentEndDate = get_field('recruitment_end_date', $job->ID);

            $featured = false;

            if(!empty($recruitmentStartDate) && !empty($recruitmentEndDate)) {
                $recruitmentStartDate = new \DateTime($recruitmentStartDate);
                $recruitmentEndDate = new \DateTime($recruitmentEndDate);

                $now = new \DateTime();

                $diff = $now->diff($recruitmentStartDate);

                if($diff->days <= 14) {
                    $featured = true;
                }
            }

            if(!$featured) {
                $positionType = get_field('position_type', $job->ID);
                if(!empty($positionType)) {
                    $args['superText'] = $positionType;
                }

                $args['superDate'] = $date;
            } else {
                $args['greenVersion'] = true;
                $args['superText'] = __('Recruitment starts from', 'sage') . ' ' . $recruitmentStartDate->format('d/m/Y') . ' - ' . $recruitmentEndDate->format('d/m/Y');

                $shortSummary = get_field('short_summary', $job->ID);
                if(!empty($shortSummary)) {
                    $args['extraText'] = $shortSummary;
                }
            }

            $jobVacanciesListItems[] = $args;
        }

        return $jobVacanciesListItems;
    }
}