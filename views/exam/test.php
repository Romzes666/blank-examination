<?php
/* @var $this yii\web\View */
/* @var $variant app\models\Variant */
$this->title = 'Тестирование';
?>
<div class="slider">
    <div class="container">
        <div class="slider__inner">
            <div class="slider__item">
                <span class="slider__num">01</span>
                Регистрация
            </div>
            <div class="slider__item active">
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
<div>
    <div class="intro__inner" style="max-width: 1500px">
        <?php $count_pages = 0;
        for ($i = 0; $i < $variant->count_list; $i++) {
            $count_pages++; ?>
            <img id="<?=$count_pages?>" class="blank-viewer__img" src="/web/upload/variant/<?=$variant->number?>/task<?=$count_pages?>.jpg">
        <?php } ?>
    </div>
    <br>
    <div class="gradB" style="justify-content: center; flex-direction: row">
        <button style="padding: 0px; width: 50px; height: 50px; text-align: center" class="btn active">1</button>
        <p style="margin: 20px"></p>
        <?php
        $count_pages = 1;
        for ($i = 1; $i < $variant->count_list; $i++) {
            $count_pages++; ?>
            <button style="padding: 0px; width: 50px; height: 50px; text-align: center" class="btn"><?=$count_pages?></button>
            <p style="margin: 20px"></p>
        <?php } ?>
        <a href="index.php?r=exam/answers&id=<?=$variant->id_subject?>&id_v=<?=$variant->id?>" class="btn btn-primary" id="end_exam">Завершить</a>
    </div>
    <p style="margin-top: 30px"></p>
</div>
<?php
$this->registerJsFile(
    '@web/js/test.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>