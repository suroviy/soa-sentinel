<?php
if ( !isset ( $show_actions ) ) {
	$show_actions = true;
};
?>
<div class="box-tools">
	@if ($creatable)
		<a class="btn btn-primary flat" href="{{ $createUrl }}">{!! soa_icon(config('admin.icons.create'))  !!} {{ trans('admin::lang.table.new-entry') }}</a>
	@endif

	@if ( $show_actions )
		@foreach ($actions as $action)
			{!! $action !!}
		@endforeach

		@foreach ($dropdowns as $label => $dropdown)
			<div class="btn-group">
				<button type="button" class="btn btn-default dropdown-toggle flat" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{ $label }} <span class="caret"></span>
				</button>
				<ul class="dropdown-menu pull-right">

					@foreach ($dropdown as $item)
						{!! $item !!}
					@endforeach

				</ul>
			</div>
		@endforeach
	@endif
</div>