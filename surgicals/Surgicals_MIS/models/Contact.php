<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contact}}".
 *
 * @property int $_id
 * @property string $created_at
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 * @property int $dealer 0 as false, 1 as true
 */
class Contact extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%contact}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name', 'email', 'subject', 'body'], 'required'],
            [['body'], 'string'],
            [['dealer'], 'integer'],
            [['name', 'email', 'subject'], 'string', 'max' => 100],
        ];
    }

}
