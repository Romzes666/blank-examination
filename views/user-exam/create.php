<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserExam */

$this->title = 'Create User Exam';
$this->params['breadcrumbs'][] = ['label' => 'User Exams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-exam-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
