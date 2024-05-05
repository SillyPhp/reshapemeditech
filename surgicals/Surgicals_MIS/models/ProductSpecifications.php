<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%product_specifications}}".
 *
 * @property int $id
 * @property string $product_spec_id
 * @property string $product_enc_id
 * @property string $spec_enc_id
 * @property string $value
 * @property int $is_highlighted 0 false,1 true
 * @property string $created_by
 * @property string $created_on
 * @property string $status
 *
 * @property TechneyotechneyoProducts $productEnc
 * @property Specifications $specEnc
 * @property User $createdBy
 */
class ProductSpecifications extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_specifications}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_spec_id', 'product_enc_id', 'spec_enc_id', 'value', 'created_by', 'status'], 'required'],
            [['is_highlighted'], 'integer'],
            [['created_on'], 'safe'],
            [['status'], 'string'],
            [['product_spec_id', 'product_enc_id', 'spec_enc_id', 'created_by'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 100],
            [['product_spec_id'], 'unique'],
            [['product_enc_id'], 'exist', 'skipOnError' => true, 'targetClass' => TechneyotechneyoProducts::className(), 'targetAttribute' => ['product_enc_id' => 'product_enc_id']],
            [['spec_enc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specifications::className(), 'targetAttribute' => ['spec_enc_id' => 'spec_enc_id']],
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
            'product_spec_id' => Yii::t('app', 'Product Spec ID'),
            'product_enc_id' => Yii::t('app', 'Product Enc ID'),
            'spec_enc_id' => Yii::t('app', 'Spec Enc ID'),
            'value' => Yii::t('app', 'Value'),
            'is_highlighted' => Yii::t('app', 'Is Highlighted'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[ProductEnc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductEnc()
    {
        return $this->hasOne(TechneyotechneyoProducts::className(), ['product_enc_id' => 'product_enc_id']);
    }

    /**
     * Gets query for [[SpecEnc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecEnc()
    {
        return $this->hasOne(Specifications::className(), ['spec_enc_id' => 'spec_enc_id']);
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
