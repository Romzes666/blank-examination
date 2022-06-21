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
    <?php include Yii::$app->basePath.'/templates/menu-constructor.html'; ?>
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
