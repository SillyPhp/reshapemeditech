<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "display_resolution".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $standard
 * @property string $aspect_ratio
 * @property int $width
 * @property int $height
 * @property float|null $steam Steam is a video game digital distribution service by Valve. It was launched as a standalone software client in September 2003 as a way for Valve to provide automatic updates for their games, and expanded to include games from third-party publishers.
 * @property float|null $stat_counter StatCounter is a web traffic analysis website started in 1999. Access to basic services is free and advanced services can cost between US$5 and US$119 a month.
 * @property string $created_on
 * @property string $created_by
 *
 * @property DisplayDetails[] $displayDetails
 * @property User $createdBy
 */
class DisplayResolution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'display_resolution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'standard', 'aspect_ratio', 'width', 'height', 'created_by'], 'required'],
            [['width', 'height'], 'integer'],
            [['steam', 'stat_counter'], 'number'],
            [['created_on'], 'safe'],
            [['enc_id', 'standard', 'created_by'], 'string', 'max' => 50],
            [['aspect_ratio'], 'string', 'max' => 10],
            [['enc_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
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
            'standard' => Yii::t('app', 'Standard'),
            'aspect_ratio' => Yii::t('app', 'Aspect Ratio'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'steam' => Yii::t('app', 'Steam'),
            'stat_counter' => Yii::t('app', 'Stat Counter'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[DisplayDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisplayDetails()
    {
        return $this->hasMany(DisplayDetails::className(), ['display_resolution_id' => 'enc_id']);
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
}
