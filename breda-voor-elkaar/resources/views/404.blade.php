@extends('layouts.app')

@section('content')
  @include('partials.page-header')

    <section @php post_class() @endphp>
        <div class="404__body container">

            @if (!have_posts())
                <div class="alert alert-warning">
                {{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}
                </div>
                
                {!! get_search_form(false) !!}       
            @endif

        </div>
    </section>
@endsection
