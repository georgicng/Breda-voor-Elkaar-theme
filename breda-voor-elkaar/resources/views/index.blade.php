@extends('layouts.app')

@section('content')
    @include('partials.page-header')

    <section class="related">
        <div class="container">
            <h1 class="related__header">{{ $title }}</h1>
            
            @empty($items)
                <div class="alert alert-warning">
                <div>Hello, Nothing to display</div>
                </div>
            @endempty
            
            @foreach($items as $item)
                @if ($loop->first || $loop->iteration % 3 == 1)
                    <div cass="row">                        
                @endif
                <div class="col-sm-4">
                        @include('partials.content-'.get_post_type())
                </div>
                @if($loop->last || $loop->iteration % 3 == 0)                        
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    
    {!! get_the_posts_navigation() !!}
@endsection
