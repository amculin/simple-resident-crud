<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ResidentSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="resident-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'province_id')->dropDownList($provinceList, [
                'prompt' => 'Pilih Provinsi',
                'onchange' => '
                    $.post("'.Yii::$app->urlManager->createUrl('city/get-list?id=').'"+$(this).val(), function(data) {
                        $("select#residentsearch-city_id").html(data);
                    });
                '])->label(false) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'city_id')->dropDownList($cityList, ['prompt' => 'Pilih Kota'])->label(false) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'search')->textInput(['placeholder' => 'Cari Nama'])->label(false) ?>
        </div>
</div>

    <div class="form-group" style="display: none;">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
