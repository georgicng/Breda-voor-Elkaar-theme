@extends('layouts.app')

@section('content')
  @include('partials.page-header')

<div id="archive-filters">
<?php foreach ($GLOBALS['my_query_filters'] as $key => $name) {
    // get the field's settings without attempting to load a value
    $field = get_field_object($key, false, false);

    // set value if available
    if (isset($_GET[$name])) {
        $field['value'] = explode(',', $_GET[$name]);
    }

    // create filter
    ?>
    <div class="filter" data-filter="<?php echo $name; ?>">
    <?php render_field($field); ?>
    </div>

<?php }?>
</div>

<?php // Posts
if (have_posts()) {
    while (have_posts()) {
        the_post();
        ?> <a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a> <?php
    }
} else {
    echo 'Geen vacatures gevonden die voldoen aan uw zoekopdracht.';
}
?>

<!-- Add ACF filter values to query and refresh -->
<script type="text/javascript">
(function($) {
    // change
    $('#archive-filters').on('change', 'input[type="checkbox"]', function(){

        // vars
        var url = '<?php echo home_url('vacancies'); ?>';
            args = {};

        // loop over filters
        $('#archive-filters .filter').each(function(){

            // vars
            var filter = $(this).data('filter'),
                vals = [];

            // find checked inputs
            $(this).find('input:checked').each(function(){
                vals.push( $(this).val() );
            });

            // append to args
            args[ filter ] = vals.join(',');
        });

        // update url
        url += '?';

        // loop over args
        $.each(args, function( name, value ){
            url += name + '=' + value + '&';
        });

        // remove last &
        url = url.slice(0, -1);

        // reload page
        window.location.replace( url );
    });
})(jQuery);
</script>

@endsection
