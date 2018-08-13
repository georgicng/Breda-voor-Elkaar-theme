@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    <section class="vacancy-list">
        <div class="container">
            <div class="row">
                <aside class="col-lg-4 vacancy-list__layered layered">
                    @include('partials.content-organisation-facets')
                </aside>

                <main class="col-lg-8 vacancy-list__items">
                    
                    @foreach($organisations as $organisation)
                        @include('partials.content-organisation')
                    @endforeach
                    
                    @empty($organisations)
                        <div class="alert">Geen vacatures gevonden die voldoen aan uw zoekopdracht</div>;
                    @endempty
                    
                    {!!  App\bootstrap_pagination()!!}
                </main>
            </div>
        </div>
    </section>
@endsection
