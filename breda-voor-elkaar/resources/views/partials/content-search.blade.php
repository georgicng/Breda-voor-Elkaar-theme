<div class="d-flex flex-column flex-lg-row justify-content-lg-center align-items-lg-start blog-post__content my-4">
    <img src="{{ the_post_thumbnail_url('list-thumbnail') }}" alt="banner" class="blog-post__thumbnail">
    <div class="d-lg-flex flex-column justify-content-lg-center align-items-lg-start m-4">
        <h1 class="blog-post__header"><a href="{{ get_permalink() }}">{{ get_the_title() }}</a></h1>
        <div class="blog-post__excerpt">@php the_excerpt() @endphp</div>
        <a href="{{ get_permalink() }}" class="btn btn-danger blog-post__link">bekijk</a>
    </div>
</div>
        