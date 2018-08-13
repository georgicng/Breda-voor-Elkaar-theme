
@extends('layouts.app')

@section('content')
    @include('partials.page-header-image')
    
    <main class="cv">
        <div class="container">
            <div class="row">
                @include('partials.content-vacancy-title')
            </div>
            <div class="row">
                @include('partials.content-vacancy-socialbar')
            </div>
            <div class="row cv__content">
                <article class="col-lg-8 cv__profile">
                        {!! $vacancy['content'] !!}
                </article>
                <aside class="col-lg-4 cv__sidebar sidebar">
                        @include('partials.content-vacancy-extra')
                        @include('partials.content-contact-form')
                </aside>
            </div>
        </div>            
    </main>
@endsection