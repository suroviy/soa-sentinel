<td>
	<div class="text-right pull-right" style="width: 90px;">
		@if ($editable)
			<a href="{{ $editUrl }}" class="btn btn-default btn-sm flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.edit') }}"><i class="{!! soa_icon(config('admin.icons.edit')) !!}"></i></a>
		@endif
		@if ($deletable)
			<form action="{{ $deleteUrl }}" method="POST" style="display:inline-block;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<input type="hidden" name="_method" value="DELETE" />
				<button class="btn btn-danger btn-sm btn-delete flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.delete') }}">
					{!! soa_icon(config('admin.icons.delete')) !!}
				</button>
			</form>
		@endif
		@if ($restorable)
			<form action="{{ $restoreUrl }}" method="POST" style="display:inline-block;">
				<input type="hidden" name="_token" value="{{ csrf_token() }}" />
				<button class="btn btn-primary btn-sm flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.restore') }}">
					{!! soa_icon(config('admin.icons.restore')) !!}
				</button>
			</form>
		@endif
	</div>
</td>