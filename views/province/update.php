<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Province $model */

$this->title = 'Ubah Provinsi: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Provinsi', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="province-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
