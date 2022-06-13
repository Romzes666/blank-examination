$('.hover_div').hover(function () {
		$(this).find('.hover_a').show();
	},
	function() {
		$(this).find('.hover_a').hide();
	});
$('.hover_a').hide();

