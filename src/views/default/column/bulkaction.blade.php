
<a class="btn btn-{{ $color }} btnBulkAction flat" href="{{ $url }}" data-href="{{ $url }}" @if ($style == 'short') data-toggle="tooltip" title="{{ $value }}" @endif target="{{ $target }}">
	@if ($icon)
		{!! soa_icon($icon) !!}
	@endif
	@if ($style == 'long')
		{{ $value }}
	@endif
</a>
