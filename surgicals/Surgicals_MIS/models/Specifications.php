<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%specifications}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $detail_group_id
 * @property string $cat_id
 * @property string $pool_id
 * @property string $created_by
 * @property string $created_on
 * @property int $has_variant 0 as false, 1 as true
 *
 * @property SpecificationValues[] $specificationValues
 * @property DetailGroups $detailGroup
 * @property User $createdBy
 * @property Categories $cat
 * @property PoolSpecifications $pool
 */
class Specifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%specifications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'detail_group_id', 'cat_id', 'pool_id', 'created_by'], 'required'],
            [['created_on'], 'safe'],
            [['has_variant'], 'integer'],
            [['enc_id', 'detail_group_id', 'cat_id', 'pool_id', 'created_by'], 'string', 'max' => 50],
            [['enc_id'], 'unique'],
            [['detail_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => DetailGroups::className(), 'targetAttribute' => ['detail_group_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['cat_id' => 'enc_id']],
            [['pool_id'], 'exist', 'skipOnError' => true, 'targetClass' => PoolSpecifications::className(), 'targetAttribute' => ['pool_id' => 'enc_id']],
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
            'detail_group_id' => Yii::t('app', 'Detail Group ID'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'pool_id' => Yii::t('app', 'Pool ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'has_variant' => Yii::t('app', 'Has Variant'),
        ];
    }

    /**
     * Gets query for [[SpecificationValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecificationValues()
    {
        return $this->hasMany(SpecificationValues::className(), ['specification_id' => 'enc_id']);
    }

    /**
     * Gets query for [[DetailGroup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDetailGroup()
    {
        return $this->hasOne(DetailGroups::className(), ['enc_id' => 'detail_group_id']);
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
     * Gets query for [[Pool]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPool()
    {
        return $this->hasOne(PoolSpecifications::className(), ['enc_id' => 'pool_id']);
    }
}
