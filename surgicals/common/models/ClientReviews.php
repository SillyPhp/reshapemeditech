<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%client_reviews}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $name
 * @property string $designation
 * @property string $description
 * @property string $image
 * @property int $is_deleted 0 false , 1 True
 */
class ClientReviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%client_reviews}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'name', 'designation', 'description', 'image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['name', 'designation', 'image'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 255],
        ];
    }

}
