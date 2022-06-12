<?php

use app\models\UserExam;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserExamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Exams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-exam-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Exam', ['create'], ['class' => 'btn btn-success']) ?>
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

            'variant.subject.name',
            'variant.subject.type',
            'variant.number',
            'user.user_name',
            'user.last_name',
            'status',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, UserExam $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
