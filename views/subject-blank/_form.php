<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectBlanks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-blanks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_subject')->textInput() ?>

    <?= $form->field($model, 'id_templateblank')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
