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
    <div id="tasks_container" class="tasks-details mt-5 mb-5"></div>
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
<div class="intro exam-test-inner">
    <div class="test-form-container">
        <form method="post" enctype="multipart/form-data" id="add_exam_form">
            <div id="tasks_area" class="intro__inner" style="display: none;">
                <div class="intro__title">
                    <h3>Задания</h3>
                    <span id="message_tasks"></span>
                </div>
                <div id="tasks_page" class="tasks-container modal-body">
                    <div class="set-tasks-area">
                        <label class="col-md-4">Количество заданий<span class="text-danger">*</span></label>
                        <div class="col-md-3">
                            <input type="number" onkeydown="check(event);" onchange="taskValid(this);" list="task_list"
                                   name="tasks_select" id="tasks_select"
                                   class="form-control" value="10" placeholder="10 - 50"/>
                            <datalist id="task_list">
                                <option class="option-sub" value="10">10</option>
                                <option class="option-sub" value="20">20</option>
                                <option class="option-sub" value="30">30</option>
                                <option class="option-sub" value="40">40</option>
                            </datalist>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="tasks_success" class="btn">Вывести</button>
                        </div>
                    </div>
                    <div class="modal-footer mb-5">
                        <button type="button" class="btn btn-sm" name="back_tasks" id="back_tasks">
                            Назад
                        </button>
                        <button type="button" class="btn btn-sm" name="continue_tasks" id="continue_tasks">
                            Продолжить
                        </button>
                    </div>
                </div>
            </div>
            <div id="save_area" class="intro__inner" style="display: none;">
                <div class="intro__title">
                    <h3>Почти готово</h3>
                    <span id="message_save"></span>
                </div>
                <div id="save_page" class="save-container modal-body">
                    <div class="save-inner">
                        <p class="mb-4" style="font-size: 18px;">
                            Нажмите "Сохранить", чтобы не потерять Ваши настройки предмета.
                        </p>
                    </div>
                    <div class="modal-footer d-flex flex-column">
                        <button type="button" class="btn btn-sm mb-3" name="continue_save" id="continue_save">
                            Сохранить
                        </button>
                        <button type="button" class="btn btn-sm" name="back_save" id="back_save">
                            Назад
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>

