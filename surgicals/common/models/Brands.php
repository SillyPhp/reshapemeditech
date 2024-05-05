<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%brands}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $name
 * @property int $sequence
 * @property string $image_enc_name
 * @property string $image_name
 * @property int $is_deleted 0 as false, 1 as true
 * @property int $is_popular
 */
class Brands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%brands}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'name', 'image_enc_name', 'image_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['sequence', 'is_deleted', 'is_popular'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 100],
            [['image_enc_name', 'image_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('common', 'Id'),
            '_uid' => Yii::t('common', 'Uid'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'name' => Yii::t('common', 'Name'),
            'sequence' => Yii::t('common', 'Sequence'),
            'image_enc_name' => Yii::t('common', 'Image Enc Name'),
            'image_name' => Yii::t('common', 'Image Name'),
            'is_deleted' => Yii::t('common', 'Is Deleted'),
            'is_popular' => Yii::t('common', 'Is Popular'),
        ];
    }
}
