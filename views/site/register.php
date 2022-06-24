<?php

/** @var yii\web\View $this */
/** @var app\models\RegisterForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Регистрация';
?>
<div class="register-page">
    <div class="intro__inner">
        <div class="newInn">
            <div class="box">
                <div class="bubbles" style="--i:0;"></div>
                <div class="bubbles" style="--i:1;"></div>
                <div class="bubbles" style="--i:2;"></div>
                <div class="bubbles" style="--i:3;"></div>
                <div class="bubbles" style="--i:4;"></div>
                <div class="container-register">
                    <div class="intro__inner">
                        <div class="intro__title mt-2"><h1>Регистрация</h1></div>
                        <div class="container">
                            <?php
                            if(isset($_GET['verified']))
                            {
                                echo '
                                <div class="alert alert-success">
                                Почта верефицирована, теперь можно войти
                                </div>';
                            }
                            ?>
                            <span id="message"></span>
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="form-group" style="text-align: left">
                                <?= $form->field($model, 'firstName')->label('Введите имя') ?>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <?= $form->field($model, 'lastName')->label('Введите фамилию') ?>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <?= $form->field($model, 'email')->input('email')->
                                label('Введите email') ?>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <?= $form->field($model, 'password', )->input('password')->
                                label('Создайте пароль') ?>
                            </div>
                            <div class="form-group" style="text-align: left">
                                <?= $form->field($model, 'image', )->input('file',
                                  ['class' => 'image-reg'])->label('Выберите изображение профиля:') ?>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="page" value="login" />
                                <input type="hidden" name="action" value="login" />
                                <div class="form-group">
                                    <?= Html::submitButton('Зарегестрироваться', ['class' => 'mt-3 btn btn-primary']) ?>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>