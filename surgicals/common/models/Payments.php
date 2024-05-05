<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%payments}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string|null $order_id
 * @property float $payment_amount
 * @property float|null $payment_gst
 * @property string|null $payment_id
 * @property string|null $payment_status
 * @property string|null $payment_signature
 * @property string|null $reason
 * @property string $product_order_id Product Order Id
 * @property string $created_on
 * @property string|null $updated_on
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%payments}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'payment_amount','product_order_id'], 'required'],
            [['payment_amount', 'payment_gst'], 'number'],
            [['reason'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['_uid','product_order_id'], 'string', 'max' => 36],
            [['order_id', 'payment_id', 'payment_status'], 'string', 'max' => 100],
            [['payment_signature'], 'string', 'max' => 255],
        ];
    }
    public function getOrders()
    {
        return $this->hasOne(Orders::className(), ['_uid' => 'product_order_id']);
    }
}
