<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subscribers".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $email
 * @property string $created_on
 */
class Subscribers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subscribers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'email'], 'required'],
            [['created_on'], 'safe'],
            [['enc_id'], 'string', 'max' => 100],
            [['email'], 'string', 'max' => 255],
        ];
    }

}
