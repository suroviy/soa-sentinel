<div class="box">
	<div class="box-header">
		@if ( ! empty($title) )
			<h3>{{ $title }}</h3>
		@endif
      	@include(AdminTemplate::view('_partials.displayactions'), ['show_actions' => false])
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