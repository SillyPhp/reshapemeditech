<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "shared_wishlists".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $wishlist
 * @property string $user_id
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted
 *
 * @property Wishlists $wishlist0
 * @property User $user
 * @property User $createdBy
 * @property User $updatedBy
 */
class SharedWishlists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shared_wishlists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'wishlist', 'user_id', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_deleted'], 'integer'],
            [['enc_id', 'wishlist', 'user_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['wishlist'], 'exist', 'skipOnError' => true, 'targetClass' => Wishlists::className(), 'targetAttribute' => ['wishlist' => 'enc_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'enc_id' => Yii::t('app', 'Enc ID'),
            'wishlist' => Yii::t('app', 'Wishlist'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Wishlist0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWishlist0()
    {
        return $this->hasOne(Wishlists::className(), ['enc_id' => 'wishlist']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'user_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'created_by']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'updated_by']);
    }
}
