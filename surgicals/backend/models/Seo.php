<?php

namespace app\models;

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
}
