<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%box_items}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property int|null $headphone 0 as false, 1 as true
 * @property int|null $charger 0 as false, 1 as true
 * @property int|null $usb_cable 0 as false, 1 as true
 * @property int|null $adapter 0 as false, 1 as true
 * @property int|null $booklet 0 as false, 1 as true
 * @property int|null $sim_ejector 0 as false, 1 as true
 * @property int|null $case_cover 0 as false, 1 as true
 * @property int|null $tempered_glass 0 as false, 1 as true
 * @property int|null $scratch_card 0 as false, 1 as true
 * @property int|null $warranty_card 0 as false, 1 as true
 *
 * @property Products[] $products
 */
class BoxItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%box_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id'], 'required'],
            [['headphone', 'charger', 'usb_cable', 'adapter', 'booklet', 'sim_ejector', 'case_cover', 'tempered_glass', 'scratch_card', 'warranty_card'], 'integer'],
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
            'headphone' => Yii::t('app', 'Headphone'),
            'charger' => Yii::t('app', 'Charger'),
            'usb_cable' => Yii::t('app', 'Usb Cable'),
            'adapter' => Yii::t('app', 'Adapter'),
            'booklet' => Yii::t('app', 'Booklet'),
            'sim_ejector' => Yii::t('app', 'Sim Ejector'),
            'case_cover' => Yii::t('app', 'Case Cover'),
            'tempered_glass' => Yii::t('app', 'Tempered Glass'),
            'scratch_card' => Yii::t('app', 'Scratch Card'),
            'warranty_card' => Yii::t('app', 'Warranty Card'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['box_item_id' => 'enc_id']);
    }
}
