<?php

use app\customs\FActionColumn;
use app\models\City;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CitySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Laporan Provinsi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-province-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-8">
        <?= Html::a('Export', ['export-by-province'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-4">
            <?php echo $this->render('_search-by-province', ['model' => $searchModel]); ?>
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
                'headerOptions' => ['style' => 'width: 5%']
            ],
            [
                'label' => 'Provinsi',
                'value' => function ($data) {
                    return $data['name'];
                }
            ],
            [
                'label' => 'Banyak Penduduk',
                'value' => function ($data) {
                    return $data['jumlah'];
                },
                'headerOptions' => ['style' => 'width: 15%']
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
