<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%flavours}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $name
 * @property int $is_deleted 0 as false, 1 as true
 */
class Flavours extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%flavours}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'name'], 'required'],
            [['is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
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
            'name' => Yii::t('app', 'Name'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }
}
