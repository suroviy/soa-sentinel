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
	<div>
		<select id="{{ $name }}" @if($multi) multiple @endif name="{{ $name }}@if($multi)[]@endif" class="form-control @if(!is_null($plugin)){{ $plugin }}@endif" @if(is_null($plugin) && $multi) size="2" @endif {!! ($nullable) ? 'data-nullable="true"' : '' !!}>
			@if ($nullable)
				<option value=""></option>
			@endif
			@foreach ($options as $optionValue => $optionLabel)
				<option value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
			@endforeach
		</select>
	</div>
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>