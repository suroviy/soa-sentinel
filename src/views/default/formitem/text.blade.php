<div class="form-group {{ $errors->has($name) || $errors->has($lang . '_' . $name) ? 'has-error' : '' }}">
	<label for="@if($lang){{ $lang }}.@endif{{ $name }}" @if($label_size) class="{{ $label_size }}" @endif >
		{{ $label }}
		@if($required_field)
			@include(AdminTemplate::view('formitem.required'))
    	@endif
    </label>
    @if($field_size)
    	<div class="{{ $field_size }}">
    @endif
	<input class="form-control" @if($readonly) readonly @endif name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" type="text" id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $value }}">
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
 	@if($field_size)
    	</div>
    @endif
</div>
