<?php
	$prefix = "";
	if (!empty($lang)) {
		$prefix = $lang . '_';
	}
?>
@foreach ($errors->get($prefix . $name) as $error)
	<p class="help-block">{{ $error }}</p>
@endforeach
