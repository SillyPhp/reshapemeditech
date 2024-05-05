<?php

namespace common\models;

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
            [['previous_appointment'], 'integer'],
            [['gender', 'description'], 'string'],
            [['uid', 'name', 'email'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 15],
        ];
    }
}
