@extends('layouts.app')

@section('content')
    @include('partials.page-header-image')
    
    <section class="company">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="company__name">{{$name}}</h1>
                    <div class="d-flex company__profile">
                        <div class="company__logo-wrapper">
                            <img src="{{$image}}" class="w-100 img-fluid company__logo">
                        </div>
                        <div class="company__contact">
                            @include('partials.content-organisation-meta')
                            @include('partials.content-organisation-social-link')
                        </div>
                    </div>
                    <div class="row company__bio">
                        {{ $meta->description }}
                    </div>
                    <div class="d-flex flex-wrap text-dark company__categories">
                            @include('partials.content-organisation-categories')
                    </div>
                    @include('partials.content-organisation-vacancies')
                </div>
                <aside class="col-sm-4 company__sidebar blog__sidebar sidebar">
                    @include('partials.content-contact-form')
                </aside>
            </div>
        </div>
    </section>
@endsection