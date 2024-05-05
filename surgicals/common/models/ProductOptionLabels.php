<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_option_labels}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string $name
 * @property int $type
 * @property int $products__id
 * @property int|null $user_authorities__id
 *
 * @property Products $products
 * @property UserAuthorities $userAuthorities
 * @property ProductOptionValues[] $productOptionValues
 */
class ProductOptionLabels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_option_labels}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'name', 'type', 'products__id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'type', 'products__id', 'user_authorities__id'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 150],
            [['_uid'], 'unique'],
            [['products__id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['products__id' => '_id']],
            [['user_authorities__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAuthorities::className(), 'targetAttribute' => ['user_authorities__id' => '_id']],
        ];
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
     * Gets query for [[UserAuthorities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthorities()
    {
        return $this->hasOne(UserAuthorities::className(), ['_id' => 'user_authorities__id']);
    }

    /**
     * Gets query for [[ProductOptionValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionValues()
    {
        return $this->hasMany(ProductOptionValues::className(), ['product_option_labels__id' => '_id']);
    }
}
