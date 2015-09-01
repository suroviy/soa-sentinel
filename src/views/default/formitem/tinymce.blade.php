<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
    <label for="{{ $name }}" @if($label_size) class="{{ $label_size }}" @endif >
        {{ $label }}
        @if($required_field)
            @include(AdminTemplate::view('formitem.required'))
        @endif
    </label>
    @if($field_size)
        <div class="{{ $field_size }}">
            @endif
            <textarea id="{{ $selector }}" name="{{ $name }}">{!! $value !!}</textarea>
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