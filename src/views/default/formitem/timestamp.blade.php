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
	<div class="datepicker input-group">
		<input data-date-format="{{ $pickerFormat }}" data-date-useseconds="{{ $seconds ? 'true' : 'false' }}" class="form-control" name="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" type="text" id="@if($lang){{ $lang }}{{'_'}}@endif{{$name}}" value="{{ $value }}">
		<div class="input-group-addon"><span class="{!! soa_icon(config('admin.icons.timepicker'), false) !!}"></span></div>
	</div>
	@include(AdminTemplate::view('formitem.help'))
	@include(AdminTemplate::view('formitem.errors'))
	@if($field_size)
    	</div>
    @endif
</div>