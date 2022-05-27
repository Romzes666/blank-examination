<div class="main-menu" id="menu">
    <title>Главное меню</title>
    <h3 id="name_menu">Главное меню</h3>
    <div class="mainContainer">
        <div class="mainBox" id="exams" title="Экзамены">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-table"></i>
                <h2>Экзамены</h2>
            </div>
            <div class="mainContent">
                <h2>Экзамены</h2>
                <p>Панель управления назначенных экзаменов.
                    Перейдите на эту страницу чтобы начать или посмотреть результаты.</p>
            </div>
        </div>
        <div class="mainBox" id="profile" title="Профиль">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fas fa-users-cog"></i>
                <h2>Профиль</h2>
            </div>
            <div class="mainContent">
                <h2>Профиль</h2>
                <p>Страница профиля с основной информацией. На ней можно изменить контактные данные.</p>
            </div>
        </div>
        <div href="change-password" class="mainBox" id="change-password" title="Пароль">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-cash-register"></i>
                <h2>Пароль</h2>
            </div>
            <div class="mainContent">
                <h2>Пароль</h2>
                <p>Сменить пароль учетной записи.</p>
            </div>
        </div>
        <div class="mainBox" id="support" title="Поддержка">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <h2>Поддержка</h2>
            </div>
            <div class="mainContent">
                <h2>Поддержка</h2>
                <p>Часто задаваемые вопросы и служба поддержки пользователей.</p>
            </div>
        </div>
        <div class="mainBox" id="information" title="Информация">
            <div class="mainIcon" style="--i:#FFB600">
                <i class="fas fa-info-circle"></i>
                <h2>Информация</h2>
            </div>
            <div class="mainContent">
                <h2>Информация</h2>
                <p>Контактные данные организации.</p>
            </div>
        </div>
        <div class="mainBox" id="logout" title="Выход">
            <div class="mainIcon" style="--i:#0049FF">
                <i class="fas fa-sign-out-alt"></i>
                <h2>Выход</h2>
            </div>
            <div class="mainContent">
                <h2>Выход</h2>
                <p>Нажмите чтобы выйти с системы.</p>
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
                location.href="index.php?r=main/"+ids;
            }
        });
    });
') ?>