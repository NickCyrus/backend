<select name="@if (isset($nameField)){{$nameField}}@endif" id="@if (isset($nameField)){{$nameField}}@endif" class="form-control @if (isset($class)){{$class}}@endif" onchange="@if (isset($onchange)){{$onchange}}@endif" @if (isset($dataattr)){{$dataattr}}@endif @if (isset($required) && $required == true) required @endif   >
    @if (isset($items))
        @if (!isset($empresaSelect) || $empresaSelect==0 )<option selected value="">Seleccionar</option>@endif;
        @foreach ($items as $key => $item)

                @if(isset($value) && $value == $key)
                    <option selected value="{{$key}}">{{$item}}</option>
                @else
                    <option value="{{$key}}">{{$item}}</option>
                @endif
        @endforeach
    @endif
</select>
