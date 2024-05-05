<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%vendors}}".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $user_id
 * @property string $name
 * @property string $slug
 * @property string|null $address Primary Address of Vendor
 * @property string|null $email Primary Email of Vendor
 * @property string|null $phone Primary Phone number of Vendor
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $status 0 as pending , 1 as approved, 2 as rejected
 * @property int $is_deleted
 *
 * @property Stocks[] $stocks
 * @property User $user
 */
class Vendors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vendors}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'user_id', 'name', 'slug', 'created_by'], 'required'],
            [['address'], 'string'],
            [['created_on', 'updated_on'], 'safe'],
            [['status', 'is_deleted'], 'integer'],
            [['enc_id', 'user_id', 'email', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 120],
            [['phone'], 'string', 'max' => 15],
            [['name'], 'unique'],
            [['slug'], 'unique'],
            [['enc_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'enc_id']],
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
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'slug' => Yii::t('app', 'Slug'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[Stocks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stocks::className(), ['vendor_id' => 'enc_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'user_id']);
    }
}
