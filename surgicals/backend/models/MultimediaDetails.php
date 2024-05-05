<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "multimedia_details".
 *
 * @property int $id
 * @property string $enc_id
 * @property int $has_email 0 as false, 1 as true
 * @property int $has_music 0 as false, 1 as true
 * @property int $has_video 0 as false, 1 as true
 * @property int $has_fm 0 as false, 1 as true
 * @property int $has_doc_reader 0 as false, 1 as true
 *
 * @property Products[] $products
 */
class MultimediaDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'multimedia_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'has_email', 'has_music', 'has_video', 'has_fm', 'has_doc_reader'], 'required'],
            [['has_email', 'has_music', 'has_video', 'has_fm', 'has_doc_reader'], 'integer'],
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
            'has_email' => Yii::t('app', 'Has Email'),
            'has_music' => Yii::t('app', 'Has Music'),
            'has_video' => Yii::t('app', 'Has Video'),
            'has_fm' => Yii::t('app', 'Has Fm'),
            'has_doc_reader' => Yii::t('app', 'Has Doc Reader'),
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['multimedia_detail_id' => 'enc_id']);
    }
}
