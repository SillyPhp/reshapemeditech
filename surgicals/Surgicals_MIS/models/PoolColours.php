<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pool_colours}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string|null $code
 * @property string $created_on
 * @property string $created_by
 *
 * @property Colours[] $colours
 */
class PoolColours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pool_colours}}';
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
            [['name'], 'string', 'max' => 100],
            [['code'], 'string', 'max' => 6],
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
            'code' => Yii::t('app', 'Code'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
        ];
    }

    /**
     * Gets query for [[Colours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColours()
    {
        return $this->hasMany(Colours::className(), ['colour_id' => 'enc_id']);
    }
}
