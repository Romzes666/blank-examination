<?php

use app\models\Subject;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предметы';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать предмет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'class',
            'type',
            'count_task',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Бланки',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<button class="btn-primary">Посмотреть</button>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                        return 'index.php?r=subject-blank/index&id='.$model->id . '&type_test=' . $model->type;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Subject $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>



</div>
