<div class="main-menu" id="menu">
    <title>Главное меню</title>
    <h3 id="name_menu">Главное меню</h3>
    <div class="mainContainer">
        <div class="mainBox" id="exam/list" title="Экзамены">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-table"></i>
                <h2>Экзамены</h2>
            </div>
            <div class="mainContent">
                <h2>Экзамены</h2>
                <p>Панель управления просмотра экзаменов.
                    Перейдите на эту страницу чтобы посмотреть статус или отправить на проверку эксперту.</p>
            </div>
        </div>
        <div class="mainBox" id="user/index" title="Пользователи">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fas fa-users"></i>
                <h2>Пользователи</h2>
            </div>
            <div class="mainContent">
                <h2>Пользователи</h2>
                <p>Страница пользователей с основной информацией.
                    На ней можно назначить экзамен определенным пользователям.</p>
            </div>
        </div>
        <div class="mainBox" id="expert/index" title="Эксперты">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-chalkboard-teacher"></i>
                <h2>Эксперты</h2>
            </div>
            <div class="mainContent">
                <h2>Эксперты</h2>
                <p>Страница экспертов с основной информацией. На ней можно назначить проверку экзамена экспертом.</p>
            </div>
        </div>
        <div class="mainBox" id="subject/index" title="Назначение экзамена">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fas fa-th-list"></i>
                <h2>Добавление предмета</h2>
            </div>
            <div class="mainContent">
                <h2>Добавление шаблона предмета</h2>
                <p>Панель управления добавления предмета.</p>
            </div>
        </div>
        <div class="mainBox" id="template-blank/index" title="Конструткор">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-hammer"></i>
                <h2>Конструктор бланков</h2>
            </div>
            <div class="mainContent">
                <h2>Конструктор бланков</h2>
                <p>Страница конструирования бланков.</p>
            </div>
        </div>
        <div class="mainBox" id="logout" title="Выход">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fas fa-list-alt"></i>
                <h2>Добавление варианта</h2>
            </div>
            <div class="mainContent">
                <h2>Добавление варианта</h2>
                <p>Нажмите чтобы перейти на страницу добавления варианта.</p>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs('
$(document).ready(function () {
        $(".main-menu").hide();
        $("#menu").show();
        $(".mainBox").click(function () {
            let ids = $(this).attr("id");
            $("#menu").fadeOut(1000,"linear", function () {
                complete();
            });
            function complete(){
                location.href="index.php?r="+ids;
            }
        });
    });
') ?>