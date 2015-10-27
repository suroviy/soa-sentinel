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
				@if(Session::has('succes_message'))
					<div class="callout callout-success">
						<p><i class="icon fa fa-check"></i> 
						   {{ Session::get('succes_message') }}.
						</p>
					</div>
				@elseif(Session::has('error_message'))
					<div class="callout callout-danger">
						<p><i class="icon fa fa-warning"></i> 
						   {{ Session::get('error_message') }}.
						</p>
					</div>
				@endif
				{!! $content !!}
			</section>
		</div>
	</div>
@stop
