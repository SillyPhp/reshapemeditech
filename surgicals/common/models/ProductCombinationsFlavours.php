<?php

namespace common\models;

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
 *
 * @property Flavours $flavour
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
            [['flavour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flavours::className(), 'targetAttribute' => ['flavour_id' => '_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('common', 'Id'),
            '_uid' => Yii::t('common', 'Uid'),
            'product_combination_id' => Yii::t('common', 'Product Combination ID'),
            'flavour_id' => Yii::t('common', 'Flavour ID'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'is_deleted' => Yii::t('common', 'Is Deleted'),
            'price' => Yii::t('common', 'Price'),
        ];
    }

    /**
     * Gets query for [[Flavour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFlavours()
    {
        return $this->hasOne(Flavours::className(), ['_id' => 'flavour_id']);
    }

    /**
     * Gets query for [[ProductCombination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinations()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_combination_id']);
    }
}
