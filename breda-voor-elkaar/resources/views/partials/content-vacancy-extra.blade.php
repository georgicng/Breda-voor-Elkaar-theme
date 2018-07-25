<div class="col-sm sidebar__item cv__extra">
    <h5 class="sidebar__title">Extra informatie</h5>
    <ul class="cv__extra-list">
        <li class="cv__extra-list-item">
            <img src="assets/img/academy.svg" alt="Academic Icon" class="cv__extra-icon">@php the_field('opleidingsniveau'); @endphp
        </li>
        <li class="cv__extra-list-item">
            <img src="assets/img/work.svg" alt="Work Icon" class="cv__extra-icon">@php the_field('ervaring'); @endphp
        </li>
        <li class="cv__extra-list-item">
            <img src="assets/img/cash.svg" alt="Cash Icon" class="cv__extra-icon">@php the_field('vergoeding'); @endphp
        </li>
    </ul>
</div>
