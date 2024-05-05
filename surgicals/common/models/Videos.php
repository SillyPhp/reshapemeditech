<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%videos}}".
 *
 * @property int $id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $title
 * @property string $video
 * @property int $is_deleted 0 as false, 1 as True
 */
class Videos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'title', 'video'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 100],
            [['video'], 'string', 'max' => 50],
        ];
    }
}
