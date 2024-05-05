<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%our_team}}".
 *
 * @property int $id
 * @property string $uid
 * @property string $created_at
 * @property string $name
 * @property string $designation
 * @property string $phone
 * @property string|null $description
 * @property string|null $charges
 * @property string $image
 * @property int $is_deleted 0 as false, 1 as True
 */
class OurTeam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%our_team}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['uid', 'name', 'designation', 'phone', 'image'], 'required'],
            [['created_at'], 'safe'],
            [['description'], 'string'],
            [['is_deleted'], 'integer'],
            [['uid', 'name', 'designation', 'image'], 'string', 'max' => 100],
            [['phone', 'charges'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uid' => Yii::t('app', 'Uid'),
            'created_at' => Yii::t('app', 'Created At'),
            'name' => Yii::t('app', 'Name'),
            'designation' => Yii::t('app', 'Designation'),
            'phone' => Yii::t('app', 'Phone'),
            'description' => Yii::t('app', 'Description'),
            'charges' => Yii::t('app', 'Charges'),
            'image' => Yii::t('app', 'Image'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }
}
