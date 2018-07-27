@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    <section class="vacancy-list">
        <div class="container">
            <div class="row">
                <main class="col-lg-8 vacancy-list__items">
                   
                    @foreach($volunteers as $volunteer)                        
                        <div class="media">
                            <img class="mr-3" src="{{$volunteer['image-link']}}" alt="User icon">
                            <div class="media-body">
                                <h5 class="mt-0">{{$volunteer['name']}}</h5>
                                {{$volunteer['bio']}}
                            </div>
                        </div>
                    @endforeach
                    @empty($volunteers)
                        echo 'Geen vacatures gevonden die voldoen aan uw zoekopdracht.';
                    @endempty
                    {!!  App\bootstrap_pagination()!!}
                </main>

                <aside class="col-lg-4 vacancy-list__layered layered">
                    @include('partials.sidebar')
                </aside>
            </div>
        </div>
    </section>
@endsection