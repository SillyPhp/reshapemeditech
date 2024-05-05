<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%countries_main}}".
 *
 * @property int $id
 * @property string $sortname
 * @property string $name
 * @property int $phonecode
 *
 * @property States[] $states
 */
class CountriesMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries_main}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sortname', 'name', 'phonecode'], 'required'],
            [['phonecode'], 'integer'],
            [['sortname'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * Gets query for [[States]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(States::className(), ['country_id' => 'id']);
    }
}
