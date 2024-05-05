<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%stock_transactions}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property float $quantity
 * @property int|null $type Credit or Debit
 * @property int|null $sub_type Purchased,Sold,Return,Wastage,Moved In, Moved Out
 * @property int|null $user_authorities__id
 * @property int|null $locations__id
 * @property string|null $eo_uid
 * @property float|null $total_price
 * @property float|null $total_amount
 * @property string|null $__data
 * @property int|null $suppliers__id
 * @property int|null $product_combinations__id
 * @property string|null $currency_code
 * @property int|null $bills__id
 * @property int|null $customers__id
 * @property int|null $tax_presets__id
 *
 * @property Bills $bills
 * @property Customers $customers
 * @property Locations $locations
 * @property ProductCombinations $productCombinations
 * @property Suppliers $suppliers
 * @property TaxPresets $taxPresets
 * @property UserAuthorities $userAuthorities
 */
class StockTransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stock_transactions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'quantity'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'type', 'sub_type', 'user_authorities__id', 'locations__id', 'suppliers__id', 'product_combinations__id', 'bills__id', 'customers__id', 'tax_presets__id'], 'integer'],
            [['quantity', 'total_price', 'total_amount'], 'number'],
            [['__data'], 'string'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['currency_code'], 'string', 'max' => 5],
            [['_uid'], 'unique'],
            [['bills__id'], 'exist', 'skipOnError' => true, 'targetClass' => Bills::className(), 'targetAttribute' => ['bills__id' => '_id']],
            [['customers__id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customers__id' => '_id']],
            [['locations__id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['locations__id' => '_id']],
            [['product_combinations__id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCombinations::className(), 'targetAttribute' => ['product_combinations__id' => '_id']],
            [['suppliers__id'], 'exist', 'skipOnError' => true, 'targetClass' => Suppliers::className(), 'targetAttribute' => ['suppliers__id' => '_id']],
            [['tax_presets__id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxPresets::className(), 'targetAttribute' => ['tax_presets__id' => '_id']],
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
            'quantity' => Yii::t('common', 'Quantity'),
            'type' => Yii::t('common', 'Type'),
            'sub_type' => Yii::t('common', 'Sub Type'),
            'user_authorities__id' => Yii::t('common', 'User Authorities ID'),
            'locations__id' => Yii::t('common', 'Locations ID'),
            'eo_uid' => Yii::t('common', 'Eo Uid'),
            'total_price' => Yii::t('common', 'Total Price'),
            'total_amount' => Yii::t('common', 'Total Amount'),
            '__data' => Yii::t('common', 'Data'),
            'suppliers__id' => Yii::t('common', 'Suppliers ID'),
            'product_combinations__id' => Yii::t('common', 'Product Combinations ID'),
            'currency_code' => Yii::t('common', 'Currency Code'),
            'bills__id' => Yii::t('common', 'Bills ID'),
            'customers__id' => Yii::t('common', 'Customers ID'),
            'tax_presets__id' => Yii::t('common', 'Tax Presets ID'),
        ];
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasOne(Bills::className(), ['_id' => 'bills__id']);
    }

    /**
     * Gets query for [[Customers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomers()
    {
        return $this->hasOne(Customers::className(), ['_id' => 'customers__id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasOne(Locations::className(), ['_id' => 'locations__id']);
    }

    /**
     * Gets query for [[ProductCombinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinations()
    {
        return $this->hasOne(ProductCombinations::className(), ['_id' => 'product_combinations__id']);
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasOne(Suppliers::className(), ['_id' => 'suppliers__id']);
    }

    /**
     * Gets query for [[TaxPresets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxPresets()
    {
        return $this->hasOne(TaxPresets::className(), ['_id' => 'tax_presets__id']);
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
