$(function ()
{
	$('.typeahead').each(function ()
	{
		var $input 			= $(this);
		
		displayTextValue 	= $input.data('soa-displaytext');
		objFillFields 		= $input.data('soa-afterselect');
		

		$input.typeahead({

            source 			: $input.data('soa-source'),
            items 			: $input.data('soa-items'),
            minLength 		: $input.data('soa-minLength'),
            showHintOnFocus : $input.data('soa-showHintOnFocus'),
            autoSelect 		: $input.data('soa-autoSelect'),
            
            /**
             * This function will be used to generate the shown value in the dropdown
             * 
             * @param  {Object} 	item  	Item from the source
             * @return {Character}      	Evaluated Display Text
             */
            displayText : function(item) {
            	return eval($input.data('soa-displaytext'));
            },
            /**
             * This function will be used to fill other fields inside the form
             *  
             * @param  {Object} item Select Item
             * @return {[type]}      [description]
             */
            afterSelect : function( item ) {            	
            	for( var cFieldKey in objFillFields ) {            		
            		$('#'+cFieldKey).val( eval(objFillFields[cFieldKey]) );
            	}
            }
        }); 
	});
});