<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "display_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $display_type_id Foreign Key  of DisplayTypes table
 * @property string $display_resolution_id Foreign Key  of DisplayResolutions table
 * @property int|null $display_colors Value store like 16M, 24M
 * @property int $has_touch 0 as No touch screen, 1 as Touch screen display
 * @property float $size store value as inches
 * @property int|null $ppi pixels per inch ,  show like ~395 PPI
 * @property int|null $screen_to_body_ratio show like ~ 90.6%
 * @property int $has_notch 0 as false, 1 as true
 * @property string|null $notch_type_id Foreign Key  of NotchTypes table
 * @property int|null $refresh_rate Store as Hz, display like 90Hz
 *
 * @property DisplayTypes $displayType
 * @property DisplayResolution $displayResolution
 * @property NotchTypes $notchType
 * @property Products[] $products
 */
class DisplayDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'display_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'display_type_id', 'display_resolution_id', 'has_touch', 'size', 'has_notch'], 'required'],
            [['display_colors', 'has_touch', 'ppi', 'screen_to_body_ratio', 'has_notch', 'refresh_rate'], 'integer'],
            [['size'], 'number'],
            [['enc_id', 'display_type_id', 'display_resolution_id', 'notch_type_id'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['display_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisplayTypes::className(), 'targetAttribute' => ['display_type_id' => 'enc_id']],
            [['display_resolution_id'], 'exist', 'skipOnError' => true, 'targetClass' => DisplayResolution::className(), 'targetAttribute' => ['display_resolution_id' => 'enc_id']],
            [['notch_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => NotchTypes::className(), 'targetAttribute' => ['notch_type_id' => 'enc_id']],
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
            'display_type_id' => Yii::t('app', 'Display Type ID'),
            'display_resolution_id' => Yii::t('app', 'Display Resolution ID'),
            'display_colors' => Yii::t('app', 'Display Colors'),
            'has_touch' => Yii::t('app', 'Has Touch'),
            'size' => Yii::t('app', 'Size'),
            'ppi' => Yii::t('app', 'Ppi'),
            'screen_to_body_ratio' => Yii::t('app', 'Screen To Body Ratio'),
            'has_notch' => Yii::t('app', 'Has Notch'),
            'notch_type_id' => Yii::t('app', 'Notch Type ID'),
            'refresh_rate' => Yii::t('app', 'Refresh Rate'),
        ];
    }

    /**
     * Gets query for [[DisplayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisplayType()
    {
        return $this->hasOne(DisplayTypes::className(), ['enc_id' => 'display_type_id']);
    }

    /**
     * Gets query for [[DisplayResolution]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDisplayResolution()
    {
        return $this->hasOne(DisplayResolution::className(), ['enc_id' => 'display_resolution_id']);
    }

    /**
     * Gets query for [[NotchType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotchType()
    {
        return $this->hasOne(NotchTypes::className(), ['enc_id' => 'notch_type_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['display_detail_id' => 'enc_id']);
    }
}
