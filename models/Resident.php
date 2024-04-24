<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resident".
 *
 * @property string $id
 * @property string $name
 * @property int $sex 1 = Male; 2 = Female;
 * @property string $birth_date
 * @property int $province_id
 * @property int $city_id
 * @property string $address
 * @property string $created_date
 * @property string|null $updated_date
 *
 * @property City $city
 * @property Province $province
 */
class Resident extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resident';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name', 'birth_date', 'province_id', 'city_id', 'address'], 'required'],
            [['sex', 'province_id', 'city_id'], 'integer'],
            [['birth_date', 'created_date', 'updated_date'], 'safe'],
            [['address'], 'string'],
            [['id'], 'string', 'max' => 18],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['city_id' => 'id']],
            [['province_id'], 'exist', 'skipOnError' => true, 'targetClass' => Province::class, 'targetAttribute' => ['province_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'sex' => 'Sex',
            'birth_date' => 'Birth Date',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'address' => 'Address',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'city_id']);
    }

    /**
     * Gets query for [[Province]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvince()
    {
        return $this->hasOne(Province::class, ['id' => 'province_id']);
    }
}
