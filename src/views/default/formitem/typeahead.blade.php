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
	<input 
		class="form-control typeahead" 
		@if($readonly) readonly @endif 
		name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" 
		type="text" 
		id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" 
		value="{{ $value }}" 
		autocomplete="off" 
		data-soa-displaytext="{{ $displayText }}" 
		data-soa-afterselect="{{ json_encode($fillAfter, JSON_FORCE_OBJECT) }}"
		data-soa-source="{{ json_encode($options, TRUE) }}"
		data-soa-autoSelect="{{ $autoSelect }}"
		data-soa-minLength="{{ $minLength }}" 
		data-soa-showHintOnFocus="{{ $showHint }}"
		data-soa-items="{{ $items }}"
	>
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
 	@if($field_size)
    	</div>
    @endif
</div>
