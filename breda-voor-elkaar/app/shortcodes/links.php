<?php
namespace App;

use WP_Query;

// Create Shortcode links
// Use the shortcode: [links count="3"]
function create_links_shortcode($atts)
{
    // Attributes
    $atts = shortcode_atts(
        array(
            'count' => '9',
        ),
        $atts,
        'links'
    );
    // Attributes in var
    $count = is_numeric($atts['count']) ? $atts['count'] : '12';

    $args = array(
        'post_type' => array('link'),
        'posts_per_page' => $count,
    );

// The Query
    $query = new WP_Query($args);

    ob_start();

    ?>
       <section class="news-list">
        <div class="container">
            <h3 class="news-list__header">Of bent u op zoek na Copy</h3>
            <div class="row">
<?php // The Loop
    if ($query->have_posts()) {
        $loop = 1;
        $per_column = (int) $query->post_count / 3;
        while ($query->have_posts()) {
            $query->the_post();?>
            <?php if ($loop == 1) {?>
                    <div class="col-md-4 d-flex justify-content-center d-md-block">
                        <ul class="list-group list-group-flush news-list__item">
                <?php }?>
                        <li class="list-group-item">
                            <a href="<?php echo get_field("url") ?>" class="news-list__link"><?php the_title();?></a>
                        </li>
                <?php if ($loop == $per_column) {?>
                    </ul>
                </div>
                <div class="w-100 d-md-none my-3">
                    <!-- wrap every 1 on xs-->
                </div>
        <?php $loop = 0;
            }
            $loop++;
        }
    } else {?>

        <div> No posts found </div>
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

add_shortcode('links', __NAMESPACE__ . '\\create_links_shortcode');
