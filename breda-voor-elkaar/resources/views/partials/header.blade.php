<header class="header bg-primary">
  <div class="container d-none d-md-flex justify-content-md-end header__content">
    <div class="header__search">
      <input type="text" placeholder="Zoeken" class="header__input" name="s" id="search_input" onkeypress="search" />
    </div>
    @if(is_user_logged_in())
        <a href="{{admin_url( 'profile.php' )}}" class="header__profile">Profile</a>
        <a href="{{wp_logout_url()}}" class="header__logout">Logout</a>
    @else
        <a href="{{wp_login_url()}}" class="header__login">Inloggen</a>
    @endif
  </div>
</header>
