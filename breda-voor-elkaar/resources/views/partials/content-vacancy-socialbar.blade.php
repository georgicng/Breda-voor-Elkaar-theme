<nav class="col d-flex flex-column flex-sm-row justify-content-between border-top cv__social-bar">
    <div class="cv__links d-flex">  
        @if($role[0] == 'volunteer')                  
            <form method="post">
                <input type="hidden" name="user_id" value="{{ $user->ID  }}">
                <input type="hidden" name="post_id" value="{{ $post->ID }}">
                <input type="submit" name="Reageer" value="Reageer nu ›" class="cv__link">
            </form>
            <form method="post">
                <input type="hidden" name="user_id" value="{{ $user->ID  }}">
                <input type="hidden" name="post_id" value="{{ $post->ID }}">
                <input type="submit" name="Favoriet" value="Favoriet ›" class="cv__link">
            </form>        
        @endif
    </div>     

    <div class="cv__social-icons">
        <span class="d-sm-none d-md-inline cv__social-text">Deel deze pagina</span>
        <a href="{{$share['facebook']}}" target="_blank">
            <img src="@asset('images/facebook.svg')" class="cv__social-link" alt="Facebook">
        </a>
        <a href="{{$share['twitter']}}" target="_blank">
            <img src="@asset('images/twitter.svg')" class="cv__social-link" alt="Twitter">
        </a>
        <a href="{{$share['linkedin']}}" target="_blank">
            <img src="@asset('images/linkedin.svg')" class="cv__social-link" alt="Linkedin">
        </a>
        <a href="{{$share['gplus']}}" target="_blank">
            <img src="@asset('images/google.svg')" class="cv__social-link cv__social-link_last" alt=Google + "">
        </a>
    </div>
</nav>