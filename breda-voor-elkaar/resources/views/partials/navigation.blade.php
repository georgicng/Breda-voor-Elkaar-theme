<nav class="navbar navbar-expand-md navbar-light text-dark bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ home_url('/') }}"><img src="@asset('images/logo.svg')" alt="{{ get_bloginfo('name', 'display') }}"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="main-nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="main-nav" class="collapse navbar-collapse">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu($primarymenu) !!}
      @endif
      </div>
  </div>
</nav>
