<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wishlists".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property int $type 0 as Private, 1 as Public
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted
 *
 * @property AssignedWishlists[] $assignedWishlists
 * @property SharedWishlists[] $sharedWishlists
 * @property User $createdBy
 * @property User $updatedBy
 */
class Wishlists extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wishlists';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'name', 'created_by'], 'required'],
            [['type', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['enc_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['enc_id'], 'unique'],
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[AssignedWishlists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedWishlists()
    {
        return $this->hasMany(AssignedWishlists::className(), ['wishlist_id' => 'enc_id']);
    }

    /**
     * Gets query for [[SharedWishlists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSharedWishlists()
    {
        return $this->hasMany(SharedWishlists::className(), ['wishlist' => 'enc_id']);
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
