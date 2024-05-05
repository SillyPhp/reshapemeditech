<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "assigned_benefits".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $benefit_id
 * @property string|null $benefit_value
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_deleted
 *
 * @property Benefits $benefit
 * @property User $createdBy
 * @property User $updatedBy
 */
class AssignedBenefits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'assigned_benefits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'benefit_id', 'created_by'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['is_deleted'], 'integer'],
            [['enc_id', 'benefit_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['benefit_value'], 'string', 'max' => 255],
            [['enc_id'], 'unique'],
            [['benefit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Benefits::className(), 'targetAttribute' => ['benefit_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
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
            'benefit_id' => Yii::t('app', 'Benefit ID'),
            'benefit_value' => Yii::t('app', 'Benefit Value'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Benefit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBenefit()
    {
        return $this->hasOne(Benefits::className(), ['enc_id' => 'benefit_id']);
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

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'updated_by']);
    }
}
