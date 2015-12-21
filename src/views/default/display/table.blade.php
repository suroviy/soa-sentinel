<div class="box">
	<div class="box-header">
		@if ( ! empty($title) )
			<h3>{{ $title }}</h3>
		@endif
      	@include(AdminTemplate::view('_partials.displayactions'))
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