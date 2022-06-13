<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */
/* @var $inputs */

$this->title = $model->type_blank;
$this->params['breadcrumbs'][] = ['label' => 'Панель администратора', 'url' => ['admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Шаблоны бланков', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="template-blank-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id_tb' => $model->id_tb], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id_tb' => $model->id_tb], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот шаблон?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options' => ['class' => 'table table-dark table-bordered table-striped table-hover'],
        'attributes' => [
            //'id',
            //'id_subject',
            'type_blank',
            'input_count',
            //'image_name',
            'class_templ',
            'type_test',
        ],
    ]) ?>

    <div id="image-div" class="newInn">
        <div class="blank-area">
            <?php
            foreach ($inputs as $input) {
                echo "<div style='top: ".$input['input_top']."; 
            left: ".$input['input_left']."; 
            width: ".$input['input_width']."; 
            height: ".$input['input_height'].";' 
            class='hover_div'>
                <a class='hover_a' style='width: 200px'>
                <i class='far fa-question-circle'></i>".$input['input_tooltip']."</a></div>";
            }
            ?>
            <div class="image-frame">
                <img src="/web/blanks/templates/<?= $model->class_templ . "/" . $model->type_test ."/". $model->type_blank . "/" . $model->image_name?>">
            </div>
        </div>
    </div>

</div>
<?php
$this->registerJsFile(
    '@web/js/blank.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
