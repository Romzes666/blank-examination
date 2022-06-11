$('.modal-open').on('click', function() {
	let idUser = $(this).attr('id');
	$('#idUser').val(idUser);
	$('#modal').modal('show');
});
$('.modal-content').css('background', '#454d55')
$('#save-form').submit(function (event) {
	event.preventDefault();
	event.stopImmediatePropagation();
	let idUser = $('#idUser').val();
	let variant = $('#variant').val();
	let url = $(this).attr('action');
	$.ajax({
		url: url,
		type: 'post',
		dataType: 'json',
		data: {idUser: idUser, variant: variant},
		beforeSend:function()
		{
			$('#send-request').attr('disabled', true);
		},
		success:function(data)
		{
			$('#message').html('<div class="alert-info">'+data.message+'</div>')
		}
	})
})