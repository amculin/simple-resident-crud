<?php

use app\customs\FActionColumn;
use app\models\Resident;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ResidentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'List Penduduk';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resident-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-8">
            <?php echo $this->render('_search', [
                'model' => $searchModel,
                'provinceList' => $provinceList,
                'cityList' => $cityList
            ]); ?>
        </div>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => "{items}\n{pager}",
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.',
                'headerOptions' => ['style' => 'width: 5%']],
            [
                'class' => FActionColumn::className(),
                'urlCreator' => function ($action, Resident $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 5%']
            ],
            [
                'attribute' => 'name',
                'value' => function ($data) {
                    return $data->name;
                },
                'headerOptions' => ['style' => 'width: 30%']
            ],
            'id',
            [
                'attribute' => 'birth_date',
                'value' => function ($data) {
                    return date('d F Y', strtotime($data->birth_date));
                },
                'headerOptions' => ['style' => 'width: 15%']
            ],
            [
                'attribute' => 'address',
                'value' => function ($data) {
                    return $data->address . ', '. $data->city->name . ', ' . $data->province->name;
                },
                'headerOptions' => ['style' => 'width: 35%']
            ],
            [
                'attribute' => 'sex',
                'value' => function ($data) {
                    return $data->sex == $data::MALE ? 'Laki-laki' : 'Perempuan';
                },
                'headerOptions' => ['style' => 'width: 10%']
            ],
            'created_date'
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
