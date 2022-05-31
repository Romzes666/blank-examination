<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subject */
/* @var $blanks */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Предметы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subject-view">
    <h1><?= Html::encode($this->title) . ' ' . $model->type ?></h1>
    <h3>Привязанные бланки</h3>
    <?php
    foreach ($blanks as $blank) {
        echo $blank['type_blank'];
    }
    ?>
</div>
