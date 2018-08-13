<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveCourse extends Controller
{
    public function courses()
    {
        global $wp_query;
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'excerpt' => wp_kses_post(wp_trim_words($post->post_content, 40, '...')),
                'date' =>  date_format(date_create(get_field("date", $post->ID)), "d M"),
                'lesson' => get_field("lesson", $post->ID),
            ];
        }, $wp_query->posts);
    }

    public function description()
    {
        return get_the_archive_description();
    }

    public function title()
    {
        return App::title();
    }
}
