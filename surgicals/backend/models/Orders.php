<?php

namespace app\models;

use common\models\OrderItem;
use common\models\User;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property int $user_id
 * @property int $status
 * @property float $sub_total
 * @property float $discount
 * @property float $grand_total
 * @property string|null $promo
 * @property string $first_name
 * @property string $last_name
 * @property string $contact
 * @property string $email
 * @property string $address1
 * @property string|null $address2
 * @property int $city foreign key to cities table
 * @property string $zip_code
 * @property string|null $notes
 * @property string $created_at
 * @property string|null $updated_at
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'user_id', 'status', 'sub_total', 'discount', 'grand_total', 'first_name', 'last_name', 'contact', 'email', 'address1', 'city', 'zip_code'], 'required'],
            [['user_id', 'status', 'city'], 'integer'],
            [['sub_total', 'discount', 'grand_total'], 'number'],
            [['notes'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['_uid'], 'string', 'max' => 36],
            [['promo', 'first_name', 'last_name', 'email'], 'string', 'max' => 50],
            [['contact'], 'string', 'max' => 15],
            [['address1', 'address2'], 'string', 'max' => 100],
            [['zip_code'], 'string', 'max' => 10],
        ];
    }
    public function getOrderItem()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => '_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    public function getCityEnc()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city']);
    }
}
