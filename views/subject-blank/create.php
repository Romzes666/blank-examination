<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectBlanks */
/* @var $template app\models\TemplateBlank[] */
$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Бланки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-blanks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_subject')->textInput(['type' => 'hidden', 'value' => $_GET['id_subject']])->label('') ?>

    <select name="id_templateblank" class="black-select form-control text-center">
        <?php
        foreach ($template as $temp) {
            echo "<option value='$temp->id_tb'>$temp->type_blank</option>";
        }
        ?>
    </select>
    </br>
    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
