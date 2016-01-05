@if ( ! is_null($value))
	<a href="{{ $url }}">
		@if($isSelf)
			<i class="{!! soa_icon(config('admin.icons.filter'), false) !!}" data-toggle="tooltip" title="{{ $isSelf ? trans('admin::lang.table.filter') : trans('admin::lang.table.filter-goto') }}"></i>
		@else
			<i class="{!! soa_icon(config('admin.icons.goto_filter'), false) !!}" data-toggle="tooltip" title="{{ $isSelf ? trans('admin::lang.table.filter') : trans('admin::lang.table.filter-goto') }}"></i>
		@endif
	</a>
@endif