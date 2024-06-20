<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class EventsComposer extends Composer
{
    protected static $views = [
        'template-events',
    ];

    public function with()
    {
        return [
            'eventsCarouselItems' => $this->eventsCarouselItems(),
        ];
    }

    private function eventsCarouselItems() {
        /**
         * Get all 'estyn_event' posts
         */
        $events = get_posts([
            'post_type' => 'estyn_event',
            'posts_per_page' => -1,
            'orderby' => 'date',
            'order' => 'DESC',
        ]);

        $items = [];

        foreach($events as $event) {
            $args = [
                'title' => get_the_title($event),
                'date' => get_field('event_date', $event),
                'link' => empty(get_field('event_external_link', $event)) ? get_permalink($event) : get_field('event_external_link', $event),
                'featured_image_src' => get_the_post_thumbnail_url($event, 'full'),
                'featured_image_alt' => get_post_meta(get_post_thumbnail_id($event), '_wp_attachment_image_alt', true),
            ];

            $eventTags = get_the_terms($event, 'event_tag');
            if($eventTags) {
                $args['tag'] = $eventTags[0]->name;
            }

            $items[] = $args;
        }

        return $items;
    }
}