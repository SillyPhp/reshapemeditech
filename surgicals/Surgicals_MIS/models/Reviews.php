<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $media_file_id
 * @property float $review 0-5 allow as review and decimal value with .5 also allowed
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted
 *
 * @property AssignedReviews[] $assignedReviews
 * @property User $createdBy
 * @property User $updatedBy
 * @property MediaFiles $mediaFile
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'media_file_id', 'review', 'created_by'], 'required'],
            [['review'], 'number'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_deleted'], 'integer'],
            [['enc_id', 'media_file_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
            [['media_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => MediaFiles::className(), 'targetAttribute' => ['media_file_id' => 'enc_id']],
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
            'media_file_id' => Yii::t('app', 'Media File ID'),
            'review' => Yii::t('app', 'Review'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[AssignedReviews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedReviews()
    {
        return $this->hasMany(AssignedReviews::className(), ['review_id' => 'enc_id']);
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
     * Gets query for [[MediaFile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMediaFile()
    {
        return $this->hasOne(MediaFiles::className(), ['enc_id' => 'media_file_id']);
    }
}
