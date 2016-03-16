<div class="datepicker form-group input-group margin-bottom-5" style="width:{{ $width }}px">
	<input data-date-format="{{ $pickerFormat }}" data-date-useseconds="{{ $seconds ? 'true' : 'false' }}" class="form-control column-filter form-filter input-sm" type="text" placeholder="{{ $placeholder }}" data-type="text">
	<span class="input-group-addon"><span class="{!! soa_icon(config('admin.icons.datepicker'), false) !!}"></span></span>
</div>