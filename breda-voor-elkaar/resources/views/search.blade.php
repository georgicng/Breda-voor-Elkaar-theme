@extends('layouts.app')

@section('content')
  @include('partials.page-header')
    <section @php post_class() @endphp>
        <div class="search__body container">

            @if (!have_posts())
                <div class="alert alert-warning">
                    {{ __('Sorry, no results were found.', 'sage') }}
                </div>
                {!! get_search_form(false) !!}
            @endif

            <h1 class="my-4">Search Results: {!! App::title() !!}</h1> 

            @while(have_posts()) @php the_post() @endphp
                @include('partials.content-search')
            @endwhile
    
            {!! App\bootstrap_pagination() !!}
        </div>
    </section>
@endsection
