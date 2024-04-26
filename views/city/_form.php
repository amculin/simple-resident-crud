<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\City $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="city-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'province_id')->dropDownList($provinceList, ['prompt' => 'Pilih Provinsi']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::button('Batal', ['class' => 'btn btn-info', 'type' => 'reset']) ?>&nbsp;&nbsp;
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
