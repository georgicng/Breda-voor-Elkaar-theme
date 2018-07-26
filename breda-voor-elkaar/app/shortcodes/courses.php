<?php
namespace App;

use WP_Query;

// Create Shortcode courses
// Use the shortcode: [courses title="Cursussen" intro="Intro over cursussen lorep ipsum Breda cras sectum" count="3"]Content[/courses]
function create_courses_shortcode($atts, $content = null)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'title' => 'Cursussen',
            'intro' => 'Intro over cursussen lorep ipsum Breda cras sectum',
            'count' => '3',
        ),
        $atts,
        'courses'
    );

    $title = $atts['title'];
    $count = $atts['count'];
    $intro = $atts['intro'];
    // WP_Query arguments
    $args = array(
        'post_type' => array('course'),
        'posts_per_page' => $count,
    );

    // The Query
    $query = new WP_Query($args);

    ob_start();

    ?>
    <section class="vacancies bg-secondary">
        <div class="container">
            <h1 class="vacancy__title"><?php echo $title ?></h1>
            <div class="row">
                <sidebar class="col-lg-4 vacancy-sidebar ">
                    <div class="bg-danger text-light p-4">
                        <h3 class="vacancy-sidebar___header"><?php echo $intro ?></h3>
                        <div class="vacancy-sidebar___text">
                            <?php echo $content ?>
                        </div>
                        <a href="<?php echo get_post_type_archive_link('vacancies'); ?>" class="btn btn-light vacancy-sidebar___button">alle cursussen ›</a>
                    </div>
                </sidebar>
                <div class="w-100 d-lg-none my-3">
                    <!-- wrap every 1 on xs-->
                </div>
                <div class="col-lg-8 vacancy__lists">
                <?php // The Loop
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();?>
                                <div class="vacancy__item vacancy-tab">
                                    <div class="vacancy-tab__top p-2 "><?php $date = date_create(get_field('date'));
            echo date_format($date, "d M");?></div>
                                        <div class="vacancy-tab__content p-4">
                                            <h3 class="vacancy-tab__header"><?php the_title()?></h3>
                                            <h3 class="vacancy-tab__subheader"><?php echo get_field('lesson'); ?> </h3>
                                            <div class="vacancy-tab__body"><?php the_excerpt()?></div>
                                            <a href="<?php echo get_permalink(); ?>" class="vacancy-tab__link">lees meer ›</a>
                                        </div>
                                    </div>
                         <?php }
    } else {?>
                                <div> No courses found </div>
                    <?php }?>
                    </div>
            </div>
        </div>
    </section>
    <?php

    $output = ob_get_contents();
    ob_end_clean();

// Restore original Post Data
    wp_reset_postdata();

    return $output;

}

add_shortcode('courses', __NAMESPACE__ . '\\create_courses_shortcode');