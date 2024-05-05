<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%media_files}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $file_name
 * @property string $enc_name
 * @property int $assigned_to 0 as Product, 1 as Brand, 2 as Category
 * @property string $created_on
 * @property string $created_by
 *
 * @property Brands[] $brands
 * @property ProductImages[] $productImages
 */
class MediaFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%media_files}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'file_name', 'enc_name', 'created_by'], 'required'],
            [['file_name'], 'string'],
            [['assigned_to'], 'integer'],
            [['created_on'], 'safe'],
            [['enc_id', 'enc_name', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
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
            'file_name' => Yii::t('app', 'File Name'),
            'enc_name' => Yii::t('app', 'Enc Name'),
            'assigned_to' => Yii::t('app', 'Assigned To'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[Brands]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrands()
    {
        return $this->hasMany(Brands::className(), ['media_id' => 'enc_id']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImages::className(), ['media_file_id' => 'enc_id']);
    }
}
