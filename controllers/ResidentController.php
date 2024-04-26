<?php

namespace app\controllers;

use app\models\CitySearch;
use app\models\ProvinceSearch;
use app\models\Resident;
use app\models\ResidentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResidentController implements the CRUD actions for Resident model.
 */
class ResidentController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Resident models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ResidentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $provinceList = ProvinceSearch::getList();

        if ($searchModel->province_id) {
            $cityList = CitySearch::getList($searchModel->province_id);
        } else {
            $cityList = [];
        }

        return $this->render('index', [
            'provinceList' => $provinceList,
            'cityList' => $cityList,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Resident model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Resident();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $provinceList = ProvinceSearch::getList();

        return $this->render('create', [
            'model' => $model,
            'provinceList' => $provinceList,
            'cityList' => []
        ]);
    }

    /**
     * Updates an existing Resident model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $provinceList = ProvinceSearch::getList();
        $cityList = CitySearch::getList($model->province_id);

        return $this->render('update', [
            'model' => $model,
            'provinceList' => $provinceList,
            'cityList' => $cityList
        ]);
    }

    /**
     * Deletes an existing Resident model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resident model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Resident the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resident::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
