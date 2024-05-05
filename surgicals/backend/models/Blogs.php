<?php

namespace backend\models;

/**
 * This is the model class for table "{{%blogs}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string|null $sharing_image
 * @property int $is_deleted
 */
class Blogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%blogs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'name', 'short_description', 'description', 'image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image', 'sharing_image'], 'string', 'max' => 50],
            [['_uid'], 'unique'],
        ];
    }
}
