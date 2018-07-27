@php
if (post_password_required()) {
  return;
}
@endphp

<section id="comments" class="comments">
  @if (have_comments())
    <h2>
      {!! sprintf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>') !!}
    </h2>

    <ol class="medias py-md-5 my-md-5 px-sm-0 mx-sm-0">
      {!! wp_list_comments([
        'style'         => 'ol',
        'max_depth'     => 4,
        'short_ping'    => true,
        'avatar_size'   => '50',
        'walker'        => new Bootstrap_Comment_Walker()
      ]) !!}
    </ol>

    @if (get_comment_pages_count() > 1 && get_option('page_comments'))
      <nav>
        <ul class="pager">
          @if (get_previous_comments_link())
            <li class="previous">@php previous_comments_link(__('&larr; Older comments', 'sage')) @endphp</li>
          @endif
          @if (get_next_comments_link())
            <li class="next">@php next_comments_link(__('Newer comments &rarr;', 'sage')) @endphp</li>
          @endif
        </ul>
      </nav>
    @endif
  @endif

  @if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments'))
    <div class="alert alert-warning">
      {{ __('Comments are closed.', 'sage') }}
    </div>
  @endif

  @php comment_form() @endphp
</section>
