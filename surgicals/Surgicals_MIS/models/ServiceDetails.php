<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property int|null $warranty_period Store value in Months
 * @property string|null $warranty_type
 * @property int|null $replacement_period Store value in Days
 * @property int|null $return_period Store value in Days
 *
 * @property Products[] $products
 */
class ServiceDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id'], 'required'],
            [['warranty_period', 'replacement_period', 'return_period'], 'integer'],
            [['warranty_type'], 'string'],
            [['enc_id'], 'string', 'max' => 50],
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
            'warranty_period' => Yii::t('app', 'Warranty Period'),
            'warranty_type' => Yii::t('app', 'Warranty Type'),
            'replacement_period' => Yii::t('app', 'Replacement Period'),
            'return_period' => Yii::t('app', 'Return Period'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['service_detail_id' => 'enc_id']);
    }
}
