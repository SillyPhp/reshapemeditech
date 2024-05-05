<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $sim_type store like GSM+GSM, GSM+CDMA
 * @property string $sim_size store like Neno+Neno','Neno+Micro','Micro+Micro','Micro+Regular','Regular+Regular','Neno','Micro','Regular
 * @property int $has_dual_sim 0 as false, 1 as true
 * @property int $has_dual_volte 0 as false, 1 as true
 * @property int $has_hybrid_sim_slot 0 as false, 1 as true
 * @property int|null $card_slot_upto Card Slot value store as GB
 *
 * @property Products[] $products
 */
class GeneralDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'sim_type', 'sim_size', 'has_dual_sim', 'has_dual_volte', 'has_hybrid_sim_slot'], 'required'],
            [['has_dual_sim', 'has_dual_volte', 'has_hybrid_sim_slot', 'card_slot_upto'], 'integer'],
            [['enc_id', 'sim_type', 'sim_size'], 'string', 'max' => 50],
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
            'sim_type' => Yii::t('app', 'Sim Type'),
            'sim_size' => Yii::t('app', 'Sim Size'),
            'has_dual_sim' => Yii::t('app', 'Has Dual Sim'),
            'has_dual_volte' => Yii::t('app', 'Has Dual Volte'),
            'has_hybrid_sim_slot' => Yii::t('app', 'Has Hybrid Sim Slot'),
            'card_slot_upto' => Yii::t('app', 'Card Slot Upto'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['general_detail_id' => 'enc_id']);
    }
}
