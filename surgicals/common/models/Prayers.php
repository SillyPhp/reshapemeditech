<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%prayers}}".
 *
 * @property int $id
 * @property string $uid
 * @property string $created_at
 * @property string $title
 * @property string $description
 * @property int $is_deleted 0 false,  1True
 */
class Prayers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%prayers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'title', 'description'], 'required'],
            [['created_at'], 'safe'],
            [['description'], 'string'],
            [['is_deleted'], 'integer'],
            [['uid', 'title'], 'string', 'max' => 100],
        ];
    }

}
