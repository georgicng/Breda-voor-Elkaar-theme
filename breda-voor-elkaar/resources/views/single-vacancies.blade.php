<?php //get_header(); ?>

<?php
// Query posts for a relationship value.
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
?>

<?php if ($organisations) {?>
    <ul>
    <?php
// We use the first organisation found, as this is the default way of handeling meta queries.
    $organisation = $organisations[0];
    $organisationmeta = get_user_meta($organisation->ID);
    ?>
        <div>
            <img style="max-width:100px;" src="<?php echo get_field('afbeelding', 'user_' . $organisation->ID); ?>">
            <a href="<?php echo get_author_posts_url($organisation->ID); ?>">
                <?php echo $organisationmeta['nickname'][0]; ?>
            </a>
        </div>
    </ul>
<?php }?>

<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?>
        <ul>
            <li>
                Titel: <?php the_title(); ?>
            </li>
            <li>
                Plaatsingsdatum: <?php echo date("d M Y", strtotime(get_the_date())); ?>
            </li>
            <li>
                Vacature Overzicht: <?php echo strip_tags(get_the_content()); ?>
            </li>
            <ul>
                <h4>Extra informatie</h4>
                <li>
                    Opleidingsniveau: <?php the_field('opleidingsniveau'); ?>
                </li>
                <li>
                    Ervaring: <?php the_field('ervaring'); ?>
                </li>
                <li>
                    Vergoeding: <?php the_field('vergoeding'); ?>
                </li>
            </ul>
        </ul>
        <?
    }
}
?>

<?php //get_footer(); ?>