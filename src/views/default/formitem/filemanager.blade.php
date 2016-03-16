<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }}">
	<label for="{{ $name }}" @if($label_size) class="{{ $label_size }}" @endif >
		{{ $label }}
		@if($required_field)
			@include(AdminTemplate::view('formitem.required'))
    	@endif
    </label>
    @if($field_size)
    	<div class="{{ $field_size }}">
    @endif
		<div>
			<div class="thumbnail thumb-{{ $name }}">
				<img class="no-value {{ empty($value) ? '' : 'hidden' }}" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" width="200px" height="150px" />
				<img class="has-value {{ empty($value) ? 'hidden' : '' }}" src="{{ asset($value) }}" width="200px" height="150px" />
			</div>
		</div>
		<div>
			<div class="btn btn-primary popupBrowse flat" data-inputid="{{ $name }}">
				{!! soa_icon(config('admin.icons.file')) !!} {{ trans('admin::lang.image.browse') }}
			</div>
			<div class="btn btn-warning popupRemove flat" data-inputid="{{ $name }}">
				{!! soa_icon(config('admin.icons.file_remove')) !!} {{ trans('admin::lang.image.clear') }}
			</div>
		</div>
		<input name="{{ $name }}" id="{{ $name }}" type="hidden" value="{{ $value }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.help'))
			@include(AdminTemplate::view('formitem.errors'))
		</div>
	@if($field_size)
    	</div>
    @endif
</div>