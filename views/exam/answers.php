<?php


/* @var $this yii\web\View */
/* @var $inputs app\models\BlankInputs[] */
/* @var $blanks app\models\TemplateBlank[] */
/* @var $blank app\models\Variant */
$this->title = 'Завершение';
echo '<pre>';
print_r($blanks);
echo '</pre>';
?>
<div class="slider">
    <div class="container">
        <div class="slider__inner">
            <div class="slider__item">
                <span class="slider__num">01</span>
                Регистрация
            </div>
            <div class="slider__item">
                <span class="slider__num">02</span>
                Выполнение
            </div>
            <div class="slider__item active">
                <span class="slider__num">03</span>
                Завершение
            </div>
        </div>
    </div>
</div>
<?php if(count($blanks) > 1) {?>
<div id="type-fill" class="intro__inner">
    <h1>Выберите как вы хотите заполнить 2 часть</h1>
    <div class="form-group">
        <button id="fill-site" class="btn btn-primary">На сайте</button>
        <button id="fill-offline" class="btn btn-primary">Распечатать</button>
    </div>
</div>
<?php }
    else { ?>
        <div id="type-fill" class="intro__inner">
            <h1>Для того чтобы завершить тестирование нажмите кнопку <span>Завершить</span></h1>
            <div class="form-group">
                <button id="fill-site" class="btn btn-primary">Назад</button>
                <button id="fill-site" class="btn btn-primary">Завершить</button>
            </div>
        </div>
<?php }?>
<div id="chapter-two" class="newInn">
    <div class="blank-area">
        <div class="image-frame">
            <canvas width="1105" height="1560"></canvas>
        </div>
    <button id="save" class="btn btn-primary">Сохранить</button>
    </div>
</div>
<div id="chapter-one" class="newInn">
    <div class="blank-area">
        <?php
        $count = 0;
        foreach ($inputs as $input) {
            if ($input['type'] === 'answer') {
                echo "<input style='top: ".$input['input_top']."; 
            left: ".$input['input_left']."; 
            width: ".$input['input_width']."; 
            height: ".$input['input_height'].";' 
            class='hover_input' id='answer".$input['input_tooltip']."'/>";
            }
            else {
                echo "<div style='top: ".$input['input_top']."; 
            left: ".$input['input_left']."; 
            width: ".$input['input_width']."; 
            height: ".$input['input_height'].";' 
            class='hover_div'>
                <a class='hover_a' style='width: 200px'>
                <i class='far fa-question-circle'></i>".$input['input_tooltip']."</a></div>";
            }
        }
        ?>
        <div class="image-frame">
            <img src="/web/blanks/templates/<?=$blanks[0]['class_templ'] .'/'. $blanks[0]['type_test'] .'/'. $blanks[0]['type_blank'] . '/'. $blanks[0]['image_name']?>">
        </div>
        <a href="index.php?r=exam/test&id=<?=$_GET['id_v']?>" class="btn btn-primary">Назад</a>
        <a class="btn btn-primary continue">Продолжить</a>
        </br>
    </div>
</div>
</br>
<?php
$this->registerJsFile(
    '@web/js/blank.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    '@web/js/answers.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>