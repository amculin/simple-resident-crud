<?php

namespace app\controllers;

use app\models\ResidentSearch;
use app\models\ProvinceSearch;

class ReportController extends \yii\web\Controller
{
    public function actionByCity($export = null)
    {
        $searchModel = new ResidentSearch();
        $dataProvider = $searchModel->reportByCity($this->request->queryParams,
            is_null($export) ? false : true);
        $provinceList = ProvinceSearch::getList();

        if ($export != null) {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=export-by-city.xls");

            return $this->renderPartial('_export-by-city', [
                'model' => $dataProvider->getModels()
            ]);
        } else {
            return $this->render('by-city', [
                'searchModel' => $searchModel,
                'provinceList' => $provinceList,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    public function actionByProvince($export = null)
    {
        $searchModel = new ResidentSearch();
        $dataProvider = $searchModel->reportByProvince($this->request->queryParams,
            is_null($export) ? false : true);

        if ($export != null) {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=export-by-province.xls");

            return $this->renderPartial('_export-by-province', [
                'model' => $dataProvider->getModels()
            ]);
        } else {
            return $this->render('by-province', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
}
