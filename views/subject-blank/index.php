<?php

use app\models\SubjectBlanks;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubjectBlankSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бланки предмета';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-blanks-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить',
            'index.php?r=subject-blank/create&type_test='.$_GET['type_test'].'&id_subject='.$_GET['id'],
            ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'templateblank.type_blank:text:Предмет',
            [
                'class' => ActionColumn::className(),
                'header' => 'Действие',
                'template' => '{delete}',
                'urlCreator' => function ($action, SubjectBlanks $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_sb' => $model->id_sb, 'type_test' => $_GET['type_test']]);
                 }
            ],
        ],
    ]); ?>


</div>
