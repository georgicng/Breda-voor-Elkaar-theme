<?php

namespace App;

use Sober\Controller\Controller;

class SingleVacancy extends Controller
{
    public function vacancy()
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

    public function organisations()
    {
        $organisations = get_users(array(
            'role' => 'organisation',
            'meta_query' => array(
                array(
                    'key' => 'vacancies',
                    'value' => '"' . get_the_ID() . '"',
                    'compare' => 'LIKE',
                ),
            ),
        ));

        return $organisations;
    }

    public function headerImage()
    {
        //get_field('afbeelding', 'user_' . $organisation->ID)
        return "http://placehold.it/1270x300";
    }
}
