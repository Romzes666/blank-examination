
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
            <img src="/web/blanks/templates/<?= $blank->class_templ . "/" . $blank->type_test ."/". $blank->type_blank . "/" . $blank->image_name?>">
        </div>
    </div>
</div>

<?php
$this->registerJsFile(
    '@web/js/blank.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>
