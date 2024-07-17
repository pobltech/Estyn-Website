<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class SearchComposer extends Composer
{
    protected static $views = [
        'partials.search-page'
    ];

    public function with()
    {
        return [
            'sectors' => $this->sectors(),
            'localAuthorities' => $this->localAuthorities(),
            'tags' => $this->tags(),
            'improvementResourceTypes' => $this->improvementResourceTypes(),
            'inspectionGuidanceTypes' => $this->inspectionGuidanceTypes(),
            'inspectionQuestionnaireCategories' => $this->inspectionQuestionnaireCategories(),
        ];
    }

    public function sectors()
    {
        $sectors = get_terms([
            'taxonomy' => 'sector',
            'hide_empty' => false,
            'orderby' => 'count',
            'order' => 'DESC'
        ]);

        return $sectors;
    }

    public function localAuthorities()
    {
        $localAuthorities = get_terms([
            'taxonomy' => 'local_authority',
            'hide_empty' => false,
        ]);

        return $localAuthorities;
    }

    public function tags()
    {
        $tags = get_terms([
            'taxonomy' => 'post_tag',
            'hide_empty' => false,
        ]);

        return $tags;
    }

    public function improvementResourceTypes()
    {
        $improvementResourceTypes = get_terms([
            'taxonomy' => 'improvement_resource_type',
            'hide_empty' => false,
        ]);

        return $improvementResourceTypes;
    }

    public function inspectionGuidanceTypes() {
        $inspectionGuidanceTypes = get_terms([
            'taxonomy' => 'inspection_guidance_type',
            'hide_empty' => false,
        ]);

        return $inspectionGuidanceTypes;
    }

    public function inspectionQuestionnaireCategories() {
        $inspectionQuestionnaireCategories = get_terms([
            'taxonomy' => 'inspection_questionnaire_cat',
            'hide_empty' => false,
        ]);

        return $inspectionQuestionnaireCategories;
    }
}