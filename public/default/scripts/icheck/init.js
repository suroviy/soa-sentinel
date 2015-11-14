$(function ()
{

	$('.soa-icheckbox').each(function () {

		var $this = $(this);

		$this.iCheck({
		    checkboxClass: 'icheckbox_'+$this.data('soa-icheck-skin')+"-"+$this.data('soa-icheck-color'),
		    increaseArea: $this.data('soa-icheck-increase') // optional
	  	});

	});

	$('.soa-iradio').each(function () {

		var $this = $(this);

		$this.iCheck({
		    radioClass: 'icheckbox_'+$this.data('soa-icheck-skin')+"-"+$this.data('soa-icheck-color'),
		    increaseArea: $this.data('soa-icheck-increase') // optional
	  	});

	});

});