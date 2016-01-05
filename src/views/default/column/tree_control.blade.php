@if ($editable)
	<a href="{{ $editUrl }}" class="btn btn-default btn-xs flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.edit') }}">{!! soa_icon(config('admin.icons.edit')) !!}</a>
@endif
@if ($deletable)
	<form action="{{ $deleteUrl }}" method="POST" style="display:inline-block;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<input type="hidden" name="_method" value="DELETE" />
		<button class="btn btn-danger btn-xs btn-delete flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.delete') }}">
			{!! soa_icon(config('admin.icons.delete')) !!}
		</button>
	</form>
@endif
@if ($restorable)
	<form action="{{ $restoreUrl }}" method="POST" style="display:inline-block;">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" />
		<button class="btn btn-primary btn-xs flat" data-toggle="tooltip" title="{{ trans('admin::lang.table.restore') }}">
			{!! soa_icon(config('admin.icons.restore')) !!}
		</button>
	</form>
@endif
