<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectBlanks */

$this->title = 'Update Subject Blanks: ' . $model->id_sb;
$this->params['breadcrumbs'][] = ['label' => 'Subject Blanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_sb, 'url' => ['view', 'id_sb' => $model->id_sb]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-blanks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
