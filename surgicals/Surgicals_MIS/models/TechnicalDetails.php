<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "technical_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $operating_system Operation system
 * @property string|null $os_version_id OS Version
 * @property string $processor_id Chipset Name show like Qualcomm Snapdragon 720G
 * @property string|null $processor_type
 * @property string|null $core_details string like 4x2.3 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53
 * @property float $cpu Store value in GHz like 2.3 GHz
 * @property string $gpu_id
 * @property int $has_java 0 as false, 1 as true
 * @property int $has_browser 0 as false, 1 as true, Specially add for LED TV
 * @property int $is_otg_compatible 0 as false, 1 as true, Specially add for LED TV
 *
 * @property Products[] $products
 * @property GpuModels $gpu
 * @property OperationSystemVersions $osVersion
 * @property Processors $processor
 */
class TechnicalDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'technical_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'operating_system', 'processor_id', 'cpu', 'gpu_id', 'has_java', 'has_browser', 'is_otg_compatible'], 'required'],
            [['operating_system', 'processor_type'], 'string'],
            [['cpu'], 'number'],
            [['has_java', 'has_browser', 'is_otg_compatible'], 'integer'],
            [['enc_id', 'os_version_id', 'processor_id', 'gpu_id'], 'string', 'max' => 50],
            [['core_details'], 'string', 'max' => 255],
            [['enc_id'], 'unique'],
            [['gpu_id'], 'exist', 'skipOnError' => true, 'targetClass' => GpuModels::className(), 'targetAttribute' => ['gpu_id' => 'enc_id']],
            [['os_version_id'], 'exist', 'skipOnError' => true, 'targetClass' => OperationSystemVersions::className(), 'targetAttribute' => ['os_version_id' => 'enc_id']],
            [['processor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Processors::className(), 'targetAttribute' => ['processor_id' => 'enc_id']],
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
            'operating_system' => Yii::t('app', 'Operating System'),
            'os_version_id' => Yii::t('app', 'Os Version ID'),
            'processor_id' => Yii::t('app', 'Processor ID'),
            'processor_type' => Yii::t('app', 'Processor Type'),
            'core_details' => Yii::t('app', 'Core Details'),
            'cpu' => Yii::t('app', 'Cpu'),
            'gpu_id' => Yii::t('app', 'Gpu ID'),
            'has_java' => Yii::t('app', 'Has Java'),
            'has_browser' => Yii::t('app', 'Has Browser'),
            'is_otg_compatible' => Yii::t('app', 'Is Otg Compatible'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['technical_detail_id' => 'enc_id']);
    }

    /**
     * Gets query for [[Gpu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGpu()
    {
        return $this->hasOne(GpuModels::className(), ['enc_id' => 'gpu_id']);
    }

    /**
     * Gets query for [[OsVersion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOsVersion()
    {
        return $this->hasOne(OperationSystemVersions::className(), ['enc_id' => 'os_version_id']);
    }

    /**
     * Gets query for [[Processor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProcessor()
    {
        return $this->hasOne(Processors::className(), ['enc_id' => 'processor_id']);
    }
}
