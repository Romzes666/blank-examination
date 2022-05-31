<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */

$this->title = 'Обновление шаблона: ' . $model->type_blank;
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны бланков', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->type_blank, 'url' => ['view', 'id_tb' => $model->id_tb]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="template-blank-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
