<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%stocks}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $variant_id
 * @property string $colour_id
 * @property string|null $vendor_id
 * @property int|null $price
 * @property int|null $sale_price
 * @property int|null $qty
 * @property string $created_by
 * @property string $created_on
 * @property int $status 0 as Pending, 1 as Approved
 *
 * @property Variants $variant
 * @property Colours $colour
 * @property Vendors $vendor
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stocks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'variant_id', 'colour_id', 'created_by'], 'required'],
            [['price', 'sale_price', 'qty', 'status'], 'integer'],
            [['created_on'], 'safe'],
            [['enc_id', 'variant_id', 'colour_id', 'vendor_id', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['variant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Variants::className(), 'targetAttribute' => ['variant_id' => 'enc_id']],
            [['colour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colours::className(), 'targetAttribute' => ['colour_id' => 'enc_id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::className(), 'targetAttribute' => ['vendor_id' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enc_id' => Yii::t('app', 'Enc ID'),
            'variant_id' => Yii::t('app', 'Variant ID'),
            'colour_id' => Yii::t('app', 'Colour ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'price' => Yii::t('app', 'Price'),
            'sale_price' => Yii::t('app', 'Sale Price'),
            'qty' => Yii::t('app', 'Qty'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Variant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariant()
    {
        return $this->hasOne(Variants::className(), ['enc_id' => 'variant_id']);
    }

    /**
     * Gets query for [[Colour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColour()
    {
        return $this->hasOne(Colours::className(), ['enc_id' => 'colour_id']);
    }

    /**
     * Gets query for [[Vendor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendors::className(), ['enc_id' => 'vendor_id']);
    }
}
