<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%subscribers}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $email
 * @property string $created_at
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%subscribers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'email'], 'required'],
            [['created_at'], 'safe'],
            [['_uid'], 'string', 'max' => 36],
            [['email'], 'string', 'max' => 50],
        ];
    }

}
