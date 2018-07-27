<form role="search" method="get" id="search-form" action="@php echo esc_url( home_url( '/' ) ); @endphp" class="form-inline">
    <label class="sr-only" for="s">Search</label>
    <input name="s" placeholder="Zoek op trefwoord" class="hero__search" />
    <button type="submit" class="btn hero__btn">search</button>
</form>