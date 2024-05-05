<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assigned_media_files".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property string $media_file_id
 * @property string $assigned_colour_id
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $status 0 as Pending, 1 as Approved, 2 as Rejected
 * @property int $is_deleted
 *
 * @property MediaFiles $mediaFile
 * @property AssignedColours $assignedColour
 * @property User $createdBy
 * @property User $updatedBy
 * @property Products $product
 */
class AssignedMediaFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_media_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'media_file_id', 'assigned_colour_id', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['status', 'is_deleted'], 'integer'],
            [['enc_id', 'product_id', 'media_file_id', 'assigned_colour_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['media_file_id'], 'exist', 'skipOnError' => true, 'targetClass' => MediaFiles::className(), 'targetAttribute' => ['media_file_id' => 'enc_id']],
            [['assigned_colour_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssignedColours::className(), 'targetAttribute' => ['assigned_colour_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'media_file_id' => Yii::t('app', 'Media File ID'),
            'assigned_colour_id' => Yii::t('app', 'Assigned Colour ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
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

    /**
     * Gets query for [[AssignedColour]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedColour()
    {
        return $this->hasOne(AssignedColours::className(), ['enc_id' => 'assigned_colour_id']);
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['enc_id' => 'product_id']);
    }
}
