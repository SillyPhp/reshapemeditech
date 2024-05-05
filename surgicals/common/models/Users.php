<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string $updated_at
 * @property string $username
 * @property string|null $email
 * @property string|null $password
 * @property int $status
 * @property string|null $remember_token
 * @property string $first_name
 * @property string $last_name
 * @property string|null $designation
 *
 * @property EmailChangeRequests[] $emailChangeRequests
 * @property UserAuthorities[] $userAuthorities
 * @property UserProfiles[] $userProfiles
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'updated_at', 'username', 'status', 'first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['username', 'first_name', 'last_name', 'designation'], 'string', 'max' => 45],
            [['email', 'password', 'remember_token'], 'string', 'max' => 255],
            [['_uid'], 'unique'],
        ];
    }

    /**
     * Gets query for [[EmailChangeRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailChangeRequests()
    {
        return $this->hasMany(EmailChangeRequests::className(), ['users__id' => '_id']);
    }

    /**
     * Gets query for [[UserAuthorities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthorities()
    {
        return $this->hasMany(UserAuthorities::className(), ['users__id' => '_id']);
    }

    /**
     * Gets query for [[UserProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(UserProfiles::className(), ['users__id' => '_id']);
    }
}
