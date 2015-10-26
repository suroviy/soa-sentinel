@if( Sentinel::hasAnyAccess($permission) )
<li {!! (count($items) > 0) ? 'class="treeview"' : '' !!}>
	<a href="{{ $url }}">
		<i class="fa fa-fw {{ $icon }}"></i> <span>{!! trans($label) !!}</span>
		@if (count($items) > 0)
			<i class="fa fa-angle-left pull-right"></i>
		@endif
	</a>
	@if (count($items) > 0)
		<ul class="treeview-menu">
			@foreach ($items as $item)
				{!! $item !!}
			@endforeach
		</ul>
	@endif
</li>
@endif