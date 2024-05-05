<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_authorities}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property int $users__id
 * @property int $user_roles__id
 * @property string|null $__permissions
 * @property string|null $eo_uid
 *
 * @property Bills[] $bills
 * @property Categories[] $categories
 * @property Customers[] $customers
 * @property EmailChangeRequests[] $emailChangeRequests
 * @property Locations[] $locations
 * @property ProductOptionLabels[] $productOptionLabels
 * @property ProductOptionValues[] $productOptionValues
 * @property Products[] $products
 * @property StockTransactions[] $stockTransactions
 * @property Suppliers[] $suppliers
 * @property TokenRegistry[] $tokenRegistries
 * @property UserRoles $userRoles
 * @property Users $users
 * @property UserLocations[] $userLocations
 */
class UserAuthorities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_authorities}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'status', 'created_at', 'updated_at', 'users__id', 'user_roles__id'], 'required'],
            [['status', 'users__id', 'user_roles__id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['__permissions'], 'string'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['_uid'], 'unique'],
            [['user_roles__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserRoles::className(), 'targetAttribute' => ['user_roles__id' => '_id']],
            [['users__id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['users__id' => '_id']],
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
            'status' => Yii::t('common', 'Status'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At'),
            'users__id' => Yii::t('common', 'Users ID'),
            'user_roles__id' => Yii::t('common', 'User Roles ID'),
            '__permissions' => Yii::t('common', 'Permissions'),
            'eo_uid' => Yii::t('common', 'Eo Uid'),
        ];
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bills::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasMany(Customers::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[EmailChangeRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmailChangeRequests()
    {
        return $this->hasMany(EmailChangeRequests::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[ProductOptionLabels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionLabels()
    {
        return $this->hasMany(ProductOptionLabels::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[ProductOptionValues]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionValues()
    {
        return $this->hasMany(ProductOptionValues::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[StockTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransactions()
    {
        return $this->hasMany(StockTransactions::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Suppliers::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[TokenRegistries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokenRegistries()
    {
        return $this->hasMany(TokenRegistry::className(), ['user_authorities__id' => '_id']);
    }

    /**
     * Gets query for [[UserRoles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasOne(UserRoles::className(), ['_id' => 'user_roles__id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(Users::className(), ['_id' => 'users__id']);
    }

    /**
     * Gets query for [[UserLocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserLocations()
    {
        return $this->hasMany(UserLocations::className(), ['user_authorities__id' => '_id']);
    }
}
