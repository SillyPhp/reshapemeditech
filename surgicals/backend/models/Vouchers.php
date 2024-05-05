<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vouchers}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int|null $brand_id
 * @property int|null $category_id
 * @property string $type
 * @property string $name
 * @property int $amount
 * @property int $use_once
 * @property string $end_datetime
 * @property int $is_deleted 0 as false, 1 as True
 */
class Vouchers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vouchers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'name', 'amount', 'end_datetime'], 'required'],
            [['created_at', 'updated_at', 'end_datetime'], 'safe'],
            [['brand_id', 'category_id', 'amount', 'use_once', 'is_deleted'], 'integer'],
            [['type'], 'string'],
            [['_uid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 100],
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
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'amount' => Yii::t('app', 'Amount'),
            'use_once' => Yii::t('app', 'Use Once'),
            'end_datetime' => Yii::t('app', 'End Datetime'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['_id' => 'brand_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['_id' => 'category_id']);
    }
}
