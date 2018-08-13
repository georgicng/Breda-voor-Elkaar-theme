@extends('layouts.app')

@section('content')
  @include('partials.page-header')

    <section @php post_class('error') @endphp>
        <div class="error__body container">
            @if (!have_posts())
                <div class="row">
                    <div class="col-lg-6 offset-lg-3">
                        <div class="error__content">
                            <h1 class="error__header">Oops!</h1>
                            <h2 class="error__code mb-4">You've got a 404</h2>
                            <div class="error__details mb-4">
                                Sorry, but the requested resource is not found!
                            </div>
                            <div class="error__actions">
                                <a href="{{site_url()}}" class="btn btn-primary btn-lg error__link"><span class="fa fa-home"></span>
                                    Take Me Home </a><a href="mailto:{{get_option('admin_email')}}" class="btn btn-secondary btn-lg error__link"><span class="fa fa-envelope"></span> Contact Support </a>
                            </div>
                        </div>
                    </div>
                </div>      
            @endif

        </div>
    </section>
@endsection
