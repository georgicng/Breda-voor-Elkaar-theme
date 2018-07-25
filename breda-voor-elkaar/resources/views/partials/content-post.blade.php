<div class="card related__item">
    <img class="card-img-top" src="{{ $item['image_link'] }}" alt="{{ $item['title'] }} thumbnail">
    <div class="card-body">
        <h5 class="card-title related__item-title">{{ $item['title'] }}</h5>
        <p class="card-text">{{ $item['excerpt'] }}</p>
        <a href="{{ $item['link'] }}" class="related__item-link">lees meer ›</a>
    </div>
</div>

