<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%appointment}}".
 *
 * @property int $_id
 * @property string $uid
 * @property string $created_at
 * @property string $name
 * @property string|null $email
 * @property string $phone
 * @property int $previous_appointment 0 as No, 1 as Yes
 * @property string $gender
 * @property string|null $description
 * @property string $date
 * @property int $is_deleted 0 false1 1 true
 */
class Appointment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%appointment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'name', 'phone', 'previous_appointment', 'gender'], 'required'],
            [['created_at', 'date'], 'safe'],
            [['previous_appointment', 'is_deleted'], 'integer'],
            [['gender', 'description'], 'string'],
            [['uid', 'name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('app', 'Id'),
            'uid' => Yii::t('app', 'Uid'),
            'created_at' => Yii::t('app', 'Created At'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'previous_appointment' => Yii::t('app', 'Previous Appointment'),
            'gender' => Yii::t('app', 'Gender'),
            'description' => Yii::t('app', 'Description'),
            'date' => Yii::t('app', 'Date'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }
}
