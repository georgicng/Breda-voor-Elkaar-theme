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
                    
                    @foreach($vacancies as $vacancy)
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
@endsection
