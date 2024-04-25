<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "province".
 *
 * @property int $id
 * @property string $name
 * @property string $created_date
 * @property string|null $updated_date
 *
 * @property City[] $cities
 * @property Resident[] $residents
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_date', 'updated_date'], 'safe'],
            [['name'], 'string', 'max' => 48],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::class, ['province_id' => 'id']);
    }

    /**
     * Gets query for [[Residents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResidents()
    {
        return $this->hasMany(Resident::class, ['province_id' => 'id']);
    }
}
