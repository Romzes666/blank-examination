<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Variant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_subject')->textInput() ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'count_list')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
