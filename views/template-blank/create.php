<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */

$this->title = 'Создание шаблона';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны бланков', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-blank-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'save-form',
        'action' => ['template-blank/create'],
    ]); ?>

    <?= $form->field($model, 'type_blank')->textInput(['list' => 'blanks_t']) ?>
    <datalist id="blanks_t">
        <option value="Бланк регистрации">Бланк регистрации</option>
        <option value="Бланк ответов №1">Бланк ответов №1</option>
        <option value="Бланк ответов №2">Бланк ответов №2</option>
        <option value="Бланк ответов №2 лист 2">Бланк ответов №2 лист 2</option>
        <option value="Дополнительный бланк">Дополнительный бланк</option>
    </datalist>
    <?= $form->field($model, 'class_templ')->textInput() ?>

    <?= $form->field($model, 'type_test')->textInput(['list' => 'types']) ?>
    <datalist id="types">
        <option class="option-sub" value="ГВЭ">ГВЭ</option>
        <option class="option-sub" value="ЕГЭ">ЕГЭ</option>
        <option class="option-sub" value="ОГЭ">ОГЭ</option>
    </datalist>
    <div>
        <label for="imgInp">Бланк *:</label>
        <input accept="image/*" type='file' id="imgInp" name="blank" required/>
    </div>

    <div>
        <label for="checkInputs">Текстовые поля</label>
        <input type="checkbox" id="checkInputs" name="checkInputs">
    </div>
    <div class="blank-wrapper">
        <div id="image-div">
            <div class="blank-area">
                <div class="image-frame">
                    <img id="blank" src="/web/blanks/default.jpg">
                </div>
            </div>
        </div>
    </div>
    <div id="menu-constructor" class="row">
<!--        <div class="line-resize"></div>-->
        <div class="buttons-area col-md-2">
            <button id="addInput" type="button" class="btn-primary elem-btn-lg mb-3">
                Добавить input
            </button>
            <button id="deleteInput" type="button" class="btn-primary elem-btn-lg mb-4">
                Удалить input
            </button>
        </div>
        <div class="range-area col-md-4">
            <div class="s-range">
                <label for="widthRange" class="form-label text-white text-center mb-0">Ширина</label>
                <div>
                    <input type="range" min="10" max="425" value="300" class="form-range"
                           id="widthRange" oninput="widthInput.value = widthRange.value">
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <input class="text-center form-control" type="number" autocomplete="off"
                           placeholder="50 - 600" id="widthInput"
                           oninput="widthRange.value = widthInput.value">
                </div>
            </div>
            <div class="s-range mt-2">
                <label for="heightRange" class="form-label text-white text-center mb-0">Высота</label>
                <div>
                    <input type="range" min="10" max="200" value="30" class="form-range"
                           id="heightRange" oninput="heightInput.value = heightRange.value">
                </div>
                <div class="d-flex justify-content-center mt-2">
                    <input class="text-center form-control" type="number" autocomplete="off"
                           placeholder="20 - 200" id="heightInput"
                           oninput="heightRange.value = heightInput.value">
                </div>
            </div>
        </div>
        <div class="tooltip-area col-md-4">
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="help"
                           id="check_tooltip" value="help" checked>
                    <label class="form-check-label" for="check_tooltip">
                        Подсказка
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="caption"
                           id="check_sign" value="caption">
                    <label class="form-check-label" for="check_sign">
                        Подпись
                    </label>
                </div>
            </div>
            <p class="text-center">Если это Код/Название предмета
                напишите здесь КОД/НАЗВАНИЕ</p>
            <textarea id="hint" class="form-control" rows="6"></textarea>
        </div>
    </div>
    <button type="submit" class="btn-success mt-4 mb-2 btn-custom">Сохранить</button>
    <?php $form->end(); ?>
</div>
<?php
$this->registerJsFile(
    '@web/js/constructor.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/createTemplateBlank.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
