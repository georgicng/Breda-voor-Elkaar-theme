<?php

namespace App;

use Sober\Controller\Controller;

class SingleVacancy extends Controller
{
    private $organisation;

    public function __construct()
    {
        $this->getOrganisation();
    }

    public function title()
    {
        return $this->organisation->user_nicename;
    }

    public function user()
    {
        return [
            'link' => get_author_posts_url($this->organisation->ID),
            'name' => $this->organisation->user_nicename,
            'cover' => get_field('afbeelding', "user_{$this->organisation->ID}"),
            'category' => get_field('categorie', "user_{$this->organisation->ID}"),
            'address' => get_field('adres', "user_{$this->organisation->ID}"),

        ];
    }

    public function headerImage()
    {
        $image = get_field('afbeelding', "user_{$this->organisation->ID}");
        return !empty($image) ? $image : '//placehold.it/1200x350';
    }

    private function getValue($var)
    {
        return is_array($var) ? $var[0] : $var;
    }

    public function acf()
    {
        return [
            'vergoeding' => $this->getValue(get_field('vergoeding')),
            'ervaring' => $this->getValue(get_field('lervaring')),
            'opleidingsniveau' => $this->getValue(get_field('opleidingsniveau')),
        ];
    }

    public function vacancy()
    {
        global $post;

        return [
            'title' => $post->post_title,
            'content' => $post->post_content,
        ];
    }

    public function getOrganisation()
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

        $this->organisation = $organisations[0];
    }
}
