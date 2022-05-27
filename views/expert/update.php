<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Обновление Эксперта: ' . $model->user_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Эксперты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_name. ' ' .$model->last_name, 'url' => ['view', 'user_id' => $model->user_id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
