<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resident $model */

$this->title = 'Tambah Penduduk';
$this->params['breadcrumbs'][] = ['label' => 'Penduduk', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Form Penduduk';
?>
<div class="resident-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinceList' => $provinceList,
        'cityList' => $cityList
    ]) ?>

</div>
