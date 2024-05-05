<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_combinations}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property int $products__id
 * @property string $product_id
 * @property string|null $title
 * @property float|null $price Purchase price
 * @property float|null $sale_price
 *
 * @property Barcodes[] $barcodes
 * @property ProductCombinationMedia[] $productCombinationMedia
 * @property Products $products
 * @property ProductCombinationsOptions[] $productCombinationsOptions
 * @property StockTransactions[] $stockTransactions
 */
class ProductCombinations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_combinations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'products__id', 'product_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'products__id'], 'integer'],
            [['price', 'sale_price'], 'number'],
            [['_uid'], 'string', 'max' => 36],
            [['product_id'], 'string', 'max' => 45],
            [['title'], 'string', 'max' => 150],
            [['_uid'], 'unique'],
            [['products__id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['products__id' => '_id']],
        ];
    }

    /**
     * Gets query for [[Barcodes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarcodes()
    {
        return $this->hasMany(Barcodes::className(), ['product_combinations__id' => '_id']);
    }

    /**
     * Gets query for [[ProductCombinationMedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinationMedia()
    {
        return $this->hasMany(ProductCombinationMedia::className(), ['product_combination__id' => '_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasOne(Products::className(), ['_id' => 'products__id']);
    }

    /**
     * Gets query for [[ProductCombinationsOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinationsOptions()
    {
        return $this->hasMany(ProductCombinationsOptions::className(), ['product_combinations__id' => '_id']);
    }

    /**
     * Gets query for [[StockTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransactions()
    {
        return $this->hasMany(StockTransactions::className(), ['product_combinations__id' => '_id']);
    }


    public function getProductCombinationsFlavours()
    {
        return $this->hasMany(ProductCombinationsFlavours::className(), ['product_combination_id' => '_id']);
    }
}
