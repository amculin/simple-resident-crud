<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resident $model */

$this->title = 'Ubah Penduduk: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Penduduk', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="resident-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinceList' => $provinceList,
        'cityList' => $cityList
    ]) ?>

</div>
