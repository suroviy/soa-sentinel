<div class="form-group {{ $errors->has($name) || $errors->has($lang . '_' . $name) ? 'has-error' : '' }}">
    <label for="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" @if($label_size) class="{{ $label_size }}" @endif >
        {{ $label }}
        @if($required_field)
            @include(AdminTemplate::view('formitem.required'))
        @endif
    </label>
    @if($field_size)
        <div class="{{ $field_size }}">
            @endif
            <textarea id="@if($lang){{ $lang }}{{ '_' }}@endif{{ 'tinymce' }}" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}">{!! $value !!}</textarea>
            @include(AdminTemplate::view('formitem.errors'))
            @if($field_size)
        </div>
    @endif

    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({!! $config  !!});
        });
    </script>

</div>