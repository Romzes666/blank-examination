<?php

use app\models\Variant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VariantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Варианты';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать вариант', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
            'subject.name',
            'subject.type',
            'subject.class',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Тестируемые',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<button class="btn-primary">Посмотреть</button>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    return 'index.php?r=flat-specifications/index&id='.$model->id;
                }
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Variant $model) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
