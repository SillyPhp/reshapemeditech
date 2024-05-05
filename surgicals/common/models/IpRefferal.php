<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ip_refferal}}".
 *
 * @property int|null $_id
 * @property string $_uid
 * @property string $ip_address
 * @property int $ref_id
 * @property string $created_at
 */
class IpRefferal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ip_refferal}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_id'], 'integer'],
            [['_uid', 'ip_address', 'ref_id'], 'required'],
            [['created_at'], 'safe'],
            [['_uid', 'ip_address', 'ref_id'], 'string', 'max' => 30],
        ];
    }



    /**
     * Gets query for [[Refferal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRefferal()
    {
        return $this->hasMany(Refferal::className(), ['code' => 'ref_id']);
    }
}
