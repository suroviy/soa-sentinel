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
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-user fa-fw"></i>
					{{ \Sentinel::check()->first_name ?: 'admin' }}
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