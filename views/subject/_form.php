<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Subject */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'list' =>'names']) ?>
    <datalist id="names">
        <option class="option-sub" value="Русский язык">Русский язык</option>
        <option class="option-sub" value="Физика">Физика</option>
        <option class="option-sub" value="Математика(профильный)">Математика(профильный)</option>
        <option class="option-sub" value="Химия">Химия</option>
        <option class="option-sub" value="Информатика">Информатика</option>
        <option class="option-sub" value="Биология">Биология</option>
        <option class="option-sub" value="История">История</option>
        <option class="option-sub" value="Георграфия">Георграфия</option>
        <option class="option-sub" value="Английский язык">Английский язык</option>
        <option class="option-sub" value="Обществознание">Обществознание</option>
        <option class="option-sub" value="Литература">Литература</option>
        <option class="option-sub" value="Математика(базовый)">Математика(базовый)</option>
    </datalist>

    <?= $form->field($model, 'class')->textInput() ?>
    <?= $form->field($model, 'code')->textInput() ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true, 'list' => 'types']) ?>
    <datalist id="types">
        <option class="option-sub" value="ГВЭ">ГВЭ</option>
        <option class="option-sub" value="ЕГЭ">ЕГЭ</option>
        <option class="option-sub" value="ОГЭ">ОГЭ</option>
    </datalist>
    <?= $form->field($model, 'count_task')->textInput([
            'list' => 'task_list',
        'onchange' => 'taskValid(this)',
        'onkeydown'=> 'check(event)'
    ]) ?>
    <datalist id="task_list">
        <option class="option-sub" value="10">10</option>
        <option class="option-sub" value="20">20</option>
        <option class="option-sub" value="30">30</option>
        <option class="option-sub" value="40">40</option>
    </datalist>
    <div class="col-md-4">
        <button type="button" id="tasks_success" class="btn">Вывести</button>
    </div>
    <div class="test-form-container">
        <div id="tasks_container" class="tasks-details mt-5 mb-5"></div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile(
    '@web/js/validationSubject.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>

