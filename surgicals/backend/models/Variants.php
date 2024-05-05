<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%variants}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property string $variant_id
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted
 *
 * @property Stocks[] $stocks
 * @property PoolVariants $variant
 * @property Products $product
 */
class Variants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%variants}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'variant_id', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_deleted'], 'integer'],
            [['enc_id', 'product_id', 'variant_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => PoolVariants::className(), 'targetAttribute' => ['variant_id' => 'enc_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
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
            'variant_id' => Yii::t('app', 'Variant ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['variant_id' => 'enc_id']);
    }

    /**
     * Gets query for [[Variant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(PoolVariants::className(), ['enc_id' => 'variant_id']);
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
}
