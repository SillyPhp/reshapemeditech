<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_option_values}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property int $product_option_labels__id
 * @property string $name
 * @property int|null $user_authorities__id
 *
 * @property ProductCombinationsOptions[] $productCombinationsOptions
 * @property ProductOptionLabels $productOptionLabels
 * @property UserAuthorities $userAuthorities
 */
class ProductOptionValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_option_values}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'product_option_labels__id', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'product_option_labels__id', 'user_authorities__id'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 150],
            [['_uid'], 'unique'],
            [['product_option_labels__id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOptionLabels::className(), 'targetAttribute' => ['product_option_labels__id' => '_id']],
            [['user_authorities__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAuthorities::className(), 'targetAttribute' => ['user_authorities__id' => '_id']],
        ];
    }

    /**
     * Gets query for [[ProductCombinationsOptions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinationsOptions()
    {
        return $this->hasMany(ProductCombinationsOptions::className(), ['product_option_values__id' => '_id']);
    }

    /**
     * Gets query for [[ProductOptionLabels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionLabels()
    {
        return $this->hasOne(ProductOptionLabels::className(), ['_id' => 'product_option_labels__id']);
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
}
