<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%product_combinations_options}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string|null $eo_uid
 * @property int $product_option_values__id
 * @property int $product_combinations__id
 *
 * @property ProductCombinations $productCombinations
 * @property ProductOptionValues $productOptionValues
 */
class ProductCombinationsOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_combinations_options}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'product_option_values__id', 'product_combinations__id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'product_option_values__id', 'product_combinations__id'], 'integer'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['_uid'], 'unique'],
            [['product_combinations__id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCombinations::className(), 'targetAttribute' => ['product_combinations__id' => '_id']],
            [['product_option_values__id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductOptionValues::className(), 'targetAttribute' => ['product_option_values__id' => '_id']],
        ];
    }

    /**
     * Gets query for [[ProductCombinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinations()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_combinations__id']);
    }

    /**
     * Gets query for [[ProductOptionValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionValues()
    {
        return $this->hasOne(ProductOptionValues::className(), ['_id' => 'product_option_values__id']);
    }
}
