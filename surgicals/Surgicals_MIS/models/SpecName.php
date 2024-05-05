<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%spec_name}}".
 *
 * @property int $id
 * @property string $spec_name_enc_id
 * @property string $cat_id
 * @property string $name
 * @property string $created_by
 * @property string $created_on
 * @property string $status
 *
 * @property User $createdBy
 * @property Categories $cat
 * @property Specifications[] $specifications
 */
class SpecName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%spec_name}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spec_name_enc_id', 'cat_id', 'name', 'created_by', 'status'], 'required'],
            [['created_on'], 'safe'],
            [['status'], 'string'],
            [['spec_name_enc_id', 'cat_id', 'name', 'created_by'], 'string', 'max' => 50],
            [['spec_name_enc_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['cat_id' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'spec_name_enc_id' => Yii::t('app', 'Spec Name Enc ID'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'name' => Yii::t('app', 'Name'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
        ];
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
     * Gets query for [[Cat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Categories::className(), ['enc_id' => 'cat_id']);
    }

    /**
     * Gets query for [[Specifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecifications()
    {
        return $this->hasMany(Specifications::className(), ['base_name_id' => 'spec_name_enc_id']);
    }
}
