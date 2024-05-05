<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "design_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property float $dimension_height Height x Width x Depth mm
 * @property float $dimension_widht Height x Width x Depth mm
 * @property float $dimensions_depth Height x Width x Depth mm
 * @property string|null $weight save weight with measurement like (gm | kg )
 *
 * @property Products[] $products
 * @property Products[] $products0
 */
class DesignDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'design_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'dimension_height', 'dimension_widht', 'dimensions_depth'], 'required'],
            [['dimension_height', 'dimension_widht', 'dimensions_depth'], 'number'],
            [['enc_id'], 'string', 'max' => 50],
            [['weight'], 'string', 'max' => 100],
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
            'dimension_height' => Yii::t('app', 'Dimension Height'),
            'dimension_widht' => Yii::t('app', 'Dimension Widht'),
            'dimensions_depth' => Yii::t('app', 'Dimensions Depth'),
            'weight' => Yii::t('app', 'Weight'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['design_detail_id' => 'enc_id']);
    }

    /**
     * Gets query for [[Products0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts0()
    {
        return $this->hasMany(Products::className(), ['display_detail_id' => 'enc_id']);
    }
}
