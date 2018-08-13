
    <div class="sidebar__item">
        <h5 class="sidebar__title">Contact</h5>
        <form action="https://formspree.io/{{get_option('admin_email')}}" class="sidebar__form contact-form">
            <div class="form-group">
                <input type="text" name="name" placeholder="Voer je naam in *" class="form-control contact-form__input">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mailadres *" class="form-control contact-form__input">
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Telefoonnummer *" class="form-control contact-form__input">
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Je bericht" class="form-control contact-form__input" id="" cols="30" rows="4"></textarea>
            </div>
            <div class="contact-form__text">Je gaat akkoord met onze
                <span class="contact-form__text_hightlight">Algemene voorwaarden</span>
            </div>
            <button type="submit" class="btn btn-block contact-form__btn">Submit</button>
        </form>
    </div>