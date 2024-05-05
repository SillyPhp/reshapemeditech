<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%categories}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $_parent_id
 * @property string|null $updated_at
 * @property int $status
 * @property string|null $name
 * @property string $eo_uid
 * @property int|null $user_authorities__id
 * @property string|null $type
 *
 * @property UserAuthorities $userAuthorities
 * @property Products[] $products
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'eo_uid'], 'required'],
            [['created_at', 'updated_at', '_parent_id'], 'safe'],
            [['status', 'user_authorities__id'], 'integer'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['name', 'type'], 'string', 'max' => 45],
            [['_uid'], 'unique'],
            [['user_authorities__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAuthorities::className(), 'targetAttribute' => ['user_authorities__id' => '_id']],
        ];
    }

    /**
     * Gets query for [[UserAuthorities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthorities()
    {
        return $this->hasOne(UserAuthorities::className(), ['_id' => 'user_authorities__id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['categories__id' => '_id']);
    }

    public function getParentId()
    {
        return $this->hasOne(Categories::className(), ['_id' => '_parent_id']);
    }
}
