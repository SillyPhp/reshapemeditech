<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "assigned_sensors".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property string $sensor_id
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted 0 as false, 1 as true
 *
 * @property Products $product
 * @property Sensors $sensor
 * @property User $createdBy
 * @property User $updatedBy
 */
class AssignedSensors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_sensors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'sensor_id', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_deleted'], 'integer'],
            [['enc_id', 'product_id', 'sensor_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
            [['sensor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sensors::className(), 'targetAttribute' => ['sensor_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'sensor_id' => Yii::t('app', 'Sensor ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['enc_id' => 'product_id']);
    }

    /**
     * Gets query for [[Sensor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSensor()
    {
        return $this->hasOne(Sensors::className(), ['enc_id' => 'sensor_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'updated_by']);
    }
}
