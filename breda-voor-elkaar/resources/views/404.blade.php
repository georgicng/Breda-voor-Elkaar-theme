@extends('layouts.app')

@section('content')
  @include('partials.page-header')

    <section @php post_class() @endphp>
        <div class="404__body container">

            @if (!have_posts())
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1>
                                Oops!</h1>
                            <h2>
                                404 Not Found</h2>
                            <div class="error-details">
                                Sorry, an error has occured, Requested page not found!
                            </div>
                            <div class="error-actions">
                                <a href="{{site_url()}}" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
                                    Take Me Home </a><a href="mailto:{{get_option('admin_email')}}" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! get_search_form(false) !!}       
            @endif

        </div>
    </section>
@endsection
