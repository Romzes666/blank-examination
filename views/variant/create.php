<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Variant */

$this->title = 'Создание варианта';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Варианты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'id' => 'save-form',
        'action' => ['variant/create'],
    ]); ?>
    <div id="main_area">
        <span id="message"></span>
        <div class="form-group">
            <label for="name_subject">Предмет<span class="text-danger">*</span></label>
            <input class="form-control" id="name_subject" name="name_subject" list="subject-list">
            <datalist id="subject-list">
                <option class="option-sub" value="Русский язык">Русский язык</option>
                <option class="option-sub" value="Физика">Физика</option>
                <option class="option-sub" value="Математика(профильный)">
                    Математика(профильный)
                </option>
                <option class="option-sub" value="Химия">Химия</option>
                <option class="option-sub" value="Информатика">Информатика</option>
                <option class="option-sub" value="Биология">Биология</option>
                <option class="option-sub" value="История">История</option>
                <option class="option-sub" value="Георграфия">География</option>
                <option class="option-sub" value="Английский язык">Английский язык</option>
                <option class="option-sub" value="Обществознание">Обществознание</option>
                <option class="option-sub" value="Литература">Литература</option>
                <option class="option-sub" value="Математика(базовый)">Математика(базовый)</option
            </datalist>
        </div>

        <div class="form-group">
            <label for="type_test">Тип тестирования<span class="text-danger">*</span></label>
            <input class="form-control" id="type_test" name="type_test" list="type-list">
            <datalist id="type-list">
                <option class="option-sub" value="ОГЭ">ОГЭ</option>
                <option class="option-sub" value="ГВЭ">ГВЭ</option>
                <option class="option-sub" value="ЕГЭ">ЕГЭ</option>
            </datalist>
        </div>

        <div class="form-group">
            <label for="class_templ">Класс<span class="text-danger">*</span></label>
            <input class="form-control" id="class_templ" name="class_templ">
        </div>

        <div class="form-group">
            <label for="number">Вариант<span class="text-danger">*</span></label>
            <input class="form-control" id="number" name="number">
        </div>

        <div class="form-group">
            <label for="kim">КИМ<span class="text-danger">*</span></label>
            <input type="file" accept="application/pdf" name="kim" id="kim"/>
        </div>
        <button type="button" id="continue" class="btn">Продолжить</button>
    </div>
    <div class="variant-form-container">
        <div class="main-container">
            <div id="tasks_area" class="intro__inner" style="display: none;">
                <div class="intro__title">
                    <h3>Задания</h3>
                    <span id="message_tasks"></span>
                </div>
                <div id="tasks_page" class="tasks-container modal-body mb-5">
                    <div class="tasks-inner-area mb-5">
                        <div id="var_tasks_container" class="tasks-details">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm" name="back_tasks" id="back_tasks">
                            Назад
                        </button>
                        <div class="form-group">
                          <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $form->end(); ?>
</div>
<?php
$this->registerJsFile(
    '@web/js/variant.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
