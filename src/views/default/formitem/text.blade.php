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
	<input class="form-control" name="{{ $name }}" type="text" id="{{ $name }}" value="{{ $value }}">
	@include(AdminTemplate::view('formitem.errors'))
 	@if($field_size)
    	</div>
    @endif
</div>
