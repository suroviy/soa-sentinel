{{ if($required) }}
<div class="required-field-block">
{{ endif }}

<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}">{{ $label }}</label>
	<input class="form-control" name="{{ $name }}" type="password" id="{{ $name }}" value="">
	@include(AdminTemplate::view('formitem.errors'))

	{{ if($required) }}
		@include(AdminTemplate::view('formitem.required'))
    {{ endif }}
</div>

{{ if($required) }}
</div>
{{ endif }}