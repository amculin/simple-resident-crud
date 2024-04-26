<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use app\models\Resident;

/**
 * ResidentSearch represents the model behind the search form of `app\models\Resident`.
 */
class ResidentSearch extends Resident
{
    public $search;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'province_id', 'city_id', 'search'], 'safe']
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
        $query = Resident::find();

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

        // Search by NIK
        if (is_numeric($this->search)) {
            $searchAttribute = 'id';
        } else { // Search by name
            $searchAttribute = 'name';
        }

        $query->andFilterWhere(['province_id' => $this->province_id]);
        $query->andFilterWhere(['city_id' => $this->city_id]);
        $query->andFilterWhere(['like', $searchAttribute, $this->search]);

        return $dataProvider;
    }

    public function reportByProvince($params)
    {
        $where = '';
        $bound = [];

        $this->load($params);

        if ($this->name) {
            $where .= ' WHERE p.name LIKE :name';
            $bound[':name'] = "%{$this->name}%";
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM province p' . $where, $bound)->queryScalar();
        $sql = "SELECT p.name, (SELECT COUNT(*) FROM resident r WHERE r.province_id = p.id) AS jumlah
            FROM province p{$where} ORDER BY name ASC";

        $provider = new SqlDataProvider([
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // returns an array of data rows
        return $provider;//->getModels();
    }
}
