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
            'pastEventsCTACarouselItems' => $this->pastEventsCTACarouselItems(),
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

        $current_language = pll_current_language();
        $locale = $current_language == 'cy' ? 'cy_GB' : get_locale();

        $formatter = new \IntlDateFormatter(
            $locale,
            \IntlDateFormatter::LONG,
            \IntlDateFormatter::NONE,
            date_default_timezone_get(),
            \IntlDateFormatter::GREGORIAN,
            'd MMMM yyyy' // Adjust the date format as needed
        );

        foreach($events as $event) {
            // If the date has passed, skip this event
            if(strtotime(get_field('event_date', $event)) < time()) {
                continue;
            }

            $timestamp = strtotime(get_field('event_date', $event));
            $formatted_date = $formatter->format($timestamp);        

            $args = [
                'title' => get_the_title($event),
                'date' => get_field('event_date', $event),
                'formatted_date' => $formatted_date,
                'timestamp' => $timestamp,
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

    private function pastEventsCTACarouselItems() {
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
            // If the date hasn't passed, skip this event
            if(strtotime(get_field('event_date', $event)) > time()) {
                continue;
            }

            $args = [
                'link' => empty(get_field('event_external_link', $event)) ? get_permalink($event) : get_field('event_external_link', $event),
                'image' => get_the_post_thumbnail_url($event, 'full'),
                'alt' => get_post_meta(get_post_thumbnail_id($event), '_wp_attachment_image_alt', true),
                'caption' => get_field('event_summary', $event),
            ];

            $items[] = $args;
        }

        return $items;
    }
}