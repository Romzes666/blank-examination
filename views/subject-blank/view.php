<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectBlanks */

$this->title = $model->id_sb;
$this->params['breadcrumbs'][] = ['label' => 'Subject Blanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subject-blanks-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_sb' => $model->id_sb], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_sb' => $model->id_sb], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_sb',
            'id_subject',
            'id_templateblank',
        ],
    ]) ?>

</div>
