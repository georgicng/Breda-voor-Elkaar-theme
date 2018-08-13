<?php

namespace App;

use Sober\Controller\Controller;

class SingleOrganisations extends Controller
{
    private $ID;

    public function __construct()
    {
        $this->ID = get_queried_object()->ID;
    }

    public function vacancies()
    {
        $args = array(
            'author' => $this->ID,
            'post_type' => 'vacancies',
        );
        $posts = get_posts($args);
        wp_reset_postdata();
        return array_map(function ($post) {
            $more = '.<a href="' . get_permalink($post->ID) . '" class="card-link vacancy-card__link">lees meer ›</a>';
            return [
                'title' => $post->post_title,
                'link' => get_permalink($post->ID),
                'image_link' => get_the_post_thumbnail_url($post->ID, [200, 200]),
                'excerpt' => wp_kses_post(wp_trim_words($post->post_content, 25, $more)),
                'subtitle' => $post->post_title,
                'footer' => get_field("image_link", $post->ID),
            ];
        }, $posts);
    }

    public function meta()
    {
        return get_user_meta($this->ID);
    }

    public function data()
    {
        return get_userdata($this->ID);
    }

    public function categories()
    {
        return get_field('categorie', 'user_' . $this->ID);
    }

    public function image()
    {
        return get_field('afbeelding', 'user_' . $this->ID);
    }

    public function address()
    {
        return get_field('adres', 'user_' . $this->ID);
    }

    public function vacancyTitle()
    {
        return 'Vacatures van Naam van vereniging';
    }

    public function social()
    {
        return [
            'instagram' => '#',
            'twitter' => '#',
            'facebook' => '#',
            'linkedin' => '#',
            'youtube' => '#',
        ];
    }
}
