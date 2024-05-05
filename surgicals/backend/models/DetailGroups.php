<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%detail_groups}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $cat_id
 * @property string $pool_id
 * @property string $created_by
 * @property string $created_on
 * @property string $status
 *
 * @property User $createdBy
 * @property PoolDetailGroups $pool
 * @property Categories $cat
 * @property Specifications[] $specifications
 */
class DetailGroups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%detail_groups}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'cat_id', 'pool_id', 'created_by', 'status'], 'required'],
            [['created_on'], 'safe'],
            [['status'], 'string'],
            [['enc_id', 'cat_id', 'pool_id', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['pool_id'], 'exist', 'skipOnError' => true, 'targetClass' => PoolDetailGroups::className(), 'targetAttribute' => ['pool_id' => 'enc_id']],
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
            'enc_id' => Yii::t('app', 'Enc ID'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'pool_id' => Yii::t('app', 'Pool ID'),
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
     * Gets query for [[Pool]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPool()
    {
        return $this->hasOne(PoolDetailGroups::className(), ['enc_id' => 'pool_id']);
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
        return $this->hasMany(Specifications::className(), ['detail_group_id' => 'enc_id']);
    }
}
