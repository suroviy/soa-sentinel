$(function ()
{

	$('.soa-icheckbox').each(function () {

		var $this = $(this);
		var skin 	= $this.data('soa-icheck-skin');
		var color 	= ( skin == "polaris" || skin == "futurico" ) ? "" : "-"+$this.data('soa-icheck-color');

		if( skin != "line" ) {

			$this.iCheck({
			    checkboxClass: 'icheckbox_'+skin+color,
			    increaseArea: $this.data('soa-icheck-increase') // optional
		  	});

		} else {

	      	var label 		= $this.parent().next();
	      	var label_text 	= label.text();

		    label.remove();
		    
		    $this.iCheck({
	      		checkboxClass: 'icheckbox_'+skin+color,
		  		increaseArea: $this.data('soa-icheck-increase'),
	      		insert: '<div class="icheck_line-icon"></div>' + label_text
		    });	  
		}
	});
	
	$('.soa-iradio').each(function () {

		var $this = $(this);
		var skin 	= $this.data('soa-icheck-skin');
		var color 	= ( skin == "polaris" || skin == "futurico" ) ? "" : "-"+$this.data('soa-icheck-color');

		if( skin != "line" ) {

			$this.iCheck({
			    radioClass: 'iradio_'+skin+color,
			    increaseArea: $this.data('soa-icheck-increase') // optional
		  	});

		} else {

	      	var label 		= $this.parent().next();
	      	var label_text 	= label.text();

		    label.remove();
		    
		    $this.iCheck({
	      		radioClass: 'iradio_'+skin+color,
		  		increaseArea: $this.data('soa-icheck-increase'),
	      		insert: '<div class="icheck_line-icon"></div>' + label_text
		    });	  
		}

	});
	

});