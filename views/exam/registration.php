<div class="slider">
    <div class="container">
        <div class="slider__inner">
            <div class="slider__item active">
                <span class="slider__num">01</span>
                Регистрация
            </div>
            <div class="slider__item">
                <span class="slider__num">02</span>
                Выполнение
            </div>
            <div class="slider__item">
                <span class="slider__num">03</span>
                Решение
            </div>
            <div class="slider__item">
                <span class="slider__num">04</span>
                Отправка
            </div>
        </div>
    </div>
</div>
<div class="intro" style="align-items: center">
    <div class="textColor" style="margin-top: 200px">
        <h1>Для заполнения используйте эти данные</h1><br>
        <p>Код региона: <a id="region_id">72</a> Код образовательной организации: <a id="shool_id">123456</a></p>
        <p>Номер аудитории:<a id="shool_id">0112</a></p>
    </div>
    <div id="cont" style="text-align: center; width: 1100px; position: absolute; margin-top: 350px">
        <span id="message"></span>
        <div id="#dont"></div>
        <div role="button" id="content-reg" aria-hidden="false" tabindex="0">
            <div class="hover_div" style="left: 213px;top: 107px;width: 92px;height: 85px;position: absolute;">
                <a class="hover_a" id="message_nmbr"><i class="far fa-question-circle"></i> Поле содержит код вашего региона. Заполняется автоматически.</a>
            </div>
            <div id="number_div" class="hover_div" style="left: 324px;top: 146px;position: absolute;">
                <a class="hover_a" id="message_nmbr"><i class="far fa-question-circle"></i> Укажите код образовательной организации, в которой вы обучаетесь(ксли вы выпускник текущего года).<br> Допустимые символы 6 цифр</a>
                <a id="message_error_nmbr" style="padding: 8px 20px; font-family: 'Roboto', sans-serif; text-align: left; top: -67px;font-size: 12px; font-weight: 900; border-radius: 14px; border: 3px solid red; background: #ffffff;max-width200px;position: absolute"><i class="far fa-question-circle"></i> Впишите правильный код</a>
                <input id="inputnmbr" class="input_blank" type="text" style="width: 170px" maxlength="6">
            </div>
            <img draggable="false" src="/web/blanks/templates/11/ЕГЭ/Бланк%20регистрации/list.JPG" class="blank-viewer__img">
        </div>
        <div id="#editor"></div>
        <form method="post" id="exam_progress">
            <div class="form-group">
            </div>
        </form>
        <input class="btn" name="next_page" id="next_page" value="Продолжить" style="background-color: #66b0ff; border-radius: 10px">
        <div id="img" style="display:none;">
            <img src="" id="newimg" class="top" />
        </div>
    </div>
</div>