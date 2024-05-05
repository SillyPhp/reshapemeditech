<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_variants".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property float $price
 * @property float|null $sale_price
 * @property int $ram RAM store as GB
 * @property int $rom ROM store as GB
 * @property int $is_deleted
 *
 * @property Products $product
 */
class ProductVariants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_variants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'price', 'ram', 'rom'], 'required'],
            [['price', 'sale_price'], 'number'],
            [['ram', 'rom', 'is_deleted'], 'integer'],
            [['enc_id', 'product_id'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
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
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'ram' => Yii::t('app', 'Ram'),
            'rom' => Yii::t('app', 'Rom'),
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
}
