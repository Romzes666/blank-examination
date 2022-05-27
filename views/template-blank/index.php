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
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="template-blank-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать шаблон', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name:text:Предмет',
            'subject.type:text:Тип тестирования',
            'type:text:Тип бланка',
            'image_name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TemplateBlank $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
