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
			<div>
				<select id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" @if($multi) multiple @endif data-live-search="true" name="@if($lang){{ $lang }}{{'_'}}@endif{{ $name }}@if($multi)[]@endif" class="form-control @if(!is_null($plugin)){{ $plugin }}@endif" @if(is_null($plugin) && $multi) size="2" @endif {!! ($nullable) ? 'data-nullable="true"' : '' !!}>
					@if ($nullable)
						<option value=""></option>
					@endif

					@foreach ($options as $optionValue => $optionLabel)

						

						@if ( is_array($value ))
							<option value="{{ $optionValue }}" {!! (in_array($optionValue, $value)) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
						@else
							<option value="{{ $optionValue }}" {!! ($value == $optionValue) ? 'selected="selected"' : '' !!}>{{ $optionLabel }}</option>
						@endif
					@endforeach
				</select>
			</div>
			@include(AdminTemplate::view('formitem.help'))
			@include(AdminTemplate::view('formitem.errors'))
			@if($field_size)
		</div>
	@endif
</div>