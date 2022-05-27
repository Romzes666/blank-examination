<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TemplateBlank */
$this->title = $model->name_subject ." ". $model->blank_type;
?>

<form class="container-fluid constructor d-flex justify-content-between" method="post" id="form-template">
    <div class="form-area mr-3">
        <span id="message"></span>
        <div class="form-area-inner">
            <div class="elements">
                <div class="form-group">
                    <div class="row d-flex justify-content-center mt-2">
                        <h3 class="text-center text-white">Элементы</h3>
                    </div>
                    <div class="row d-flex justify-content-between ml-1 mr-1 mt-3">
                        <div class="col-lg-4 text-center">
                            <button id="addInput" type="button" class="btn-primary elem-btn-lg mb-3">
                                Добавить input
                            </button>
                        </div>
                        <div class="col-lg-4 text-center">
                            <button id="deleteInput" type="button" class="btn-primary elem-btn-lg">
                                Удалить input
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sizing">
                <div class="form-group">
                    <div class="row d-flex justify-content-center mt-2">
                        <h3 class="text-center text-white">Размер</h3>
                    </div>
                    <div class="row d-flex flex-column align-items-center mt-3">
                        <div class="row row-range d-flex flex-column text-center mb-3">
                            <label for="widthRange" class="form-label text-white">Ширина:</label>
                            <div class="s-range row ml-3 mr-3">
                                <div class="col-12">
                                    <input type="range" min="10" max="425" value="300" class="form-range"
                                           id="widthRange" oninput="widthInput.value = widthRange.value">
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <input class="text-center form-control" type="number" autocomplete="off"
                                           placeholder="50 - 600" id="widthInput"
                                           oninput="widthRange.value = widthInput.value">
                                </div>
                            </div>
                        </div>
                        <div class="row row-range d-flex flex-column text-center mb-3">
                            <label for="heightRange" class="form-label text-white">Высота:</label>
                            <div class="s-range row ml-3 mr-3">
                                <div class="col-12">
                                    <input type="range" min="10" max="200" value="30" class="form-range"
                                           id="heightRange" oninput="heightInput.value = heightRange.value">
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <input class="text-center form-control" type="number" autocomplete="off"
                                           placeholder="20 - 200" id="heightInput"
                                           oninput="heightRange.value = heightInput.value">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hint">
                <div class="form-group">
                    <div class="row d-flex justify-content-center mt-2">
                        <h3 class="text-center text-white">Подсказка</h3>
                    </div>
                    <div class="row row-cols-1 d-flex justify-content-center mt-2 ml-3 mr-3">
                        <textarea id="hint" class="form-control col-12" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="saving mb-3 mt-4">
                <div class="row d-flex justify-content-center">
                    <input type="hidden" id="blank_id" name="blank_id" value="<?= $model->id ?>" />
                    <button style="z-index: 1000" type="submit" class="btn btn-primary" id="constructor-save">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    <div class="blank-area">
        <div class="image-frame">
            <img src="/web/blanks/templates/<?=
            $model->number_class.'/'.$model->type_test.'/'.$model->name_subject.'/'.$model->blank_type.'/'.$model->image_name
            ?>">
        </div>
    </div>
</form>
<?php
$this->registerJsFile(
    '@web/js/constructor.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
?>