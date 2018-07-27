<div class="row company__vacancies">
<h2 class="company__vacancies-header">{{$vacancy-title}}</h2>
    @foreach($vacancies as $vacancy)
        @include('partials.content-vacancy')
    @endforeach
</div>
