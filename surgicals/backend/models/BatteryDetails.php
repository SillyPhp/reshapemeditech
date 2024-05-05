<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "battery_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $type
 * @property int $size Store value as mAh, show as 4300 mAh, Battery
 * @property string $quality
 * @property int $has_fast_charge 0 as false, 1 as true
 * @property string|null $charge_type_id
 *
 * @property ChargeTypes $chargeType
 * @property Products[] $products
 */
class BatteryDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'battery_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'type', 'size', 'quality', 'has_fast_charge'], 'required'],
            [['type', 'quality'], 'string'],
            [['size', 'has_fast_charge'], 'integer'],
            [['enc_id', 'charge_type_id'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['charge_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ChargeTypes::className(), 'targetAttribute' => ['charge_type_id' => 'enc_id']],
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
            'type' => Yii::t('app', 'Type'),
            'size' => Yii::t('app', 'Size'),
            'quality' => Yii::t('app', 'Quality'),
            'has_fast_charge' => Yii::t('app', 'Has Fast Charge'),
            'charge_type_id' => Yii::t('app', 'Charge Type ID'),
        ];
    }

    /**
     * Gets query for [[ChargeType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChargeType()
    {
        return $this->hasOne(ChargeTypes::className(), ['enc_id' => 'charge_type_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['battery_detail_id' => 'enc_id']);
    }
}
