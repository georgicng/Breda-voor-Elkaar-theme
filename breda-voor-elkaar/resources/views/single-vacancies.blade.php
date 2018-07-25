
@extends('layouts.app')

@section('content')
    @include('partials.page-header-image')
    
    <main class="cv">
        <div class="container">
            <div class="row">
                @include('partials.content-vacancy-title')
                @include('partials.content-vacancy-socialbar')
            </div>
            <div class="row cv__content">
                <article class="col-sm-8 cv__profile">
                        {!! $vacancy['content'] !!}
                </article>
                <aside class="col-sm-4 cv__sidebar sidebar">
                        @include('partials.content-vacancy-extra')
                        @include('partials.content-contact-form')
                </aside>
            </div>
        </div>            
    </main>
@endsection