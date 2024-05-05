<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%suppliers}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string|null $name
 * @property string|null $eo_uid
 * @property int|null $user_authorities__id
 * @property string|null $short_description
 *
 * @property StockTransactions[] $stockTransactions
 * @property UserAuthorities $userAuthorities
 */
class Suppliers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%suppliers}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'user_authorities__id'], 'integer'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 150],
            [['short_description'], 'string', 'max' => 255],
            [['_uid'], 'unique'],
            [['user_authorities__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAuthorities::className(), 'targetAttribute' => ['user_authorities__id' => '_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            '_id' => Yii::t('common', 'Id'),
            '_uid' => Yii::t('common', 'Uid'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'status' => Yii::t('common', 'Status'),
            'name' => Yii::t('common', 'Name'),
            'eo_uid' => Yii::t('common', 'Eo Uid'),
            'user_authorities__id' => Yii::t('common', 'User Authorities ID'),
            'short_description' => Yii::t('common', 'Short Description'),
        ];
    }

    /**
     * Gets query for [[StockTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransactions()
    {
        return $this->hasMany(StockTransactions::className(), ['suppliers__id' => '_id']);
    }

    /**
     * Gets query for [[UserAuthorities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserAuthorities()
    {
        return $this->hasOne(UserAuthorities::className(), ['_id' => 'user_authorities__id']);
    }
}
