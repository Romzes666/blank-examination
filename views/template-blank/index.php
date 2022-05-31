<?php

use app\models\TemplateBlank;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TemplateBlankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Шаблоны бланков';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-blank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать шаблон бланка', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_tb',
            'type_blank',
            'input_count',
            'class_templ',
            'type_test',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TemplateBlank $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_tb' => $model->id_tb]);
                 }
            ],
        ],
    ]); ?>


</div>
