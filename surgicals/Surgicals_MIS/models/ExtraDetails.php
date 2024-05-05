<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "extra_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property int $has_gps 0 as false, 1 as true
 * @property string|null $gps_mfg show like | With A GPS, Glonass, Beidou, NavIC
 * @property int $has_fingerprint 0 as false, 1 as true
 * @property int $has_faceunlock 0 as false, 1 as true
 * @property int $has_flash_light 0 as false, 1 as true
 * @property int $has_nfc 0 as false, 1 as true
 * @property float $headphone_jack_size store value as mm
 * @property int $is_splash_resistant 0 as false, 1 as true
 * @property string|null $extra_feature
 *
 * @property Products[] $products
 */
class ExtraDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'has_gps', 'has_fingerprint', 'has_faceunlock', 'has_flash_light', 'has_nfc', 'headphone_jack_size', 'is_splash_resistant'], 'required'],
            [['has_gps', 'has_fingerprint', 'has_faceunlock', 'has_flash_light', 'has_nfc', 'is_splash_resistant'], 'integer'],
            [['gps_mfg'], 'string'],
            [['headphone_jack_size'], 'number'],
            [['enc_id'], 'string', 'max' => 50],
            [['extra_feature'], 'string', 'max' => 100],
            [['enc_id'], 'unique'],
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
            'has_gps' => Yii::t('app', 'Has Gps'),
            'gps_mfg' => Yii::t('app', 'Gps Mfg'),
            'has_fingerprint' => Yii::t('app', 'Has Fingerprint'),
            'has_faceunlock' => Yii::t('app', 'Has Faceunlock'),
            'has_flash_light' => Yii::t('app', 'Has Flash Light'),
            'has_nfc' => Yii::t('app', 'Has Nfc'),
            'headphone_jack_size' => Yii::t('app', 'Headphone Jack Size'),
            'is_splash_resistant' => Yii::t('app', 'Is Splash Resistant'),
            'extra_feature' => Yii::t('app', 'Extra Feature'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['extra_detail_id' => 'enc_id']);
    }
}
