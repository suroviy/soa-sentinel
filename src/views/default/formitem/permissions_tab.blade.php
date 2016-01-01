<div>
  	<ul class="nav nav-tabs" role="tablist">
		<?php $nCount = 0; ?>
		@foreach ($all_permissions as $group_permission => $group_permissions)
			<li role="presentation" @if( $nCount == 0 )class="active"@endif>
				<a href="#{{ str_slug( trans($group_permission), '_') }}" aria-controls="{{ str_slug( trans($group_permission), '_') }}" role="tab" data-toggle="tab">{{ trans($group_permission) }}</a>
			</li>

		<?php $nCount++; ?>	
	  	@endforeach
  	</ul>


	<div class="tab-content">
		<?php $nCount = 0; ?>
		@foreach ($all_permissions as $group_permission => $group_permissions)
		<div role="tabpanel" class="tab-pane @if( $nCount == 0 ) active @endif" id="{{ str_slug( trans($group_permission), '_') }}">
			<table class="table table-striped table-hover">
				
				<thead>
					<tr>
						<th>{{ trans('admin::lang.permission.headline.permission') }}</th>
						<th>{{ trans('admin::lang.permission.headline.allowed') }}</th>
						<th>{{ trans('admin::lang.permission.headline.denied') }}</th>
						@if( $withInherited )
							<th>{{ trans('admin::lang.permission.headline.inherited') }}</th>
						@endif
					</tr>
				</thead>

				<tbody>
					@foreach ($group_permissions as $all_permission)
						<tr>
							
							<td>
								<a href="#" data-toggle="tooltip" title="{{ $all_permission['value']}}">
									{{ (!empty($all_permission['description'])) ? $all_permission['description'] : $all_permission['value'] }}
								</a>
							</td>

							<td>
								<input type="radio" name="{{ $fieldname }}[{{ $all_permission['value'] }}]" value="1" 
										@if( isset( $permissions[$all_permission['value']] ) ) 
											@if( $permissions[$all_permission['value']] == true)
												checked="checked"
											@endif
										@endif>
							</td>

							<td>
								<input type="radio" name="{{ $fieldname }}[{{ $all_permission['value'] }}]" value="0" 
									@if( isset( $permissions[$all_permission['value']] ) ) 
										@if( $permissions[$all_permission['value']] == false)
											checked="checked"
										@endif
									@endif>
							</td>

							@if( $withInherited )
							<td>
								<input type="radio" name="{{ $fieldname }}[{{ $all_permission['value'] }}]" value="2" 
									@if( !isset( $permissions[$all_permission['value']] ) )
										checked="checked"
									@endif>
							</td>
							@endif

						</tr>
					@endforeach


				</tbody>
			</table>

		</div>
		<?php $nCount++; ?>
		@endforeach
	</div>
</div>