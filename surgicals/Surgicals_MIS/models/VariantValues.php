<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%variant_values}}".
 *
 * @property int $id
 * @property int $variant_value_enc_id
 * @property string $product_variant_enc_id
 * @property string $name
 * @property int $price
 * @property int $discounted_price
 * @property int $quantity
 * @property string $created_by
 * @property string $created_on
 * @property string $status
 *
 * @property ProductVariant $productVariantEnc
 * @property User $createdBy
 */
class VariantValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%variant_values}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['variant_value_enc_id', 'product_variant_enc_id', 'name', 'price', 'discounted_price', 'quantity', 'created_by', 'status'], 'required'],
            [['variant_value_enc_id', 'price', 'discounted_price', 'quantity'], 'integer'],
            [['created_on'], 'safe'],
            [['status'], 'string'],
            [['product_variant_enc_id', 'name', 'created_by'], 'string', 'max' => 50],
            [['variant_value_enc_id'], 'unique'],
            [['product_variant_enc_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariant::className(), 'targetAttribute' => ['product_variant_enc_id' => 'product_variant_enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'variant_value_enc_id' => Yii::t('app', 'Variant Value Enc ID'),
            'product_variant_enc_id' => Yii::t('app', 'Product Variant Enc ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'discounted_price' => Yii::t('app', 'Discounted Price'),
            'quantity' => Yii::t('app', 'Quantity'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[ProductVariantEnc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariantEnc()
    {
        return $this->hasOne(ProductVariant::className(), ['product_variant_enc_id' => 'product_variant_enc_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'created_by']);
    }
}
