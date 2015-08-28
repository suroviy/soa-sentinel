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
	<div class="imageUpload" data-target="{{ route('admin.formitems.image.uploadFile') }}" data-token="{{ csrf_token() }}">
		<div>
			<div class="thumbnail">
				<div class="no-value {{ empty($value) ? '' : 'hidden' }}">
					<i class="fa fa-fw fa-file-o"></i> no file
				</div>
				<div class="has-value {{ empty($value) ? 'hidden' : '' }}">
					<a href="{{ asset($value) }}" data-toggle="tooltip" title="{{ trans('admin::lang.table.download') }}"><i class="fa fa-fw fa-file-o"></i> <span>{{ $value }}</span></a>
				</div>
			</div>
		</div>
		<div>
			<div class="btn btn-primary imageBrowse flat"><i class="fa fa-upload"></i> {{ trans('admin::lang.file.browse') }}</div>
			<div class="btn btn-danger imageRemove flat"><i class="fa fa-times"></i> {{ trans('admin::lang.file.remove') }}</div>
		</div>
		<input name="{{ $name }}" class="imageValue" type="hidden" value="{{ $value }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.help'))
			@include(AdminTemplate::view('formitem.errors')))
		</div>
	</div>
	@if($field_size)
    	</div>
    @endif
</div>