<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveVacancies extends Controller
{

    public function vacancies()
    {
        global $posts;
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'image_link' => get_the_post_thumbnail_url($post->ID, [200, 200]),
                'excerpt' => $post->post_excerpt,
                'subtitle' => $post->post_title,
                'footer' => get_field("image_link", $post->ID),
            ];
        }, $posts);
    }

}
