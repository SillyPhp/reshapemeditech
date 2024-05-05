<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "assigned_reviews".
 *
 * @property int $id
 * @property string $enc_id
 * @property string|null $review_id
 * @property string|null $product_id
 * @property string|null $vendor_id
 * @property string|null $parent_id foreign key to self enc id
 * @property string $comment
 * @property int $up Upvote increment by 1 on every vote
 * @property int $down Downvote increment by 1 on every vote
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $status 0 as pending, 1 as visible
 * @property int $is_deleted
 *
 * @property Reviews $review
 * @property Products $product
 * @property Vendors $vendor
 * @property User $createdBy
 * @property User $updatedBy
 * @property AssignedReviews $parent
 * @property AssignedReviews[] $assignedReviews
 */
class AssignedReviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'comment', 'created_by'], 'required'],
            [['comment'], 'string'],
            [['up', 'down', 'status', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['enc_id', 'review_id', 'product_id', 'vendor_id', 'parent_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['review_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reviews::className(), 'targetAttribute' => ['review_id' => 'enc_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Vendors::className(), 'targetAttribute' => ['vendor_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssignedReviews::className(), 'targetAttribute' => ['parent_id' => 'enc_id']],
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
            'review_id' => Yii::t('app', 'Review ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'comment' => Yii::t('app', 'Comment'),
            'up' => Yii::t('app', 'Up'),
            'down' => Yii::t('app', 'Down'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Review]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReview()
    {
        return $this->hasOne(Reviews::className(), ['enc_id' => 'review_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['enc_id' => 'product_id']);
    }

    /**
     * Gets query for [[Vendor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(Vendors::className(), ['enc_id' => 'vendor_id']);
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

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(AssignedReviews::className(), ['enc_id' => 'parent_id']);
    }

    /**
     * Gets query for [[AssignedReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedReviews()
    {
        return $this->hasMany(AssignedReviews::className(), ['parent_id' => 'enc_id']);
    }
}
