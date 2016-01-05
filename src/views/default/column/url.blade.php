@if ( ! is_null($url))
	<a href="{{ $url }}"><i class="{!! soa_icon(config('admin.icons.goto_filter'), false) !!}" data-toggle="tooltip" title="{{ trans('admin::lang.table.filter-goto') }}"></i></a>
@endif