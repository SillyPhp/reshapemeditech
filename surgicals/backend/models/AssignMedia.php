<?php

namespace backend\models;

/**
 * This is the model class for table "{{%assign_media}}".
 *
 * @property int $id
 * @property string $_uid
 * @property string $media_id
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $user_name
 * @property string $phone
 * @property string $email
 * @property string|null $password
 * @property string $expiry_date_number
 * @property int $status 0 as Inactive, 1 as Active
 * @property string|null $has_token_key
 * @property int $is_deleted 0 as false, 1 as True
 */
class AssignMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assign_media}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'media_id', 'created_at', 'user_name', 'phone', 'email', 'expiry_date_number'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['media_id', 'user_name', 'password'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
            [['email', 'has_token_key'], 'string', 'max' => 50],
            [['expiry_date_number'], 'string', 'max' => 5],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMedia()
    {
        return $this->hasOne(Videos::className(), ['id' => 'media_id']);
    }

}
