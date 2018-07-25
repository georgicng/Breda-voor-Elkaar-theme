@php 
foreach ($GLOBALS['my_query_filters'] as $key => $name) {
    // get the field's settings without attempting to load a value
    $field = get_field_object($key, false, false);

    // set value if available
    if (isset($_GET[$name])) {
        $field['value'] = explode(',', $_GET[$name]);
    }

    // create filter
 @endphp
    <div class="filter" data-filter="@php echo $name; @endphp">
        @php render_field($field); @endphp
    </div>
@php } @endphp

<form class="layered__form">
        <section class="layered__group">
            <h2 class="layered__group-header">Datum gepost</h2>
            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum-gepost" value="Laatste uur" class="layered__field-radio">
                <label>Laatste uur</label>
            </div>

            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum" value="Laatste 24 uur" class="layered__field-radio">
                <label>Laatste 24 uur</label>
            </div>

            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum" value="Laatste 7 dagen" class="layered__field-radio">
                <label>Laatste 7 dagen</label>
            </div>

            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum" value="Laatste 14 dagen" class="layered__field-radio">
                <label>Laatste 14 dagen</label>
            </div>

            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum" value="Laatste 30 dagen" class="layered__field-radio">
                <label>Laatste 30 dagen</label>
            </div>

            <div class="layered__field-radio-wrapper">
                <input type="radio" name="datum" value="Allemaal" class="layered__field-radio" checked>
                <label>Allemaal</label>
            </div>

        </section>
        <section class="mb-4 layered__group">
            <h2 class="layered__group-header">Hoe vaak</h2>
            <div class="d-flex justify-content-between layered__field-wrap">
                <label class="layered__field-select">
                    Eenmalig</label>
                <span class="layered__field-select-value">5</span>

            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <label class="layered__field-select">
                    Regelmatig</label>
                <span class="alayered__field-select-value">5</span>
                </label>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <label class="layered__field-select">
                    Soms</label>
                <span class="layered__field-select-value">2</span>

            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <label class="layered__field-select">Structureel</label>
                <span class="layered__field-select-value">5</span>
            </div>
        </section>
        <section class="mb-4 layered__group">
            <h2 class="layered__group-header">Soort vrijwilligers</h2>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="(huis)dieren" class="layered__field-checkbox" checked>
                    <label> (huis)dieren</label>
                </div>
                <span class="text-right layered__field-checkbox-value">5</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Activiteitenbegeleiding" class="layered__field-checkbox">
                    <label> Activiteitenbegeleiding</label>
                </div>
                <span class="text-right layered__field-checkbox-value">5</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Administratie" class="layered__field-checkbox">
                    <label>Administratie</label>
                </div>
                <span class="text-right layered__field-checkbox-value">2</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Bar & kantine" class="layered__field-checkbox">
                    <label>Bar & kantinespan</label>
                </div>
                <span class="text-right layered__field-checkbox-value">5</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Bestuur & strategie" class="layered__field-checkbox">
                    <label>Bestuur & strategie</label>
                </div>
                <span class="text-right layered__field-checkbox-value">5</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Boodschappen" class="layered__field-checkbox">
                    <label>Boodschappen</label>
                </div>
                <span cclass="text-right layered__field-checkbox-value">5</span>
            </div>
            <div class="d-flex justify-content-between layered__field-wrap">
                <div class="layered__field-checkbox-wrapper">
                    <input type="checkbox" name="soort-vrijwilligers" value="Collecte & fondsenwerving" class="layered__field-checkbox">
                    <label>Collecte & fondsenwerving</label>
                </div>
                <span class="text-right layered__field-checkbox-value">2</span>
            </div>
        </section>

        <a href="#" class="btn layered__btn">lees meer ></a>
    </form>
