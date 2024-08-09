<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class AboutComposer extends Composer
{
    protected static $views = [
        'template-about',
    ];

    public function with()
    {
        return [
            'teamMembersCarouselItems' => $this->teamMembersCarouselItems(),
            'teamMemberCategories' => $this->teamMemberCategories(),
            'newsAndBlogSliderItems' => \App\newsAndBlogSliderItems(),
        ];
    }

    private function teamMembersCarouselItems() {
        /**
         * Get all 'estyn_team_member' posts, along with their
         * associated 'team_member_category' terms (max 1 each)
         */
        $teamMembersEn = get_posts([
            'post_type' => 'estyn_team_member',
            'posts_per_page' => -1,
            'orderby' => 'menu_order',
            /* 'order' => 'ASC', */
        ]);

        $teamMembers = [];
        foreach($teamMembersEn as $teamMemberEn) {
            $teamMembers[] = get_post(pll_get_post($teamMemberEn->ID));
        }

        // Add the 'team_member_category' term to each team member post object
        $teamMembers = array_map(function($teamMember) {
            $teamMember->category = get_the_terms($teamMember->ID, 'team_member_category') ? get_the_terms($teamMember->ID, 'team_member_category')[0] : null;
            return $teamMember;
        }, $teamMembers);

        $carouselItems = [];

        foreach ($teamMembers as $teamMember) {
            $imageURL = get_the_post_thumbnail_url($teamMember->ID, 'full');
            $imageAlt = '';
            if(empty($imageURL)) {
                $imageURL = asset('images/teammemberplaceholder1.png')->uri();
                $imageAlt = __('Placeholder image', 'sage');
            } else {
                $imageAlt = get_post_meta(get_post_thumbnail_id($teamMember->ID), '_wp_attachment_image_alt', true);
            }


            $carouselItem = [
                'title' => $teamMember->post_title,
                'excerpt' => get_field('job_role_or_title', $teamMember->ID),
                'featured_image_src' => $imageURL,
                'featured_image_alt' => $imageAlt,
            ];

            // If the team member is assigned to a team member category, add the category to the carousel item
            if (!empty($teamMember->category)) {
                $carouselItem['team_member_category_term'] = $teamMember->category;
            }

            $carouselItems[] = $carouselItem;
        }

        return $carouselItems;


    }

    private function teamMemberCategories() {
        // Get all the team_member_categories terms that are assigned to at least one team member
        $teamMemberCategories = get_terms([
            'taxonomy' => 'team_member_category',
            'hide_empty' => true,
        ]);

        return $teamMemberCategories;
    }
}