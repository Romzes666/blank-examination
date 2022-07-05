<?php

/** @var yii\web\View $this */
/** @var app\models\LoginForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Вход';
?>
<div class="login-page">
    <div class="intro__inner">
        <div class="newInn">
            <div class="box">
                <div class="bubbles" style="--i:0;"></div>
                <div class="bubbles" style="--i:1;"></div>
                <div class="bubbles" style="--i:2;"></div>
                <div class="bubbles" style="--i:3;"></div>
                <div class="bubbles" style="--i:4;"></div>
                <div class="container-login">
                    <div class="intro__inner">
                        <div class="intro__title"><h1>Вход</h1></div>
                        <div class="container">
                          <?php
                          if(isset($_GET['verified']))
                          {
                            echo '
                <div class="alert alert-success">
                Почта верефицирована, теперь можно войти
                </div>
                ';
                          }
                          ?>
                            <span id="message"></span>
                          <?php $form = ActiveForm::begin(); ?>
                            <div class="form-group" style="text-align: left">
                              <?= $form->field($model, 'email')->label('Почта') ?>
                            </div>
                            <div class="form-group" style="text-align: left">
                              <?= $form->field($model, 'password')->input('password')->label('Пароль') ?>
                            </div>
                          <?= $form->field($model, 'rememberMe')->checkbox([ 'label' => 'Запомнить меня',
                            'template' => "<div class=\"offset-lg-1 col-lg-3 custom-control custom-checkbox\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                          ]) ?>
                            <div class="form-group">
                                <input type="hidden" name="page" value="login" />
                                <input type="hidden" name="action" value="login" />
                                <div class="form-group">
                                  <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                          <?php ActiveForm::end(); ?>
                            <div align="center">
                                <?php
                                    echo '<a style="color: #fde19a" href="'.Url::to(['site/register']).'"> Регистрация</a>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
