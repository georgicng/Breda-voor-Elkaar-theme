<section @php post_class() @endphp>
    <div class="post__body">
        <article>
            <h1 class="post__header">{{ $item['title'] }}</h1>
            <div class="post__content" >
                    {!! $item['content'] !!}
            </div>
        </article>
        
        @php comments_template('/partials/comments.blade.php') @endphp
    </div>
</section>

