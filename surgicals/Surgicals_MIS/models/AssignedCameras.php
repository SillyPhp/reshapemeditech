<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assigned_cameras".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $product_id
 * @property float|null $aperture show like f/1.8
 * @property int $size Store as MegaPixels and Show like 16MP
 * @property int|null $type 1 as Rear, 2 as Front, 3 as Side Camera
 * @property string|null $angle
 * @property int $is_autofocus 0 as false, 1 as true
 * @property int|null $recording_quality Store value like 720 , 1080, 2160 and here 720= HD, 1080 FHD, 2160 = 4k UHD
 * @property int|null $fps fps stand for Frame per second
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 *
 * @property Products $product
 * @property User $createdBy
 * @property User $updatedBy
 */
class AssignedCameras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_cameras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'product_id', 'size', 'is_autofocus', 'created_by'], 'required'],
            [['aperture'], 'number'],
            [['size', 'type', 'is_autofocus', 'recording_quality', 'fps'], 'integer'],
            [['angle'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['enc_id', 'product_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'enc_id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'aperture' => Yii::t('app', 'Aperture'),
            'size' => Yii::t('app', 'Size'),
            'type' => Yii::t('app', 'Type'),
            'angle' => Yii::t('app', 'Angle'),
            'is_autofocus' => Yii::t('app', 'Is Autofocus'),
            'recording_quality' => Yii::t('app', 'Recording Quality'),
            'fps' => Yii::t('app', 'Fps'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
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
