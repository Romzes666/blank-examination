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
/* @var $subjects \app\models\Subject[] */

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
        <label for="name" class="col-sm-5 col-form-label">Тип тестирования:</label>
        <div class="col-sm-6">
            <input type="text" list="types" class="form-control"
                   name="type-test" id="type-test" placeholder="Тип тестирования" required
            >
            <datalist style="z-index: 1000" id="types">
                <option class="option-sub" value="ГВЭ">ГВЭ</option>
                <option class="option-sub" value="ЕГЭ">ЕГЭ</option>
                <option class="option-sub" value="ОГЭ">ОГЭ</option>
            </datalist>
        </div>
    </div>
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Предмет</label>
        <div class="col-sm-10">
            <select name="subject" id="subject" class="black-select form-control text-center">
                <option class="option-sub" value="Русский язык">Русский язык</option>
                <option class="option-sub" value="Физика">Физика</option>
                <option class="option-sub" value="Математика(профильный)">Математика(профильный)</option>
                <option class="option-sub" value="Химия">Химия</option>
                <option class="option-sub" value="Информатика">Информатика</option>
                <option class="option-sub" value="Биология">Биология</option>
                <option class="option-sub" value="История">История</option>
                <option class="option-sub" value="Георграфия">Георграфия</option>
                <option class="option-sub" value="Английский язык">Английский язык</option>
                <option class="option-sub" value="Обществознание">Обществознание</option>
                <option class="option-sub" value="Литература">Литература</option>
                <option class="option-sub" value="Математика(базовый)">Математика(базовый)</option>
            </select>
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
            <?= Html::submitButton('Отправить', ['class' => 'btn-custom btn-success 
            .send-request', 'id' => 'send-request']) ?>
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
                    return Html::button('Назначить', ['class' => 'btn-custom btn-primary modal-open', 'id' => $data->user_id]);
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
