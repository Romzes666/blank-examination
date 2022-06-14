
$(document).ready(function () {
    $('#number, #kim').click(function () {
        $('#message_main').html('');
    });

    $('#continue').click(function () {
        if ($('#number').val() !== '' && $('#kim').val() !== '') {
            let name = $("#name_subject").val();
            let class_templ = $('#class_templ').val();
            let type_test = $('#type_test').val();
            let url = '/web/index.php?r=variant/create';
            $.ajax({
                url: url,
                type: 'post',
                dataType: 'json',
                data: {name: name, action: 'проверка', class_templ: class_templ, type_test: type_test},
                beforeSend:function()
                {
                    $('#continue').attr('disabled', 'disabled');
                    $('#continue').val('Подождите...');
                },
                success:function(data)
                {
                    if(data.success)
                    {
                    	$('#tasks_area').append(`
							<input name="id_subject" value="${data.template[0]['id_subject']}" hidden>
							<input name="count" value="${data.template.length}" hidden>
`						);
                        $('#message').html('');
                        $('#main_area').hide();
                        for (let i = 0; i < data.template.length; ++i) {
							$('#tasks_area').append(`
								<input name="id_task${i}" value="${data.template[i]['id']}" hidden>
`							);
                            if (data.template[i]['type_check'] === "Полное совпадение") {
                                $('#var_tasks_container').append(`
                                <div id="taska${i}" class="form-group row-main row-answers">
                                    <div class="row mb-1">
                                        <label class="col-xl col-form-label">
                                        	Задание ${data.template[i]['content']}
                                        </label>
                                    </div>
                                    <div class="row row-answers">
                                        <div class="col-sm-12 row-answers-inner">
                                            <div class="col-sm-6 col-answer">
                                                <label for="task${i}">Ответ</label>
                                        	      <input name="answer${i}[]" class="form-control" id="task${i}" required>
                                            </div>
                                            <div class="col-sm-6 col-score">
                                                <label for="score${i}">Балл</label>
                                        	      <input name="score${i}[]" class="form-control" id="score${i}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-add-answers mt-4">
                                        <div class="col-sm-12 col-add mb-3">
                                            <button type='button' class='btn add-answers'>
                                                Добавить
                                            </button>
                                        </div>
                                        <div class="col-sm-12 col-add">
                                            <button type='button' class='btn del-answers'>
                                                Удалить
                                            </button>
                                        </div>
                                    </div>
                              </div>
                                `)
                            }
                            else {
								$('#var_tasks_container').append(`
                                <div id="taska${i}" class="form-group row-main row-answers">
                                    <div class="row mb-1">
                                        <label class="col-xl col-form-label">
                                        	Задание ${data.template[i]['content']}
                                        </label>
                                    </div>
                                    <div class="row row-answers">
                                        <div class="col-sm-12 row-answers-inner">
                                            <div class="col-sm-6 col-answer">
                                              <label for="task${i}">Ответ</label>
                                              <input name="answer${i}[]" class="form-control" id="task${i}" required>
                                            </div>
                                            <div class="col-sm-6 col-score">
                                                <label for="score${i}">Балл</label>
                                                <input name="score${i}[]" class="form-control" id="score${i}" required>
                                            </div>
                                        </div>
                                    </div>
                    			      </div>
                                `)
							}
                        }
                        $('#tasks_area').show();
                    }
                    else
                    {
                        $('#message').html('<div class="alert alert-danger">'+data.error+'</div>');
                    }
                    $('#continue').attr('disabled', false);
                    $('#continue').val('Продолжить...');
                }
            })
        }
        else {
            $('#message_main').html('<div class="alert alert-danger" style="font-size: 14px">' +
                'Заполните все поля.</div>');
        }
    });

    $(document).on('click', '.input-answer, .input-score', function () {
        $('#message_tasks').html('');
    });

    $('#continue_tasks').click(function () {
        let flag = true;
        let inputsValidAnswer = $('.input-answer');
        let inputsValidScore = $('.input-score');
        for (let i in inputsValidAnswer) {
            if (inputsValidAnswer[i].value === '')
                flag = false;
        }
        for (let i in inputsValidScore) {
            if (inputsValidScore[i].value === '')
                flag = false;
        }
        if (!flag) {
            window.scrollTo({ top: 0, behavior: 'smooth' });
            $('#message_tasks').html('<div class="alert alert-danger" style="font-size: 14px">' +
                'Заполните все поля.</div>');
        }
        else {
            $('#message_tasks').html('');
            $('#second').attr('class', 'slider__item');
            $('#last').attr('class', 'slider__item active');
            $('#main_area').hide();
            $('#tasks_area').hide();
        }
    });

    $('#back_tasks').click(function () {
        $('#second').attr('class', 'slider__item');
        $('#first').attr('class', 'slider__item active');
        $('#main_area').show();
        $('#tasks_area').hide();
    });

    $('#back_save').click(function () {
        $('#last').attr('class', 'slider__item');
        $('#second').attr('class', 'slider__item active');
        $('#subject_area').hide();
        $('#tasks_area').show();
    });
});
$("#save-form").submit(function(event) {
	event.preventDefault(); // stopping submitting
	event.stopImmediatePropagation();
	let data = new FormData(this);
	let url = $(this).attr('action');
	$.ajax({
		url: url,
		type: 'post',
		dataType: 'json',
		data: data,
		contentType:false,
		cache:false,
		processData:false,
	})
		.done(function(response) {
			console.log("Wow you commented");
		})
		.fail(function() {
			console.log("error");
		});

});

$(document).on('click', '.add-answers', function () {
    let parent = $(this).closest('.row-main').attr('id');
    let i = parent.substr(parent.length-1,1);
    $(`#${parent} .row-answers`).append(`
            <div class="col-sm-12 row-answers-inner mt-3">
                <div class="col-sm-6 col-answer">
                    <label for="task${i}">Ответ</label>
								    <input name="answer${i}[]" class="form-control" id="task${i}" required>
                </div>
                <div class="col-sm-6 col-score">
                    <label for="score${i}">Балл</label>
								    <input name="score${i}[]" class="form-control" id="score${i}" required>
                </div>
            </div>
            `);
});
$(document).on('click', '.del-answers', function () {
    let parent = $(this).closest('.row-main').attr('id');
    let count = $(`#${parent} .row-answers-inner`).length;
    if (count !== 1)
        $(`#${parent} .row-answers-inner`).last().remove();
});

function check(e) {
    if (e.keyCode === 69 || (e.keyCode > 187 && e.keyCode < 192))
        e.preventDefault();
}