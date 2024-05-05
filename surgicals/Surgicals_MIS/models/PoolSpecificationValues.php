<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pool_specification_values}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $created_by
 * @property string $created_on
 *
 * @property SpecificationValues[] $specificationValues
 */
class PoolSpecificationValues extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pool_specification_values}}';
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
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
        ];
    }

    /**
     * Gets query for [[SpecificationValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificationValues()
    {
        return $this->hasMany(SpecificationValues::className(), ['pool_id' => 'enc_id']);
    }
}
