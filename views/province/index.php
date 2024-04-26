<?php

use app\customs\FActionColumn;
use app\models\Province;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ProvinceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Provinsi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= Html::a('Tambah', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-lg-4">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                'class' => FActionColumn::className(),
                'urlCreator' => function ($action, Province $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'headerOptions' => ['style' => 'width: 7%']
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
