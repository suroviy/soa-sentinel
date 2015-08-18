{{ if($required) }}
<div class="required-field-block">
{{ endif }}

<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<textarea class="form-control" cols="50" rows="10" name="{{ $name }}">{!! $value !!}</textarea>
	@include(AdminTemplate::view('formitem.errors'))
	{{ if($required) }}
		@include(AdminTemplate::view('formitem.required'))
    {{ endif }}
</div>

{{ if($required) }}
</div>
{{ endif }}