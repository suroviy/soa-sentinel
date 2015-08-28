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
	<div class="imageUpload" data-target="{{ route('admin.upload.image') }}" data-target-delete="{{ route('admin.upload.delete.image') }}" data-token="{{ csrf_token() }}" data-path="{{ $path }}">
		<div>
			<div class="thumbnail">
				<img class="no-value {{ empty($value) ? '' : 'hidden' }}" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" width="200px" height="150px" />
				<img class="has-value {{ empty($value) ? 'hidden' : '' }}" src="{{ asset($value) }}" width="200px" height="150px" />
			</div>
		</div>
		<div>
			<div class="btn btn-primary imageBrowse flat"><i class="fa fa-upload"></i> {{ trans('admin::lang.image.browse') }}</div>
			<div class="btn btn-danger imageRemove flat"><i class="fa fa-times"></i> {{ trans('admin::lang.image.remove') }}</div>
		</div>
		<input name="{{ $name }}" class="imageValue" type="hidden" value="{{ $value }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.errors'))
		</div>
	</div>
	@if($field_size)
    	</div>
    @endif
</div>