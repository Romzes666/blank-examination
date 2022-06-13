$('#type-fill').hide();
$('#chapter-two').hide();
$('.continue').on('click', function () {
	$('#chapter-one').hide();
	$('#type-fill').show();
});
$('#fill-site').on('click', function () {
	$('#type-fill').hide();
	$('#chapter-two').show();
})

var img = new Image;
img.onload = setup;
img.src = "/web/upload/variant/1234/3.jpg";

function setup() {
	var canvas = document.querySelector("canvas"),
		ctx = canvas.getContext("2d"),
		lastPos, isDown = false;

	ctx.drawImage(this, 0, 0, canvas.width, canvas.height);  // draw duck
	ctx.lineCap = "round";                                   // make lines prettier
	ctx.lineWidth = 3;
	ctx.globalCompositeOperation = "multiply";               // KEY MODE HERE

	canvas.onmousedown = function(e) {
		isDown = true;
		lastPos = getPos(e);
		ctx.strokeStyle = "hsl(0,0,0)";
	};
	window.onmousemove = function(e) {
		if (!isDown) return;
		var pos = getPos(e);
		ctx.beginPath();
		ctx.moveTo(lastPos.x, lastPos.y);
		ctx.lineTo(pos.x, pos.y);
		ctx.stroke();
		lastPos = pos;
	};
	window.onmouseup = function(e) {isDown = false};

	function getPos(e) {
		var rect = canvas.getBoundingClientRect();
		return {x: e.clientX - rect.left, y: e.clientY - rect.top}
	}
}
$('#save').on('click', function () {
	let canvas = document.querySelector("canvas")
	let dataURL = canvas.toDataURL("image/png");
	$.ajax({
		type: "POST",
		url: "index.php?r=exam/save",
		data: {
			imgBase64: dataURL
		}
	}).done(function(o) {
		console.log('saved');
	});
})