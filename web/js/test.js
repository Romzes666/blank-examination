$('.blank-viewer__img').hide();
$('#1').show();
$(this).attr('class', 'btn active');
var img_id = '';
$('.btn').click( function () {
	img_id = $(this).text();
	$('.blank-viewer__img').hide();
	$('#'+img_id+'').show();
	$('.btn.active').attr('class', 'btn');
	$(this).attr('class', 'btn active');
});