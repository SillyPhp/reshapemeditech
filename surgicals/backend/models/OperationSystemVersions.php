<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "operation_system_versions".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $value
 * @property int|null $api_level
 * @property string $assigned_to
 * @property string $created_on
 * @property string $created_by
 *
 * @property TechnicalDetails[] $technicalDetails
 */
class OperationSystemVersions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'operation_system_versions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'name', 'value', 'assigned_to', 'created_by'], 'required'],
            [['api_level'], 'integer'],
            [['assigned_to'], 'string'],
            [['created_on'], 'safe'],
            [['enc_id', 'created_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 10],
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
            'value' => Yii::t('app', 'Value'),
            'api_level' => Yii::t('app', 'Api Level'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[TechnicalDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTechnicalDetails()
    {
        return $this->hasMany(TechnicalDetails::className(), ['os_version_id' => 'enc_id']);
    }
}
