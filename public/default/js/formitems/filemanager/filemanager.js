$(document).on('click','.popupBrowse',function (event) {
	event.preventDefault();
	var id = $(this).attr('data-inputid');
	var elfinderUrl = window.admin.elfinder_url;
	var url = elfinderUrl +"/"+id;
	$.colorbox({
	    href: url,
	    fastIframe: true,
	    iframe: true,
	    width: '70%',
	    height: '80%'
	 });

});
function processSelectedFile(filePath, field) {
	$('#' + field).val(filePath);
	$(".thumb-"+field).children( ".no-value" ).addClass('hidden');
	$(".thumb-"+field).children( ".has-value" ).removeClass('hidden').attr('src', location.protocol + "//" + location.host+"/"+filePath);	
}
$(document).on('click', '.popupRemove',function (event){
	event.preventDefault();
	var id = $(this).attr('data-inputid');
	$('#' + id).val('');
	$(".thumb-"+id).children( ".no-value" ).removeClass('hidden');
	$(".thumb-"+id).children( ".has-value" ).addClass('hidden').attr('src', '');
});