<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string $eo_uid
 * @property string $name
 * @property string|null $short_description
 * @property int|null $user_authorities__id
 * @property int|null $categories__id
 * @property int|null $tax_presets__id
 *
 * @property ProductCombinations[] $productCombinations
 * @property ProductOptionLabels[] $productOptionLabels
 * @property Categories $categories
 * @property TaxPresets $taxPresets
 * @property UserAuthorities $userAuthorities
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'eo_uid', 'name'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'user_authorities__id', 'categories__id', 'tax_presets__id'], 'integer'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['_uid'], 'unique'],
            [['categories__id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['categories__id' => '_id']],
            [['tax_presets__id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxPresets::className(), 'targetAttribute' => ['tax_presets__id' => '_id']],
            [['user_authorities__id'], 'exist', 'skipOnError' => true, 'targetClass' => UserAuthorities::className(), 'targetAttribute' => ['user_authorities__id' => '_id']],
        ];
    }

    /**
     * Gets query for [[ProductCombinations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductCombinations()
    {
        return $this->hasMany(ProductCombinations::className(), ['products__id' => '_id']);
    }

    /**
     * Gets query for [[ProductOptionLabels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductOptionLabels()
    {
        return $this->hasMany(ProductOptionLabels::className(), ['products__id' => '_id']);
    }

    /**
     * Gets query for [[Categories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Categories::className(), ['_id' => 'categories__id']);
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
