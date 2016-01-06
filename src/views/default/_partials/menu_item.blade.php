@if( Sentinel::hasAnyAccess($permission) )
<li class="{!! (count($items) > 0) ? 'treeview' : '' !!} @if($isActive) active @endif">
	<a href="{{ $url }}" class="@if($isActive) active @endif">
		<i class="fa fa-fw {{ $icon }}"></i> <span>{!! trans($label) !!}</span>
		@if (count($items) > 0)
			<i class="{!! soa_icon(config('admin.icons.menu_dropdown'), false)  !!} pull-right"></i>
		@endif
	</a>
	@if (count($items) > 0)
		<ul class="treeview-menu @if($isActive) collapse in @endif">
			@foreach ($items as $item)
				{!! $item !!}
			@endforeach
		</ul>
	@endif
</li>
@endif