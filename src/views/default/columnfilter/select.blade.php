<select class="form-control column-filter  form-filter input-sm" data-type="select">
	<option value="">- {{ $placeholder }} -</option>
	@foreach ($options as $key => $option)
		<option value="{{ $option }}">{{ $option }}</option>
	@endforeach
</select>
