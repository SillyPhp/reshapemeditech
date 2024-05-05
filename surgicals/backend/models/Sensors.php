<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sensors".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $created_on
 * @property string $created_by
 *
 * @property AssignedSensors[] $assignedSensors
 */
class Sensors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sensors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'name', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['enc_id', 'created_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['enc_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enc_id' => Yii::t('app', 'Enc ID'),
            'name' => Yii::t('app', 'Name'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[AssignedSensors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedSensors()
    {
        return $this->hasMany(AssignedSensors::className(), ['sensor_id' => 'enc_id']);
    }
}
