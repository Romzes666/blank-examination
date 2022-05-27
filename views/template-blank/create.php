<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */

$this->title = 'Создание Шаблона';
$this->params['breadcrumbs'][] = ['label' => 'Шаблон бланка', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-blank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
