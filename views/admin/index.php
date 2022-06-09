<div class="main-menu" id="menu">
    <title>Главное меню</title>
    <h3 id="name_menu">Панель администратора</h3>
    <div class="mainContainer">
        <div class="mainBox" id="exam/list" title="Экзамены">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="bi bi-collection"></i>
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
                <i class="bi bi-person-fill"></i>
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
                <i class="bi bi-person-lines-fill"></i>
                <h2>Эксперты</h2>
            </div>
            <div class="mainContent">
                <h2>Эксперты</h2>
                <p>Страница экспертов с основной информацией. На ней можно назначить проверку экзамена экспертом.</p>
            </div>
        </div>
        <div class="mainBox" id="subject/index" title="Предметы">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="bi bi-book"></i>
                <h2>Предметы</h2>
            </div>
            <div class="mainContent">
                <h2>Предметы</h2>
                <p>Панель управления предметами.</p>
            </div>
        </div>
        <div class="mainBox" id="template-blank/index" title="Бланки">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="bi bi-file-earmark"></i>
                <h2>Бланки</h2>
            </div>
            <div class="mainContent">
                <h2>Бланки</h2>
                <p>Панель управления бланками.</p>
            </div>
        </div>
        <div class="mainBox" id="variant/index" title="Варианты">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="bi bi-list-ol"></i>
                <h2>Варианты</h2>
            </div>
            <div class="mainContent">
                <h2>Варианты</h2>
                <p>Панель управления вариантами</p>
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