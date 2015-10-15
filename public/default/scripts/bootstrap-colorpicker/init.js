$(function(){
  	$('.soa-colorpicker').each(function () {
		var $this = $(this);
		var nullable = $this.data('nullable');
		var maxOptions = false;

		var options = {};

		if ( typeof($this.attr('multiple')) == "undefined" && typeof(nullable) != "undefined" ) {
			$this.attr('multiple', '');
			maxOptions = 1;
		}

		$this.colorpicker({
			'title': window.admin.lang.select.placeholder,
			'maxOptions': maxOptions,
			'DEFAULTS': {
				'noneSelectedText': window.admin.lang.select.nothing
			}
		});
	});
});