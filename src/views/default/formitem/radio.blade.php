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
	@if ($nullable)
		<div class="radio">
			<label>
				<input type="radio" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="" {!! ($value == null) ? 'checked' : '' !!}/>
				{{ trans('admin::lang.select.nothing') }}
			</label>
		</div>
	@endif
	@foreach ($options as $optionValue => $optionLabel)
		<div class="radio">
			<label>
				<input type="radio" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'checked' : '' !!}/>
				{{ $optionLabel }}
			</label>
		</div>
	@endforeach
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>