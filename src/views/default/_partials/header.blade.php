<!-- Logo -->
<a href="{!! route('admin.dashboard') !!}" class="logo">
	<!-- mini logo for sidebar mini 50x50 pixels -->
	<span class="logo-mini">{{{ config('admin.title-mini') }}}</span>
	<!-- logo for regular state and mobile devices -->
	<span class="logo-lg">{{{ config('admin.title') }}}</span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			@if( Config::get('admin.language_switcher') )
			<li class="dropdown tasks tasks-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" alt="Current Language: {{ Config::get('admin.languages')[App::getLocale()] }}" title="Current Language: {{ Config::get('admin.languages')[App::getLocale()] }}">
					<i class="fa fa-flag-o"></i>
				</a>

				<ul class="dropdown-menu">
					<li class="header">Current Language: {{ Config::get('admin.languages')[App::getLocale()] }}</li>
					<li>
						<div>
							<ul class="menu">
								@foreach (Config::get('admin.languages') as $lang => $language)
									@if ($lang != App::getLocale())
									<li>
										<a href="{!! route('admin.language', $lang) !!}" alt="{{ $language }}" title="{{ $language }}">
											{{ $language }}
										</a>
									</li>
									@endif
								@endforeach
							</ul>
						</div>
					</li>
				</ul>
			</li>
			@endif


			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user fa-fw"></i>
					{{ \Sentinel::check()->first_name ?: 'admin' }} {{ \Sentinel::check()->last_name ?: '' }}
				</a>
				<ul class="dropdown-menu">
					<li class="user-footer">
						
						<div class="pull-right">
							<a href="{{ route('admin.logout') }}" class="btn btn-default btn-flat">{{ trans('admin::lang.auth.logout') }}</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>