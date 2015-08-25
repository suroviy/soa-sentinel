<div class="box">
	<div class="box-header">
		@if ( ! empty($title) )
			<h3>{{ $title }}</h3>
		@endif
      	<div class="box-tools">
        	@if ($creatable)
				<a class="btn btn-primary flat" href="{{ $createUrl }}"><i class="fa fa-plus"></i> {{ trans('admin::lang.table.new-entry') }}</a>
			@endif
      </div>
      <br>
    </div>

    <div class="box-body">

		<div class="dd nestable" data-url="{{ $url }}/reorder">
			<ol class="dd-list">
				@include(AdminTemplate::view('display.tree_children'), ['children' => $items])
			</ol>
		</div>

	</div>
</div>