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
	<div class="imageUploadMultiple" data-target="{{ route('admin.upload.image') }}" data-target-delete="{{ route('admin.upload.delete.image') }}" data-token="{{ csrf_token() }}" data-path="{{ $path }}">
		<div class="row form-group images-group">
			@foreach ($value as $image)
				<div class="col-xs-6 col-md-3 imageThumbnail">
					<div class="thumbnail">
						<img data-value="{{ $image }}" src="{{ asset($image) }}" />
						<a href="#" class="imageRemove">Remove</a>
					</div>
				</div>
			@endforeach
		</div>
		<div>
			<div class="btn btn-primary imageBrowse flat"><i class="fa fa-upload"></i> {{ trans('admin::lang.image.browseMultiple') }}</div>
		</div>
		<input name="{{ $name }}" class="imageValue" type="hidden" value="{{ implode(',', $value) }}">
		<div class="errors">
			@include(AdminTemplate::view('formitem.errors'))
		</div>
	</div>
	@if($field_size)
    	</div>
    @endif
</div>