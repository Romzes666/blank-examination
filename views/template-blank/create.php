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
    <?php include Yii::$app->basePath.'/templates/menu-constructor.html'; ?>
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
