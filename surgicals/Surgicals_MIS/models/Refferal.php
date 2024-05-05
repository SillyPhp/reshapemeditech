<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%refferal}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $code
 * @property int $user_id
 * @property string $created_at
 */
class Refferal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%refferal}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'code', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at'], 'safe'],
            [['_uid', 'code'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'Id'),
            '_uid' => Yii::t('app', 'Uid'),
            'code' => Yii::t('app', 'Code'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
