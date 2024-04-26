<?php

namespace app\models;

use Yii;
use app\models\City;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * CitySearch represents the model behind the search form of `app\models\City`.
 */
class CitySearch extends City
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['province_id'], 'integer'],
            [['name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = City::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere(['province_id' => $this->province_id]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }

    public static function getList($provinceID)
    {
        $sql = "SELECT id, name FROM city WHERE province_id = :province_id ORDER BY name ASC";

        $data = Yii::$app->db->createCommand($sql, [':province_id' => $provinceID])->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }
}
