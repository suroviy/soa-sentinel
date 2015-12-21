@extends(AdminTemplate::view('_layout.base'))

@section('content')
	<div class="wrapper">
		<header class="main-header">
			@include(AdminTemplate::view('_partials.header'))
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				@include(AdminTemplate::view('_partials.menu'))
			</section>
		</aside>
		<div class="content-wrapper">
			<section class="content-header">
				<h1>
					@if(!empty($title)) 
						{{{ trans($title) }}}
					@endif
				</h1>
			</section>
			<section class="content">
				@include('flash::message')
				{!! $content !!}
			</section>
		</div>
	</div>
@stop
