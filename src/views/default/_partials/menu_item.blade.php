@if( Sentinel::hasAnyAccess($permission) )
<li {!! (count($items) > 0) ? 'class="treeview"' : '' !!}>
	<a href="{{ $url }}">
		{!! soa_icon($icon) !!}  <span>{!! trans($label) !!}</span>
		@if (count($items) > 0)
			<i class="{!! soa_icon(config('admin.icons.menu_dropdown'), false)  !!} pull-right"></i>
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