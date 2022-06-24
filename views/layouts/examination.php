<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<header class="header">
    <div class="header-content">
        <div class="header__inner">
            <a class="header__logo" href="<?= !Yii::$app->user->isGuest ? Url::to(['main/index']) : Url::to(['site/index']) ?>">ТОГИРРО</a>
            <nav class="nav">
                <?php
                if (!Yii::$app->user->isGuest) {
                    if (Yii::$app->user->identity->role == "admin") {
                        echo '<a class="nav__link" href="'.Url::to(['admin/index']).'" name="name" id="name">Панель администратора</a>';
                    }
                    echo '<a class="nav__link" href="'.Url::to(['main/profile']).'" name="name" id="name">'.Yii::$app->user->identity->user_name.'</a>';
                    echo '<a class="nav__link" href="'.Url::to(['main/index']).'" name="main" id="main">Главная</a>';
                    echo'<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                        . Html::submitButton(
                            'Выйти', ['class' => 'btn-exit btn-danger'])
                        . Html::endForm()
                        . '</li>';
                }
                else {
                    echo '<a class="nav__link" href="'.Url::to(['site/register']).'" id="register">Регистрация</a>';
                    echo '<a class="nav__link" href="'.Url::to(['site/index']).'"  id="login">Войти</a>';
                    echo '<a class="nav__link" href="'.Url::to(['site/contact']).'" id="contact">Контакты</a>';
                    echo '<a class="nav__link" href="'.Url::to(['site/about']).'" id="about">О нас</a>';
                }
                ?>
            </nav>
        </div>
    </div>
</header>
<main style="color: white;">
        <div style="padding: 100px 20px;" class="container">
            <?= Breadcrumbs::widget([
                'homeLink' => [
                    'label' => 'Главная',
                    'url' => 'index.php?r=main/index',
                ],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
</main>
<footer>
    <div class="footer-content">
        <h3>Сайт тестирования участников Тюменской области</h3>
        <p>Спасибо, что пользуетесь именно нашим сайтом для прохождения пробного онлайн тестирования. Ниже распологаются ссылки на наши социальные сети и контакты, куда можно писать в случае проблем.</p>
        <ul class="socials">
            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
            <li><a href="#"><i class="fab fa-google"></i></a></li>
            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
            <li><a href="#"><i class="fab fa-vk"></i></a></li>
        </ul>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
