<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_combination_media}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $file_enc_name
 * @property string $file_name
 * @property int $product_combination__id
 * @property int $is_cover_image 0 as false, 1 as true
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $is_deleted
 *
 * @property ProductCombinations $productCombination
 */
class ProductCombinationMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_combination_media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'file_enc_name', 'file_name', 'product_combination__id', 'created_at'], 'required'],
            [['file_name'], 'string'],
            [['product_combination__id', 'is_cover_image', 'is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['_uid'], 'string', 'max' => 36],
            [['file_enc_name'], 'string', 'max' => 45],
            [['_uid'], 'unique'],
            [['product_combination__id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCombinations::className(), 'targetAttribute' => ['product_combination__id' => '_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'Id'),
            '_uid' => Yii::t('app', 'Uid'),
            'file_enc_name' => Yii::t('app', 'File Enc Name'),
            'file_name' => Yii::t('app', 'File Name'),
            'product_combination__id' => Yii::t('app', 'Product Combination ID'),
            'is_cover_image' => Yii::t('app', 'Is Cover Image'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[ProductCombination]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombination()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_combination__id']);
    }
}
