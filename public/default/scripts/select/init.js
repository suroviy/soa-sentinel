$(function ()
{
	$('.chosen').each(function ()
	{
		var $this = $(this);
		var nullable = $this.data('nullable');
		$this.chosen({
			allow_single_deselect: nullable,
			no_results_text: window.admin.lang.select.nothing,
			placeholder_text_single: window.admin.lang.select.placeholder,
			placeholder_text_multiple: window.admin.lang.select.placeholder,
		});
	});

	$(function () {
	    $('.chosen-container').width('100%');
	});

	$('.bsselect').each(function ()
	{
		var $this = $(this);
		var nullable = $this.data('nullable');
		var maxOptions = false;

		if ( typeof($this.attr('multiple')) == "undefined" && typeof(nullable) != "undefined" ) {
			$this.attr('multiple', '');
			maxOptions = 1;
		}

		$this.selectpicker({
			'title': window.admin.lang.select.placeholder,
			'maxOptions': maxOptions,
			'DEFAULTS': {
				'noneSelectedText': window.admin.lang.select.nothing
			}
		});
	});

	$('.bsselect2').each(function ()
	{
		var $this = $(this);
		var nullable = $this.data('nullable');

		$this.select2({
			'placeholder': window.admin.lang.select.placeholder,
			'allowClear': (typeof(nullable) != "undefined")
		});
	});
});