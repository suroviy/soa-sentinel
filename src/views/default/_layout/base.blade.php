<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>{{ \Config::get('admin.title') }} @if(!empty($title)) - {{{ trans($title) }}} @endif</title>
		<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="csrf-token" content="{{ csrf_token() }}">

		@foreach (\SleepingOwl\Admin\AssetManager\AssetManager::styles() as $style)
			<link media="all" type="text/css" rel="stylesheet" href="{{ $style }}" >
		@endforeach

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		@foreach (\SleepingOwl\Admin\AssetManager\AssetManager::scripts() as $script)
			<script src="{{ $script }}"></script>
		@endforeach

		@if( Config::get('admintheme.sidebar_on_hover') )
		<script type="text/javascript">
	      	$(function () {
	      		$.AdminLTE.pushMenu.expandOnHover();
	      	});
		</script>
		@endif
		
	</head>

	<body class="skin-{!! Config::get('admintheme.skin') !!} @if( Config::get('admintheme.sidebar_mini') )sidebar-mini @endif @if( Config::get('admintheme.boxed_layout') ) layout-boxed @endif @if( Config::get('admintheme.fixed_layout') ) fixed @endif @if( Config::get('admintheme.toggle_sidebar') ) sidebar-collapse @endif @yield('body')">

		@yield('content')

		
	</body>
</html>