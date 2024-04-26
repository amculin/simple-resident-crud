<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CitySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="city-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'province_id')->dropDownList($provinceList, ['prompt' => 'Pilih Provinsi'])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Cari Kota'])->label(false) ?>
        </div>
    </div>

    <div class="form-group" style="display: none">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
