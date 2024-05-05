<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%pool_detail_groups}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $created_by
 * @property string $created_on
 *
 * @property DetailGroups[] $detailGroups
 */
class PoolDetailGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pool_detail_groups}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'name', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['enc_id', 'name', 'created_by'], 'string', 'max' => 50],
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
     * Gets query for [[DetailGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailGroups()
    {
        return $this->hasMany(DetailGroups::className(), ['pool_id' => 'enc_id']);
    }
}
