<?php
/* @var $this yii\web\View */
/* @var $blank app\models\Variant */
/* @var $inputs */
?>
<div class="slider">
    <div class="container">
        <div class="slider__inner">
            <div class="slider__item active">
                <span class="slider__num">01</span>
                Регистрация
            </div>
            <div class="slider__item">
                <span class="slider__num">02</span>
                Выполнение
            </div>
            <div class="slider__item">
                <span class="slider__num">03</span>
                Завершение
            </div>
        </div>
    </div>
</div>
<div id="image-div" class="newInn">
    <div class="blank-area">
        <?php
        foreach ($inputs as $input) {
            if ($input['type'] === 'answer') {
                echo "<input style='top: ".$input['input_top']."; 
            left: ".$input['input_left']."; 
            width: ".$input['input_width']."; 
            height: ".$input['input_height'].";' 
            class='hover_input' id='answer".$input['input_tooltip']."'/>";
            } elseif ($input['type'] === 'help') {
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
            <img src="<?= $path ?>">
        </div>
    </div>
</div>
</br>
<a href="index.php?r=exam/test&id=<?=$_GET['id_sb']?>" class="btn btn-primary">Продолжить</a>

<?php
$this->registerJsFile(
    '@web/js/blank.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
