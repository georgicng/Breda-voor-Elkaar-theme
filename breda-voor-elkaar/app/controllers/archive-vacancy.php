<?php

namespace App;

use Sober\Controller\Controller;

class ArchiveVacancy extends Controller
{

    public function vacancies()
    {
        global $posts;
        return array_map(function ($post) {
            return [
                'title' => $post->post_title,
                'link' => $post->post_permalink,
                'image_link' => get_field("image_link", $post->ID),
                'excerpt' => $post->post_excerpt,
                'subtitle' => $post->post_title,
                'footer' => get_field("image_link", $post->ID),
            ];
        }, $posts);
    }

}
