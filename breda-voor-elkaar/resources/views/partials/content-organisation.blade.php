<div class="card shadow border-light vacancy-list__item  vacancy-card">
    <div class="row vacancy-card__header-wrapper">
        <div class="col-md-4 col-xs-12 vacancy-card__figure">
        <img src="{{ $organisation['image_link'] }}" class="vacancy-card__image">
        </div>
        <div class="col-md-8 col-xs-12 vacancy-card__header-group">
            <h2 class="card-title vacancy-card__header">{{ $organisation['name'] }}</h2>
            <h3 class="card-subtitle vacancy-card__subheader">No of Vacancies: {{ count($organisation['vacancies']) }}</h3>
        </div>
    </div>
    <div class="card-body vacancy-card__body">
        <div class="vacancy-card__text">{!! $organisation['bio'] !!}</div>
        <a href="{{ $organisation['link'] }}" class="card-link vacancy-card__link">lees meer ›</a>
    </div>
    <div class="card-footer vacancy-card__footer">{{ $organisation['categories'] }}</div>
</div>
