$(function(){
  	$('.soa-colorpicker').each(function () {
		var $this = $(this);
		$this.colorpicker($this.data('soa-colorpicker'));
	});
});