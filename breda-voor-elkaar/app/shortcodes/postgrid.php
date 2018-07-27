<?php
namespace App;

use WP_Query;

// Create Shortcode courses
// Use the shortcode: [postgrid title="Nieuws" category="news"]
function create_postgrid_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'category' => 'news',
            'title' => 'Nieuws',
        ),
        $atts,
        'postgrid'
    );

    $category = $atts['category'];
    $title = $atts['title'];

    // WP_Query arguments
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => 6,
        'category_name' => $category,
    );

    // The Query
    $query = new WP_Query($args);

    ob_start();

    ?>
   <section class="newsdeck">
        <div class="container">
            <h1 class="newsdeck__title"><?php $title;?></h1>
            <div class="row">
                <?php // The Loop
    if ($query->have_posts() && $query->post_count == 6) {
        $loop = 1;
        while ($query->have_posts()) {
            $query->the_post();?>
			<?php if ($loop == 1) {?>
 <div class="col-lg-6">
                    <div class="card-deck newsdeck__item_margin-bottom">
                        <div class="card newsdeck__item newsdeck__item_small">
                            <div class="card-block">
                                <h3 class="card-title"><?php the_title();?></h3>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>">lees meer ›</a>
                            </div>
                        </div>
                        <div class="w-100 d-sm-none my-3">
                            <!-- wrap every 1 on xs-->
                        </div>
				<?php }?>
				<?php if ($loop == 2) {?>
				 <div class="card border-top newsdeck__item newsdeck__item_small">
                            <div class="card-block newsdeck__item_align">
                                <h3 class="card-title"><?php the_title();?></h3>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>">lees meer ›</a>
                            </div>
                        </div>
                    </div>
				<?php }?>
				<?php if ($loop == 3) {?>
				<div class="card newsdeck__item newsdeck__item_big">
                        <div class="card-block newsdeck__item_align">
                            <img class="card-img w-100" src="<?php the_post_thumbnail_url([500, 500]);?>" alt="?php the_title();?> thumbnail" />
                            <div class="card-img-overlay newsdeck__caption d-flex flex-column justify-content-end text-white">
                                <h2 class="card-title"><?php the_title();?></h2>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>" class="text-white">lees meer ›</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 d-lg-none my-3">
                    <!-- wrap every 1 on xs-->
                </div>
				<?php }?>
				<?php if ($loop == 4) {?>
				 <div class="col-lg-6">
                    <div class="card newsdeck__item newsdeck__item_big">
                        <div class="card-block">
                        <img class="card-img w-100" src="<?php the_post_thumbnail_url([500, 500]);?>" alt="?php the_title();?> thumbnail" />
                            <div class="card-img-overlay newsdeck__caption d-flex flex-column justify-content-end text-white">
                                 <h2 class="card-title"><?php the_title();?></h2>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>" class="text-white">lees meer ›</a>
                            </div>
                        </div>
                    </div>
				<?php }?>
				<?php if ($loop == 5) {?>
				<div class="card-deck newsdeck__item_margin-top">
                        <div class="card newsdeck__item newsdeck__item_small">
                            <div class="card-block newsdeck__item_align">
                                <h3 class="card-title"><?php the_title();?></h3>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>">lees meer ›</a>
                            </div>
                        </div>
                        <div class="w-100 d-sm-none my-3">
                            <!-- wrap every 1 on xs-->
                        </div>
				<?php }?>
				<?php if ($loop == 6) {?>
				<div class="card newsdeck__item newsdeck__item_small">
                            <div class="card-block newsdeck__item_align">
                                <h3 class="card-title"><?php the_title();?></h3>
                                <p class="card-text"><?php the_excerpt();?></p>
                                <a href="<?php the_permalink();?>">lees meer ›</a>
                            </div>
                        </div>
                        </div>
				<?php }?>

                         <?php $loop++;
        }
    } else {?>
                                <div> Not enough content to create grid</div>
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

add_shortcode('postgrid', __NAMESPACE__ . '\\create_postgrid_shortcode');