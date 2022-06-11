<?php

use app\models\User;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs']['admin'] = $this->title;
?>
<div class="user-index">

    <?php
    Modal::begin([
        'title' => 'Заполните форму',
        'id' => 'modal',
    ]);
    ?>

    <?php $form = ActiveForm::begin([
        'id' => 'save-form',
        'action' => ['user/index'],
        'class' => 'form-control-user'
    ]); ?>
    <span id="message"></span>
    </br>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Предмет</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Предмет" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="phone" class="col-sm-2 col-form-label">Вариант</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="variant" id="variant" placeholder="Вариант" required>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10">
            <input type="hidden" name="idUser" id="idUser">
            <?= Html::submitButton('Отправить', ['class' => 'btn-success .send-request', 'id' => 'send-request']) ?>
        </div>
    </div>

    <?php $form->end(); ?>

    <?php
    Modal::end();
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-dark table-bordered table-striped table-hover'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_email_address:text:Почта',
            'user_name:text:Имя',
            'last_name:text:Фамилия',
            [
                'label' => 'Тестирование',
                'format' => 'raw',
                'value' => function($data){
                    return Html::button('Назначить', ['class' => 'btn-primary modal-open', 'id' => $data->user_id]);
                },
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, User $model) {
                    return Url::toRoute([$action, 'user_id' => $model->user_id]);
                 }
            ],
        ],
    ]); ?>


</div>
<?php
$this->registerJsFile('@web/js/modalUserVariant.js',
    ['depends' => [\yii\web\JqueryAsset::class]]);
?>
