<div class="box">
	<div class="box-header">
		@if ( ! empty($title) )
			<h3>{{ $title }}</h3>
		@endif
      	@include(AdminTemplate::view('_partials.displayactions'))
      <br>
    </div>

    <div class="box-body">

		<table class="table table-striped datatables" data-url="{{ $url }}" data-soa-excludesearch="{{ json_encode($excludeSearch) }}" data-order="{{ json_encode($order) }}" data-attributes="{{ json_encode($attributes, JSON_FORCE_OBJECT) }}" @if( count($exportButtons) > 0) data-soa-buttons="{{ json_encode($exportButtons) }}" @endif>
		<thead>
			<tr>
				@foreach ($columns as $column)
					{!! $column->header() !!}
				@endforeach
			</tr>
		</thead>
		<tfoot>
			<tr>
				@foreach ($columns as $index => $column)
					<?php
						$columnFilter = array_get($columnFilters, $index);
					?>
					<td data-index="{{ $index }}">{!! $columnFilter !!}</td>
				@endforeach
			</tr>
		</tfoot>
		<tbody>
		</tbody>
	</table>

	</div>
</div>