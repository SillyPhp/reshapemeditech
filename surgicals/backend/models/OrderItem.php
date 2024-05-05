<?php

namespace app\models;

/**
 * This is the model class for table "{{%order_item}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property int $product_id
 * @property int $order_id
 * @property float $price
 * @property float $discount
 * @property float $tax_amount
 * @property int $quantity
 * @property string $created_at
 * @property string $updated_at
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'product_id', 'order_id', 'price', 'discount', 'tax_amount', 'quantity'], 'required'],
            [['product_id', 'order_id', 'quantity'], 'integer'],
            [['price', 'discount', 'tax_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['_uid'], 'string', 'max' => 36],
        ];
    }
    public function getProductCombinations()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_id']);
    }
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['_id' => 'order_id']);
    }

}
