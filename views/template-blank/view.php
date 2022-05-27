<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Template Blanks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="template-blank-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-dark table-bordered table-striped table-hover'],
        'attributes' => [
            'id',
            'subject.name:text:Предмет',
            'subject.type:text:Тип тестирования',
            'type',
            'input_count',
            'image_name',
        ],
    ]) ?>

</div>
