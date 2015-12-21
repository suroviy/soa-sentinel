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

	@foreach ($options as $optionValue => $optionLabel)
		<div class="radio bootstrap-switch-wrapper">
			<label class="bootstrap-switch-label">
				<input 
					class="bootstrap-switch-radio"
					type="radio" 
					name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" 
					value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'checked' : '' !!} 
					data-size="{{ $attributes['size'] }}" 
					data-animate="{{ $attributes['animate'] }}" 
					data-indeterminate="{{ $attributes['indeterminate'] }}" 
					data-inverse="{{ $attributes['inverse'] }}" 
					data-radio-all-off="{{ $attributes['radioAllOff'] }}" 
					data-on-color="{{ $attributes['onColor'] }}" 
					data-off-color="{{ $attributes['offColor'] }}" 
					data-on-text="{{ $attributes['onText'] }}" 
					data-off-text="{{ $attributes['offText'] }}" 
					data-label-text="{{ $attributes['labelText'] }}" 
					data-handle-width="{{ $attributes['handleWidth'] }}" 
					data-label-width="{{ $attributes['labelWidth'] }}" 
				/>
				<!-- {{ $optionLabel }} -->
			</label>
		</div>
	@endforeach

	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>