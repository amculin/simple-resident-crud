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

$this->title = 'Kota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-6">
            <?php echo $this->render('_search', ['model' => $searchModel, 'provinceList' => $provinceList]); ?>
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
            'name',
            [
                'attribute' => 'province_id',
                'value' => function ($data) {
                    return $data->province->name;
                }
            ],
            [
                'class' => FActionColumn::className(),
                'urlCreator' => function ($action, City $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 7%']
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
