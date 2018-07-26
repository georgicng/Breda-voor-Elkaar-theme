<form method="get" class="layered__form">
    <section class="layered__group">
        @foreach($fields as $field)
            <section class="mb-4 layered__group filter" data-filter="{{$field['name']}}">
                <h2 class="layered__group-header">{{$field['label']}}</h2>
                @if($field['type']  == "checkbox")
                    @foreach($field['choices'] as $value => $label)
                        <div class="d-flex justify-content-between layered__field-wrap">
                            <div class="layered__field-checkbox-wrapper">
                                <input type="checkbox" name="{{$field['name']}}[]" value="{{$value}}" class="layered__field-checkbox" 
                                    @php echo in_array($value, $field['value'])? 'checked':'' @endphp>
                                <label>{{$label}}</label>
                            </div>
                            <span class="text-right layered__field-checkbox-value"></span>
                        </div>
                    @endforeach
                @endif
                @if($field['type']  == "radio")
                    @foreach($field['choices'] as $value => $label)
                            <div class="layered__field-radio-wrapper">
                                <input type="radio" name="{{$field['name']}}" value="{{$value}}" class="layered__field-radio" 
                                    @php echo in_array($value, $field['value'])? 'checked':'' @endphp>
                                <label>{{$label}}</label>
                            </div>
                    @endforeach
                @endif
            </section>
        @endforeach
    </section>
    <button type="submit" class="btn layered__btn">lees meer ></button>
</form>
