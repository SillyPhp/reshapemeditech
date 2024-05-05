<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%blogs}}".
 *
 * @property int $id
 * @property string $_uid
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $short_description
 * @property string $description
 * @property string $image
 * @property string $sharing_image
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
            [['_uid', 'created_at', 'updated_at', 'name', 'short_description', 'description', 'image', 'sharing_image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['_uid'], 'string', 'max' => 36],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image', 'sharing_image'], 'string', 'max' => 50],
        ];
    }

}
