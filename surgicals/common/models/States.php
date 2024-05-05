<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%states}}".
 *
 * @property int $id
 * @property string $name
 * @property int $country_id
 *
 * @property Cities[] $cities
 * @property CountriesMain $country
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%states}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => CountriesMain::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }


    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['state_id' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(CountriesMain::className(), ['id' => 'country_id']);
    }
}
