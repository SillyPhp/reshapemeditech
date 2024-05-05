<?php

namespace backend\models;

/**
 * This is the model class for table "{{%tax_presets}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string|null $eo_uid
 * @property string $title
 * @property string|null $short_description
 *
 * @property Bills[] $bills
 * @property Products[] $products
 * @property StockTransactions[] $stockTransactions
 * @property Taxes[] $taxes
 */
class TaxPresets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tax_presets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'title'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 150],
            [['short_description'], 'string', 'max' => 255],
            [['_uid'], 'unique'],
        ];
    }

    /**
     * Gets query for [[Bills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBills()
    {
        return $this->hasMany(Bills::className(), ['tax_presets__id' => '_id']);
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['tax_presets__id' => '_id']);
    }

    /**
     * Gets query for [[StockTransactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStockTransactions()
    {
        return $this->hasMany(StockTransactions::className(), ['tax_presets__id' => '_id']);
    }

    /**
     * Gets query for [[Taxes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTaxes()
    {
        return $this->hasMany(Taxes::className(), ['tax_presets__id' => '_id']);
    }
}
