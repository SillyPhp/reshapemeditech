<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_variant}}".
 *
 * @property int $id
 * @property string $product_variant_enc_id
 * @property string $product_enc_id
 * @property string $name
 * @property string $created_by
 * @property string $created_on
 *
 * @property TechneyotechneyoProducts $productEnc
 * @property User $createdBy
 * @property VariantValues[] $variantValues
 */
class ProductVariant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_variant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_variant_enc_id', 'product_enc_id', 'name', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['product_variant_enc_id', 'product_enc_id', 'name', 'created_by'], 'string', 'max' => 50],
            [['product_variant_enc_id'], 'unique'],
            [['product_enc_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechneyotechneyoProducts::className(), 'targetAttribute' => ['product_enc_id' => 'product_enc_id']],
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
            'product_variant_enc_id' => Yii::t('app', 'Product Variant Enc ID'),
            'product_enc_id' => Yii::t('app', 'Product Enc ID'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * Gets query for [[ProductEnc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductEnc()
    {
        return $this->hasOne(TechneyotechneyoProducts::className(), ['product_enc_id' => 'product_enc_id']);
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

    /**
     * Gets query for [[VariantValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariantValues()
    {
        return $this->hasMany(VariantValues::className(), ['product_variant_enc_id' => 'product_variant_enc_id']);
    }
}
