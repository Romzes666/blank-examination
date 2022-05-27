<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs']['admin'] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'user_id',
            'user_email_address:text:Почта',
            //'user_password',
            //'user_verfication_code',
            'user_name:text:Имя',
            'last_name:text:Фамилия',
            //'user_image',
            //'user_created_on',
            //'user_email_verified:email',
            //'auth_key',
            //'access_token',
            [
                'label' => 'Тестирование',
                'format' => 'raw',
                'value' => function($data){
                    return Html::button('Назначить', ['class' => 'btn-primary']);
                },
            ],
            //'role',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
