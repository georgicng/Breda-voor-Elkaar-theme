<?php
namespace App;

use WP_Query;

// Create Shortcode courses
// Use the shortcode: [info_boxes]
function create_info_boxes_shortcode()
{

    // WP_Query arguments
    $args = array(
        'post_type' => array('content'),
        'posts_per_page' => 4,
    );

    // The Query
    $query = new WP_Query($args);

    ob_start();

    ?>
    <section class="top-news">
        <div class="container d-flex justify-content-center d-md-block">
            <div class="card-deck top-news__cards">
                <?php // The Loop
    if ($query->have_posts()) {
        $loop = 1;
        while ($query->have_posts()) {
            $query->the_post();?>
			 <div class="card top-news__card">
                    <div class="card-body">
                        <h3 class="card-title"><?php the_title()?></h3>
                        <p class="card-text"><?php echo get_field('snippet'); ?> </p>
                        <a href="<?php echo get_field("link"); ?>">lees meer ›</a>
                    </div>
                </div>
				<div class="w-100 d-sm-none my-3">
                    <!-- wrap every 1 on xs-->
                </div>
				<?php if ($loop % 2 == 0) {?>
				<?php }?>
                     <div class="w-100 d-none d-sm-block d-lg-none my-3">
                    <!-- wrap every 2 on sm-->
                </div>
                         <?php }
    } else {?>
                                <div> No content found </div>
                    <?php }?>
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

add_shortcode('info_boxes', __NAMESPACE__ . '\\create_info_boxes_shortcode');