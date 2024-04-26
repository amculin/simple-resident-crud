<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Resident $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resident-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sex')->radioList([
        1 => 'Laki-laki',
        2 => 'Perempuan'
    ]) ?>

    <?= $form->field($model, 'birth_date')->widget(\yii\jui\DatePicker::className(), [
        'options' => [
            'class' => 'form-control',
        ],
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'changeYear' => true,
            'changeMonth' => true,
            'yearRange' => '1900:' . date('Y'),
            'maxDate' => 0
        ]
    ]) ?>

    <?= $form->field($model, 'province_id')->dropDownList($provinceList, [
        'prompt' => 'Pilih Provinsi',
        'onchange' => '
            $.post("'.Yii::$app->urlManager->createUrl('city/get-list?id=').'"+$(this).val(), function(data) {
                $("select#resident-city_id").html(data);
            });
        ']) ?>

    <?= $form->field($model, 'city_id')->dropDownList($cityList, ['prompt' => 'Pilih Kota']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 3]) ?>

    <div class="form-group">
        <?= Html::button('Batal', ['class' => 'btn btn-info', 'type' => 'reset']) ?>&nbsp;&nbsp;
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
