<div class="row">
    <div class="col-md-9 col-lg-12 sidebar__item cv__extra">
        <h5 class="sidebar__title">Extra informatie</h5>
        <ul class="cv__extra-list">
            <li class="cv__extra-list-item">
                <img src="@asset('images/academy.svg')" alt="Academic Icon" class="cv__extra-icon">{{$acf['opleidingsniveau']}}
            </li>
            <li class="cv__extra-list-item">
                <img src="@asset('images/work.svg')" alt="Work Icon" class="cv__extra-icon">{{$acf['ervaring']}}
            </li>
            <li class="cv__extra-list-item">
                <img src="@asset('images/cash.svg')" alt="Cash Icon" class="cv__extra-icon">{{$acf['vergoeding']}}
            </li>
        </ul>
    </div>
</div>
