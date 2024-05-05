<?php

namespace app\models;

/**
 * This is the model class for table "{{%services}}".
 *
 * @property int $id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string|null $parent_enc_id
 * @property string $name
 * @property string $short_description
 * @property string|null $description
 * @property string $image
 * @property int $is_most_service 0 as no , 1 as yes
 * @property int $is_deleted 0 as false , 1 as True
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%services}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'name', 'short_description', 'image'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['is_most_service', 'is_deleted'], 'integer'],
            [['_uid','parent_enc_id'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 100],
            [['short_description'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 50],
        ];
    }
}
