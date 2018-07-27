@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    <section class="vacancy-list">
        <div class="container">
            <div class="row">

                <aside class="col-md-4 vacancy-list__layered layered">
                    @include('partials.content-vacancy-facets')
                </aside>

                <main class="col-md-8 vacancy-list__items">
                    
                    @foreach($vacancy as $vacancy)
                        @include('partials.content-vacancy')
                    @endforeach
                    
                    @empty($vacancies)
                        echo 'Geen vacatures gevonden die voldoen aan uw zoekopdracht.';
                    @endempty
                    
                    {!! get_the_posts_navigation() !!}
                </main>
            </div>
        </div>
    </section>
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
