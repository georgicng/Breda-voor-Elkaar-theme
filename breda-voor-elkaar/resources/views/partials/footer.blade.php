<footer class="footer">
  @include('partials.newsletter')
  <div class="footer_bottom">
    <div class="container">
        <div class="row footer-menu">
          <div class="col-md-3">
            @php dynamic_sidebar('sidebar-footer-column-1') @endphp
          </div>
          <div class="col-md-3">
            @php dynamic_sidebar('sidebar-footer-column-2') @endphp
          </div>
          <div class="col-md-3">
            @php dynamic_sidebar('sidebar-footer-column-3') @endphp
          </div>
          <div class="col-md-3">
            @php dynamic_sidebar('sidebar-footer-column-4') @endphp
          </div>
        </div>
    </div>
  </div>
  <div class="footer-menu__copyright ">© 2018 Mooi Werk - All rights reserved
  </div>
</footer>
