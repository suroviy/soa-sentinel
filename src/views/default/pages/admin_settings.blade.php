<div class="box">

<form action="{{ route('admin.settings') }}" method="post">
	<div class="box-body">
			<input type="hidden" name="_token" value="{{ csrf_token() }}" />
			@foreach ($items as $item)
				{!! $item !!}
			@endforeach
		</div>
		<div class="box-footer">

				<input type="submit" value="{{ trans('admin::lang.table.save') }}" class="btn btn-primary flat"/>
				<a href="{{ route('admin.settings.reset') }}" class="btn btn-default flat">Reset Settings</a>
			
		</div>
</form>

</div>