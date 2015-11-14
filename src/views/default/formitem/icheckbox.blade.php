<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<div for="{{ $name }}" @if($label_size) class="{{ $label_size }}" @endif >
    </div>
    @if($field_size)
    	<div class="{{ $field_size }}">
    @endif
	<div class="soa-icheckbox">
		
		@if( $attributes['skin'] != "line" )
		
			<label>
				<input type="checkbox" class="soa-icheckbox" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="{{ $name }}" value="1" {!! $value ? 'checked="checked"' : '' !!} /> 
				{{ $label }}
				@if($required_field)
					@include(AdminTemplate::view('formitem.required'))
	    		@endif
			</label>
		
		@else 

			<input type="checkbox" class="soa-icheckbox" data-soa-icheck-skin="{{ $attributes['skin'] }}" data-soa-icheck-color="{{ $attributes['color'] }}" data-soa-icheck-increase="{{ $attributes['increase'] }}" name="{{ $name }}" value="1" {!! $value ? 'checked="checked"' : '' !!} /> 
		
			<label>
				{{ $label }}
			
				@if($required_field)
					@include(AdminTemplate::view('formitem.required'))
				@endif
			</label>
		
		@endif
	</div>
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>