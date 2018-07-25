<section @php post_class() @endphp>
    <div class="post__body">
        <h1 class="post__header">{{ get_the_title() }}</h1>
        <div class="post__content" >
            @php the_content() @endphp
        </div>
        @php comments_template('/partials/comments.blade.php') @endphp
    </div>
</section>

