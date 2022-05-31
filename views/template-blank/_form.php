<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="template-blank-form" style="height: 200vh">

    <?php $form = ActiveForm::begin(); ?>

    <div class="newInn">
        <div class="blank-area">
            <div class="image-frame">
                <img src="/web/blanks/templates/<?= $model->class_templ . "/" . $model->type_test ."/". $model->type_blank . "/" . $model->image_name?>">
            </div>
        </div>
    </div>
    <div style="display: flex; position: fixed; width: 100%; bottom: 0; left: 0; background: #111; padding: 20px 10px">
        <div>
            <button id="addInput" type="button" class="btn-primary elem-btn-lg mb-3">
                Добавить input
            </button>
            <button id="deleteInput" type="button" class="btn-primary elem-btn-lg mb3">
                Удалить input
            </button>
        </div>
        <div class="s-range row ml-3 mr-3">
            <label for="widthRange" class="form-label text-white">Ширина:</label>
            <div class="col-12">
            <input type="range" min="10" max="425" value="300" class="form-range"
                   id="widthRange" oninput="widthInput.value = widthRange.value">
            </div>
            <div class="col-12 d-flex justify-content-center mt-3">
            <input class="text-center form-control" type="number" autocomplete="off"
                   placeholder="50 - 600" id="widthInput"
                   oninput="widthRange.value = widthInput.value">
            </div>
        </div>
        <div class="s-range row ml-3 mr-3">
            <label for="heightRange" class="form-label text-white">Высота:</label>
            <div class="col-12">
                <input type="range" min="10" max="200" value="30" class="form-range"
                       id="heightRange" oninput="heightInput.value = heightRange.value">
            </div>
            <div class="col-12 d-flex justify-content-center mt-3">
                <input class="text-center form-control" type="number" autocomplete="off"
                       placeholder="20 - 200" id="heightInput"
                       oninput="heightRange.value = heightInput.value">
            </div>
        </div>
        <div class="row row-cols-lg-2 d-flex justify-content-center mt-2 ml-3 mr-3">
            <h3 class="text-center text-white">Подсказка</h3>
            <p>Если это Код/Название предмета
                напишите здесь КОД/НАЗВАНИЕ</p>
            <textarea id="hint" class="form-control col-12" rows="3"></textarea>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJsFile(
    '@web/js/constructor.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
