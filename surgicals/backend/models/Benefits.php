<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "benefits".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $name
 * @property string $created_on
 * @property string $created_by
 *
 * @property AssignedBenefits[] $assignedBenefits
 * @property User $createdBy
 */
class Benefits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'benefits';
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
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
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
     * Gets query for [[AssignedBenefits]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedBenefits()
    {
        return $this->hasMany(AssignedBenefits::className(), ['benefit_id' => 'enc_id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'created_by']);
    }
}
