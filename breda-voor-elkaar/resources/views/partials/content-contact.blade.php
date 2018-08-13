<section @php post_class('contact') @endphp>
    <div class="page__body container">
        <h1 class="text-center page__header text-uppercase">{{get_the_title()}}</h1>
        <div class="text-center page__intro w-75 m-auto">{!! get_the_content() !!}</div>
        <div class="row page__content mt-5">
            <div class="col-md-6 contact__cards">
                <div class="col-sm-12 my-4">
                    <div class="card contatct__card border-0">
                    <div class="card-body text-center">
                        <i class="fa fa-phone fa-3x mb-3" aria-hidden="true"></i>
                        <h4 class="text-uppercase mb-4">call us</h4>
                        <p>{{get_field('phone')}}</p>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 my-4">
                    <div class="card  contatct__card border-0">
                    <div class="card-body text-center">
                        <i class="fa fa-map-marker fa-3x mb-3" aria-hidden="true"></i>
                        <h4 class="text-uppercase mb-4">office location</h4>
                        <address>{{get_field('address')}} </address>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 my-4">
                    <div class="card  contatct__card border-0">
                    <div class="card-body text-center">
                        <i class="fa fa-globe fa-3x mb-3" aria-hidden="true"></i>
                        <h4 class="text-uppercase mb-4">email</h4>
                        <p>{{get_field('email')}}</p>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6  contact__form">
                {!! do_shortcode(get_field('form', false, false)) !!}
            </div>
        </div>
    </div>
</section>