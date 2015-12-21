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
		<div class="soa-iradio">
			@if( $attributes['skin'] != "line" )
				<label>
					<input class="soa-iradio" type="radio" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="" {!! ($value == null) ? 'checked' : '' !!}/>
					{{ trans('admin::lang.select.nothing') }}
				</label>
			@else 

				<input class="soa-iradio" type="radio" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="" {!! ($value == null) ? 'checked' : '' !!}/>
				<label>{{ trans('admin::lang.select.nothing') }}</label>
			@endif
		</div>
	@endif
	@foreach ($options as $optionValue => $optionLabel)
		<div class="soa-iradio">
			@if( $attributes['skin'] != "line" )
				<label>
					<input class="soa-iradio" type="radio" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'checked' : '' !!}/>
					{{ $optionLabel }}
				</label>
			@else
				<input class="soa-iradio" type="radio" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'checked' : '' !!}/>
				
				<label>{{ $optionLabel }}</label>
			@endif
		</div>
	@endforeach
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>