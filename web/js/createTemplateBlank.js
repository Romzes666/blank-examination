$('#menu-constructor').hide();
$('#checkInputs').on('click', function () {
    if ($('#checkInputs').is(':checked')) {
        $('#menu-constructor').show();
    }
    else {
        $('#menu-constructor').hide();
    }
});
const imgInp = document.getElementById('imgInp');
const blah = document.getElementById('blank');
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}