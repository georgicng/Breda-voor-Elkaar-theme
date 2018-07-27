<div class="footer_top">
    <div class="newsletter">
        <div class="newsletter__wrapper d-lg-flex flex-lg-column justify-content-lg-center align-items-lg-start">
            <h3 class="newsletter__header">Wil je op de hoogte blijven? </h3>
            <p class="newsletter__text">Laat dan je e-mailadres achter om de meest recente vacatures, kandidaten en ander nieuws te ontvangen.</p>
            <form action="{{get_option('mc_subscriptionlist')}}" method="post" class="d-lg-flex">                
                <input name="EMAIL" class="form-control newsletter__input" placeholder="ZJe e-mail adres" />
                <button id="subscribe" class="btn btn-danger newsletter__button">Aanmelden</button>
            </form>
        </div>
    </div>  
    <div class="banner">
        <img src="@asset('images/side.png')" class="img-fluid banner__image" alt="fotter pattern">
    </div>
</div>
