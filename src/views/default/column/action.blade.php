<td>
	<div class="text-right">
		<a class="btn btn-{{ $color }} btn-sm btnAction flat" href="{{ $url }}" data-href="{{ $url }}" @if ($style == 'short') data-toggle="tooltip" title="{{ $value }}" @endif target="{{ $target }}">
			@if ($icon)
				<i class="fa {{ $icon }}"></i>
			@endif
			@if ($style == 'long')
				{{ $value }}
			@endif
		</a>
	</div>
</td>