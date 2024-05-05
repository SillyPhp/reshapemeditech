<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "connectivity_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $gprs
 * @property int $has_edge 0 as false, 1 as true
 * @property int $has_volte 0 as false, 1 as true
 * @property int $wifi 0 as false, 1 as true
 * @property float|null $bluetooth show like Yes, v5.0 and 0 as false
 * @property string|null $usb_type
 * @property float $usb_version
 * @property int $has_usb_tethering 0 as false, 1 as true
 * @property int $has_wifi_tethering 0 as false, 1 as true
 * @property int $has_bluetooth_tethering 0 as false, 1 as true
 *
 * @property Products[] $products
 */
class ConnectivityDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'connectivity_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'gprs', 'has_edge', 'has_volte', 'wifi', 'usb_version', 'has_usb_tethering', 'has_wifi_tethering', 'has_bluetooth_tethering'], 'required'],
            [['gprs', 'usb_type'], 'string'],
            [['has_edge', 'has_volte', 'wifi', 'has_usb_tethering', 'has_wifi_tethering', 'has_bluetooth_tethering'], 'integer'],
            [['bluetooth', 'usb_version'], 'number'],
            [['enc_id'], 'string', 'max' => 50],
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
            'gprs' => Yii::t('app', 'Gprs'),
            'has_edge' => Yii::t('app', 'Has Edge'),
            'has_volte' => Yii::t('app', 'Has Volte'),
            'wifi' => Yii::t('app', 'Wifi'),
            'bluetooth' => Yii::t('app', 'Bluetooth'),
            'usb_type' => Yii::t('app', 'Usb Type'),
            'usb_version' => Yii::t('app', 'Usb Version'),
            'has_usb_tethering' => Yii::t('app', 'Has Usb Tethering'),
            'has_wifi_tethering' => Yii::t('app', 'Has Wifi Tethering'),
            'has_bluetooth_tethering' => Yii::t('app', 'Has Bluetooth Tethering'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['connectivity_detail_id' => 'enc_id']);
    }
}
