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

    @if( !is_null($placement) )

	    <div class="input-group soa-colorpicker">
			@if ($placement == 'before')
				<span class="input-group-addon"><i></i></span>
			@endif
			<input class="form-control" @if($readonly) readonly disabled @endif name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" type="text" id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $value }}" data-soa-colorpicker="{{ json_encode($attributes, JSON_FORCE_OBJECT) }}">
			@if ($placement == 'after')
				<span class="input-group-addon"><i></i></span>
			@endif
		</div>

	@else
		<input class="form-control soa-colorpicker" @if($readonly) readonly disabled @endif name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" type="text" id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $value }}" data-soa-colorpicker="{{ json_encode($attributes, JSON_FORCE_OBJECT) }}">
	@endif

	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
 	
 	@if($field_size)
    	</div>
    @endif
</div>
