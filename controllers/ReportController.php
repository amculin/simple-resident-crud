<?php

namespace app\controllers;

use app\models\ResidentSearch;
use app\models\ProvinceSearch;

class ReportController extends \yii\web\Controller
{
    public function actionByCity()
    {
        $searchModel = new ResidentSearch();
        $dataProvider = $searchModel->reportByCity($this->request->queryParams);
        $provinceList = ProvinceSearch::getList();

        return $this->render('by-city', [
            'searchModel' => $searchModel,
            'provinceList' => $provinceList,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionByProvince()
    {
        $searchModel = new ResidentSearch();
        $dataProvider = $searchModel->reportByProvince($this->request->queryParams);

        return $this->render('by-province', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
