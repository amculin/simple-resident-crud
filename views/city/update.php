<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\City $model */

$this->title = 'Ubah Kota: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kota', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="city-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinceList' => $provinceList
    ]) ?>

</div>
