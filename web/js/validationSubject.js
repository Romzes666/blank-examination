let count = 0;
$(document).ready(function () {
    $('#continue_main').click(function () {
        $('#first').attr('class', 'slider__item');
        $('#second').attr('class', 'slider__item active');
        $('#main_area').hide();
        $('#tasks_area').show();
        $('#save_area').hide();
    });

    $(document).on('click', '.inp-valid-description, .inp-valid-symbols, ' +
        '.inp-valid-score, .type-answer, .type-check, .input-valid-error', function () {
        $('#message_tasks').html('');
    });

    $('#continue_tasks').click(function () {
        let flag = true;
        let inputsValidDescription = $('.inp-valid-description');
        let inputsValidSymbols = $('.inp-valid-symbols');
        let inputsScore = $('.inp-valid-score');
        let inputsValidError = $('.input-valid-error');
        for (let i in inputsValidDescription) {
            if (inputsValidDescription[i].value === '')
                flag = false;
        }
        for (let i in inputsValidSymbols) {
            if (inputsValidSymbols[i].value === '')
                flag = false;
        }
        for (let i in inputsScore) {
            if (inputsScore[i].value === '')
                flag = false;
        }
        for (let i in inputsValidError) {
            if (inputsValidError[i].value === '')
                flag = false;
        }
        if (count === '' || count === 0)
            flag = false;
        if (!flag) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            if (count === '' || count === 0) {
                $('#message_tasks').html('<div class="alert alert-danger" style="font-size: 14px">' +
                    'Укажите параметры заданий.</div>');
            }
            else {
                $('#message_tasks').html('<div class="alert alert-danger" style="font-size: 14px">' +
                    'Заполните все поля.</div>');
            }
        }
        else {
            $('#message_tasks').html('');
            $('#second').attr('class', 'slider__item');
            $('#last').attr('class', 'slider__item active');
            $('#main_area').hide();
            $('#tasks_area').hide();
            $('#save_area').show();
        }
    });

    $('#back_tasks').click(function () {
        $('#second').attr('class', 'slider__item');
        $('#first').attr('class', 'slider__item active');
        $('#main_area').show();
        $('#tasks_area').hide();
        $('#save_area').hide();
    });

    $('#continue_save').click(function () {//save logic
    });

    $('#back_save').click(function () {
        $('#last').attr('class', 'slider__item');
        $('#second').attr('class', 'slider__item active');
        $('#main_area').hide();
        $('#tasks_area').show();
        $('#save_area').hide();
    });

    $('#tasks_success').click(function () {
        count = $('#subject-count_task').val();
        console.log(count);
        $('#tasks_container').html('');
        for (let i = 0; i < count; i++) {
            $('#tasks_container').append(`
                <div id='task${i + 1}' class='row-main mb-5'>
                    <div class='row mb-3'>
                        <div class='col-xl'>
                            <label>
                                Задание ${i + 1}
                                <span class='text-danger'>*</span>
                            </label>
                        </div>
                    </div>
                    <div class='row row-task'>
                        <div class='col-sm col-description'>
                            <input type='text' name='description[]' class='form-control inp-valid-description' required/>
                            <p>Описание задания</p>
                        </div>
                        <div class='col-sm col-symbols'>
                            <input type='text' name='symbols[]' class='form-control inp-valid-symbols' required/>
                            <p>Допустимые символы</p>
                        </div>
                        <div class='col-sm-2 col-score'>
                            <input type='number' name='score[]' class='form-control inp-valid-score'
                            value='1' onkeydown='check(event);' required/>
                            <p>Макс. балл</p>
                        </div>
                        <div class='col-sm col-answer'>
                            <select name='type_answer[]'
                            class='form-control black-select type-answer'>
                                <option value='Краткий ответ'>Краткий ответ</option>
                                <option value='Устная часть'>Устная часть</option>
                                <option value='Полный ответ'>Полный ответ</option>
                            </select>
                        </div>
                        <div class='col-sm col-check'>
                            <select name='type_check[]' id='type_check'
                            class='form-control black-select type-check'>
                                <option value='Полное совпадение'>Полное совпадение</option>
                                <option value='Порядок важен'>Порядок важен</option>
                                <option value='Порядок не важен'>Порядок не важен</option>
                            </select>
                        </div>
                    </div>
                    <div id='row_error${i + 1}' class="row row-error" style='display: none'></div>
                </div>`);
        }
    });
});

$(document).on('change', '.type-answer', function () {
    let value = $(this).val() || $(this).text();
    let parent = $(this).closest('.row-main').attr('id');
    if (value === 'Устная часть' || value === 'Полный ответ') {
        $(`#${parent} .col-check`).hide();
        $(`#${parent} .row-error`).html('');
        $(`#${parent} .row-error`).hide();
    }
    else if ($(`#${parent} .type-check`).val() === 'Полное совпадение') {
        $(`#${parent} .col-check`).show();
        $(`#${parent} .row-error`).html('');
        $(`#${parent} .row-error`).hide();
    }
    else {
        initRowError($(`#${parent} .row-error`));
        $(`#${parent} .col-check`).show();
        $(`#${parent} .row-error`).show();
    }
});

$(document).on('change', '.type-check', function () {
    let value = $(this).val() || $(this).text();
    let parent = $(this).closest('.row-main').attr('id');
    if (value === 'Порядок важен' || value === 'Порядок не важен') {
        initRowError($(`#${parent} .row-error`));
        $(`#${parent} .row-error`).show();
    }
    else {
        $(`#${parent} .row-error`).html('');
        $(`#${parent} .row-error`).hide();
    }
});

$(document).on('click', '.add-error', function () {
    let parent = $(this).closest('.row-error').attr('id');
    let p = $(`#${parent} .error-text`);
    let countError = p.length + 1;
    if (p.length === 10) return;
    $(`#${parent} .next-error-area`).append(`
                <div>
                    <input name='error[]' type='number' onkeydown='check(event);'
                    class='form-control input-valid-error' required>
                    <p class='error-text'>Балл при ${countError} ошибке(ах)</p>
                </div>
            `);
});

$(document).on('click', '.del-error', function () {
    let parent = $(this).closest('.row-error').attr('id');
    let count = $(`#${parent} .next-error-area div`).length;
    if (count !== 1)
        $(`#${parent} .next-error-area div`).last().remove();
});

function taskValid(input) {
    if (input.value > 50 || input.value < 1)
        input.value = '';
}

function check(e) {
    if (e.keyCode === 69 || (e.keyCode > 187 && e.keyCode < 192))
        e.preventDefault();
}

function initRowError(selector) {
    return selector.html(`
                <div class="col-sm-2">
                    <div class="next-error-area">
                        <div>
                            <input name='error[]' type='number' onkeydown='check(event);'
                            class='form-control input-valid-error' required>
                            <p class='error-text'>Балл при 1 ошибке(ах)</p>
                        </div>
                    </div>
                </div>
                <div class='col-sm-3 btn-area'>
                    <div>
                        <button type='button' class='btn add-error mb-3'>
                            Добавить
                        </button>
                    </div>
                    <div>
                        <button type='button' class='btn del-error'>
                            Удалить
                        </button>
                    </div>
                </div>
            `);
}