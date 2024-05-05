<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pool_variants}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $created_on
 * @property string $created_by
 *
 * @property Variants[] $variants
 */
class PoolVariants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pool_variants}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'name', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['enc_id', 'created_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'name' => Yii::t('app', 'Name'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[Variants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(Variants::className(), ['variant_id' => 'enc_id']);
    }
}
