<section class="blog-post">
        <div class="container">
            <div class="d-flex justify-content-around blog-post__wrapper">
                <img src="{{ the_post_thumbnail_url('list-thumbnail') }}" alt="banner" class="blog-post__thumbnail">
                <div class="d-flex flex-column justify-content-center align-items-start blog-post__content">
                    <h1 class="blog-post__header"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h1>
                    <div class="blog-post__excerpt">@php the_excerpt() @endphp</div>
                    <a href="{{ get_permalink() }}" class="btn btn-danger blog-post__link">bekijk</a>
                </div>
            </div>
        </div>
    </section>