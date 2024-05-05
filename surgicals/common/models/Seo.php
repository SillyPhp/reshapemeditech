<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%seo}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $route
 * @property string $title
 * @property string $keywords
 * @property string $description
 * @property string|null $image_enc_name
 * @property string|null $image_name
 * @property int $is_deleted 0 as false , 1 as True
 * @property string $created_at
 * @property string|null $updated_at
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%seo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'route', 'title', 'keywords', 'description'], 'required'],
            [['description'], 'string'],
            [['is_deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['_uid'], 'string', 'max' => 30],
            [['route', 'title', 'keywords'], 'string', 'max' => 100],
            [['image_enc_name', 'image_name'], 'string', 'max' => 50],
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
            'route' => Yii::t('app', 'Route'),
            'title' => Yii::t('app', 'Title'),
            'keywords' => Yii::t('app', 'Keywords'),
            'description' => Yii::t('app', 'Description'),
            'image_enc_name' => Yii::t('app', 'Image Enc Name'),
            'image_name' => Yii::t('app', 'Image Name'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
