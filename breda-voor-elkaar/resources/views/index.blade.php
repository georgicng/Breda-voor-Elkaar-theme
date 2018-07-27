@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    <section class="related">
        <div class="container">
            <h1 class="related__header">{!! App::title() !!}</h1>
            
            @empty($items)
                <div class="alert alert-warning">
                <div>Hello, Nothing to display</div>
                </div>
            @endempty
            <div class="card-columns">
                @foreach($items as $item)
                    @include('partials.content-'.get_post_type())
            
                @endforeach
            </div>
        </div>
    </section>
    
    {!!  App\bootstrap_pagination() !!}
@endsection
