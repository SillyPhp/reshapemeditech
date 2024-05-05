<?php

namespace app\models\demo;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $product_enc_id
 * @property string $category_id
 * @property string $brand_id
 * @property string $name
 * @property string|null $image
 * @property string $short_description
 * @property string $long_description
 * @property int $is_featured 1 featured,2 normal
 * @property string $created_by
 * @property string $created_on
 * @property string|null $updated_by
 * @property string|null $updated_on
 * @property string $status
 * @property int $is_deleted
 *
 * @property ProductDetail[] $productDetails
 * @property ProductSpecifications[] $productSpecifications
 * @property ProductVariant[] $productVariants
 * @property Categories $category
 * @property User $createdBy
 * @property User $updatedBy
 * @property Brands $brand
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
            [['product_enc_id', 'category_id', 'brand_id', 'name', 'short_description', 'long_description', 'created_by', 'status'], 'required'],
            [['short_description', 'long_description', 'status'], 'string'],
            [['is_featured', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['product_enc_id', 'category_id', 'brand_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 250],
            [['image'], 'string', 'max' => 100],
            [['product_enc_id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
            [['brand_id'], 'exist', 'skipOnError' => true, 'targetClass' => Brands::className(), 'targetAttribute' => ['brand_id' => 'enc_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_enc_id' => Yii::t('app', 'Product Enc ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'short_description' => Yii::t('app', 'Short Description'),
            'long_description' => Yii::t('app', 'Long Description'),
            'is_featured' => Yii::t('app', 'Is Featured'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'status' => Yii::t('app', 'Status'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[ProductDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductDetails()
    {
        return $this->hasMany(ProductDetail::className(), ['product_enc_id' => 'product_enc_id']);
    }

    /**
     * Gets query for [[ProductSpecifications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductSpecifications()
    {
        return $this->hasMany(ProductSpecifications::className(), ['product_enc_id' => 'product_enc_id']);
    }

    /**
     * Gets query for [[ProductVariants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariants()
    {
        return $this->hasMany(ProductVariant::className(), ['product_enc_id' => 'product_enc_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['enc_id' => 'category_id']);
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
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['enc_id' => 'updated_by']);
    }

    /**
     * Gets query for [[Brand]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBrand()
    {
        return $this->hasOne(Brands::className(), ['enc_id' => 'brand_id']);
    }
}
