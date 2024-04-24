<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Resident $model */

$this->title = 'Create Resident';
$this->params['breadcrumbs'][] = ['label' => 'Residents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resident-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
