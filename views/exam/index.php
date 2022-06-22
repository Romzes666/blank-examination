<?php

use app\models\UserExam;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Экзамены';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-exam-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'variant.subject.name',
            'variant.subject.type',
            'variant.number',
            'status',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Тестирование',
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<button class="btn-primary">Пройти</button>', $url, [
                            'title' => Yii::t('app', 'lead-view'),
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    return 'index.php?r=exam/registration&id=' .$model->id;
                }
            ],
            [
                'class' => ActionColumn::class,
                'template' => '{view}{update}',
                'urlCreator' => function ($action, UserExam $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
