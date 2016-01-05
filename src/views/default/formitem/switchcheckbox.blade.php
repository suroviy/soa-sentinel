<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" @if($label_size) class="{{ $label_size }}" @endif >
		{{ $label }}
		@if($required_field)
			@include(AdminTemplate::view('formitem.required'))
    	@endif
    </label>
    @if($field_size)
    	<div class="{{ $field_size }}">
    @endif
	<div class="checkbox">
		<label class="bootstrap-switch-label">
			<input 
				type="checkbox" 
				value="1" {!! $value ? 'checked="checked"' : '' !!} 
				class="bootstrap-switch-checkbox"
				name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" 
				data-size="{{ $attributes['size'] }}" 
				data-animate="{{ $attributes['animate'] }}" 
				data-indeterminate="{{ $attributes['indeterminate'] }}" 
				data-inverse="{{ $attributes['inverse'] }}" 
				data-on-color="{{ $attributes['onColor'] }}" 
				data-off-color="{{ $attributes['offColor'] }}" 
				data-on-text="{!! str_replace("\"", "'", $attributes['onText'])  !!}"
				data-off-text="{!! str_replace("\"", "'", $attributes['offText']) !!}"
				data-label-text="{{ $attributes['labelText'] }}" 
				data-handle-width="{{ $attributes['handleWidth'] }}" 
				data-label-width="{{ $attributes['labelWidth'] }}" 
			/>
		</label>
	</div>
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>