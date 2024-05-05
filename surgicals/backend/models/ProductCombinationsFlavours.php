<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_combinations_flavours}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property int $product_combination_id
 * @property int $flavour_id
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $is_deleted 0 as false, 1 as true
 * @property float $price add price on price
 */
class ProductCombinationsFlavours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_combinations_flavours}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'product_combination_id', 'flavour_id', 'price'], 'required'],
            [['product_combination_id', 'flavour_id', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['price'], 'number'],
            [['_uid'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'Id'),
            '_uid' => Yii::t('app', 'Uid'),
            'product_combination_id' => Yii::t('app', 'Product Combination ID'),
            'flavour_id' => Yii::t('app', 'Flavour ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'price' => Yii::t('app', 'Price'),
        ];
    }

    /**
     * Gets query for [[Products Combinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinations()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_combination_id']);
    }


    /**
     * Gets query for [[Flavours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlavours()
    {
        return $this->hasOne(Flavours::className(), ['_id' => 'flavour_id']);
    }
}
