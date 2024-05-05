<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_detail}}".
 *
 * @property int $id
 * @property string $product_detail_enc_id
 * @property string $product_enc_id
 * @property int|null $quantity
 * @property int|null $price
 * @property int|null $descounted_price
 * @property int $had_variaties 0 false,1 true
 * @property string $created_by
 * @property string $created_on
 * @property string $status
 *
 * @property TechneyotechneyoProducts $productEnc
 * @property User $createdBy
 */
class ProductDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_detail}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_detail_enc_id', 'product_enc_id', 'created_by', 'status'], 'required'],
            [['quantity', 'price', 'descounted_price', 'had_variaties'], 'integer'],
            [['created_on'], 'safe'],
            [['status'], 'string'],
            [['product_detail_enc_id', 'product_enc_id', 'created_by'], 'string', 'max' => 50],
            [['product_detail_enc_id'], 'unique'],
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
            'product_detail_enc_id' => Yii::t('app', 'Product Detail Enc ID'),
            'product_enc_id' => Yii::t('app', 'Product Enc ID'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'descounted_price' => Yii::t('app', 'Descounted Price'),
            'had_variaties' => Yii::t('app', 'Had Variaties'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
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
}
