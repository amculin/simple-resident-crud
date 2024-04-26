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
    const MALE = 1;
    const FEMALE = 2;

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
            'id' => 'NIK',
            'name' => 'Nama',
            'sex' => 'Jenis Kelamin',
            'birth_date' => 'Tanggal Lahir',
            'province_id' => 'Provinsi',
            'city_id' => 'Kota',
            'address' => 'Alamat',
            'created_date' => 'Timestamp',
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

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (! $this->isNewRecord) {
                $this->updated_date = date('Y-m-d H:i:s');
            }
        }

        return true;
    }
}
