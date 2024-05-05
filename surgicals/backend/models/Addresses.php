<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "addresses".
 *
 * @property int $id
 * @property string $enc_id
 * @property string $fullname
 * @property string|null $phone alternative phone number
 * @property string|null $email alternative email id to send bill copy
 * @property string $address1
 * @property string|null $address2
 * @property string|null $landmark
 * @property int $pincode
 * @property string $city_id
 * @property string $created_on
 * @property string $created_by
 * @property string|null $updated_on
 * @property string|null $updated_by
 * @property int $is_default 0 as false, 1 as true
 * @property int $is_deleted
 *
 * @property Cities $city
 * @property User $createdBy
 * @property User $updatedBy
 */
class Addresses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addresses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enc_id', 'fullname', 'address1', 'pincode', 'city_id', 'created_by'], 'required'],
            [['address1', 'address2', 'landmark'], 'string'],
            [['pincode', 'is_default', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['enc_id', 'city_id', 'created_by', 'updated_by'], 'string', 'max' => 50],
            [['fullname'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 15],
            [['enc_id'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'enc_id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'enc_id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'enc_id']],
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
            'fullname' => Yii::t('app', 'Fullname'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address1' => Yii::t('app', 'Address1'),
            'address2' => Yii::t('app', 'Address2'),
            'landmark' => Yii::t('app', 'Landmark'),
            'pincode' => Yii::t('app', 'Pincode'),
            'city_id' => Yii::t('app', 'City ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'is_default' => Yii::t('app', 'Is Default'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['enc_id' => 'city_id']);
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
}
