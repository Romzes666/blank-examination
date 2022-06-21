let count = 0;
let activeInput = '';
let maxInputWidth = 0;
let maxInputHeight = 0;
let scrollPos = 0;
let posTop = 0;
const inputWidth = document.getElementById('widthInput');
const inputHeight = document.getElementById('heightInput');
const rangeWidth = document.getElementById('widthRange');
const rangeHeight = document.getElementById('heightRange');
const hint = document.getElementById('hint');
$("#save-form").submit(function(event) {
    event.preventDefault(); // stopping submitting
    event.stopImmediatePropagation();
    let data = new FormData(this);
    let url = $(this).attr('action');
    if ($('#checkInputs').is(':checked')){
        $('.frame').each(function (i) {
            data.append('title[]', this.hasAttribute('title') ? $(this).attr('title') : '');
            data.append('width[]', $(this).css('width'));
            data.append('top[]', $(this).css('top'));
            data.append('height[]', $(this).css('height'));
            data.append('left[]', $(this).css('left'));
            data.append('type[]', $(this).attr('value'));
        });
    }
    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        contentType:false,
        cache:false,
        processData:false,
        beforeSend:function()
        {
            console.log('fkkf')
        }
    })

});
$(document).ready(function () {
    $('#form-template').keydown(function (event) {
        if (event.keyCode === 13 && event.target.id !== 'hint') {
            event.preventDefault();
            return false;
        }
    });
    maxInputWidth = parseInt($('.image-frame').css('width'));
    maxInputHeight = parseInt($('.image-frame').css('height'));
    maxInputHeight = parseInt(maxInputHeight / 5);
    if (maxInputHeight < 100)
        maxInputHeight = 50;
    while (maxInputWidth % 5 !== 0) {
        maxInputWidth -= 1;
    }
    while (maxInputHeight % 5 !== 0) {
        maxInputHeight -= 1;
    }
    let strWidth = '10 - ' + maxInputWidth.toString();
    let strHeight = '10 - ' + maxInputHeight.toString();
    $('#widthRange').attr('max', maxInputWidth);
    $('#heightRange').attr('max', maxInputHeight);
    $('#widthInput').attr('placeholder', strWidth);
    $('#heightInput').attr('placeholder', strHeight);
});
// $(window).scroll(function () {
//     let st = $(this).scrollTop();
//     if (st > scrollPos)
//         $('.form-area').css('top', posTop + $(this).scrollTop());
//     $('.form-area').css('top', posTop + $(this).scrollTop());
//     scrollPos = st;
// });
$('input[id=widthInput]').keyup(function () {
    let flag = inputWidth.type === 'number' && inputWidth.value >= 10 && inputWidth.value <= maxInputWidth
        && inputWidth.value.indexOf('e') === -1;
    if (flag) {
        if (activeInput !== '') {
            $('#' + activeInput).css('width', inputWidth.value);
        }
    }
});
$('input[id=widthInput]').change(function () {
    if (inputWidth.value < 50 || inputWidth.value > maxInputWidth) {
        inputWidth.value = '';
    }
});
$('input[id=widthInput]').click(function () {
    this.value = parseInt(rangeWidth.value);
});
$('input[id=widthRange]').change(function () {
    if (activeInput !== '') {
        $('#' + activeInput).css('width', inputWidth.value);
    }
});
$('input[id=heightInput]').keyup(function () {
    let flag = inputHeight.type === 'number' && inputHeight.value >= 10 && inputHeight.value <= maxInputHeight
        && inputHeight.value.indexOf('e') === -1;
    if (flag) {
        if (activeInput !== '') {
            $('#' + activeInput).css('height', inputHeight.value);
        }
    }
});
$('input[id=heightInput]').click(function () {
    this.value = parseInt(rangeHeight.value);
});
$('input[id=heightInput]').change(function () {
    if (inputHeight.value < 20 || inputHeight.value > maxInputHeight) {
        inputHeight.value = '';
    }
});
$('input[id=heightRange]').change(function () {
    if (activeInput !== '') {
        $('#' + activeInput).css('height', inputHeight.value);
    }
});
$('input[id=check_tooltip]').change(function () {
    $('input[id=check_sign]').prop('checked', false);
    $('input[id=check_answer]').prop('checked', false);
    if (activeInput !== '') {
        $('#' + activeInput).attr('value', this.value);
    }
});
$('input[id=check_answer]').change(function () {
    $('input[id=check_sign]').prop('checked', false);
    $('input[id=check_tooltip]').prop('checked', false);
    if (activeInput !== '') {
        $('#' + activeInput).attr('value', this.value);
    }
});
$('input[id=check_sign]').change(function () {
    $('input[id=check_tooltip]').prop('checked', false);
    $('input[id=check_answer]').prop('checked', false);
    if (activeInput !== '') {
        $('#' + activeInput).attr('value', this.value);
    }
});
$('textarea[id=hint]').change(function () {
    if (activeInput === '' || this.value.length < 5)
        return;
    $('#' + activeInput).attr('title', this.value);
});
$('#addInput').click(function () {
    rangeWidth.value = 300;
    inputWidth.value = '';
    rangeHeight.value = 30;
    inputHeight.value = '';
    hint.value = '';
    let input = `
<div name="inp${count}" id="inp${count}" value="help" class="draggable frame">${count}</div>
`;
    $('.blank-area').prepend(input);
    activeInput = $('#inp' + count).attr('id');
    count++;
    $('.draggable').draggable({
        containment: '.blank-area'
    });
});
$('#deleteInput').click(function () {
    $('.blank-area .frame').last(-1).remove();
    if (count !== 0) {
        count--;
    }
});
$(document).on('click', '.frame', function () {
    activeInput = $(this).attr('id');
    $('.frame').each(function () {
        $(this).css('text-decoration', 'none');
    });
    $(this).css('text-decoration', 'underline');
    rangeWidth.value = this.offsetWidth;
    inputWidth.value = this.offsetWidth;
    rangeHeight.value = this.offsetHeight;
    inputHeight.value = this.offsetHeight;
    hint.value = this.title;
    if ($(this).attr('value') === 'help') {
        $('input[id=check_tooltip]').prop('checked', true);
        $('input[id=check_sign]').prop('checked', false);
        $('input[id=check_answer]').prop('checked', false);
    }
    if ($(this).attr('value') === 'caption') {
        $('input[id=check_sign]').prop('checked', true);
        $('input[id=check_tooltip]').prop('checked', false);
        $('input[id=check_answer]').prop('checked', false);
    }
    if ($(this).attr('value') === 'answer') {
        $('input[id=check_answer]').prop('checked', true);
        $('input[id=check_sign]').prop('checked', false);
        $('input[id=check_tooltip]').prop('checked', false);
    }
});