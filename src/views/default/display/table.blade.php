<div class="box">
	<div class="box-header">
		@if ( ! empty($title) )
			<h3>{{ $title }}</h3>
		@endif
      	<div class="box-tools">
        	@if ($creatable)
				<a class="btn btn-primary flat" href="{{ $createUrl }}"><i class="fa fa-plus"></i> {{ trans('admin::lang.table.new-entry') }}</a>
			@endif

			@foreach ($actions as $action)
				{!! $action !!}
			@endforeach
      </div>
    </div>

    <div class="box-body table-responsive no-padding">

		<table class="table table-striped">
			<thead>
				<tr>
					@foreach ($columns as $column)
						{!! $column->header() !!}
					@endforeach
				</tr>
			</thead>
			<tbody>
				@foreach ($collection as $instance)
					<tr>
						@foreach ($columns as $column)
							<?php
								$column->setInstance($instance);
							?>
							{!! $column !!}
						@endforeach
					</tr>
				@endforeach
			</tbody>
		</table>
		
	</div>
</div>