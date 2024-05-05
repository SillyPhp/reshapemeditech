<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_images}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property string $media_file_id
 * @property string $colour_id
 * @property string $created_on
 * @property string $created_by
 * @property int $status 0 as Pending, 1 as Approved, 2 as Rejected
 * @property int $is_deleted
 *
 * @property MediaFiles $mediaFile
 * @property Colours $colour
 * @property Products $product
 */
class ProductImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_images}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'media_file_id', 'colour_id', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['status', 'is_deleted'], 'integer'],
            [['enc_id', 'product_id', 'media_file_id', 'colour_id', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['media_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => MediaFiles::className(), 'targetAttribute' => ['media_file_id' => 'enc_id']],
            [['colour_id'], 'exist', 'skipOnError' => true, 'targetClass' => Colours::className(), 'targetAttribute' => ['colour_id' => 'enc_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'media_file_id' => Yii::t('app', 'Media File ID'),
            'colour_id' => Yii::t('app', 'Colour ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[MediaFile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMediaFile()
    {
        return $this->hasOne(MediaFiles::className(), ['enc_id' => 'media_file_id']);
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['enc_id' => 'product_id']);
    }
}
