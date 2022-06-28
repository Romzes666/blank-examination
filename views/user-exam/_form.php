<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserExam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-exam-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_variant')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Создан' => 'Создан', 'Отправлен на проверку' => 'Отправлен на проверку', 'Проверено' => 'Проверено', 'На доработке' => 'На доработке', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
