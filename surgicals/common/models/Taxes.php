<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%taxes}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property int $status
 * @property string|null $title
 * @property string|null $eo_uid
 * @property float|null $tax_amount
 * @property int|null $type
 * @property int $tax_presets__id
 *
 * @property TaxPresets $taxPresets
 */
class Taxes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%taxes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'created_at', 'status', 'tax_presets__id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['status', 'type', 'tax_presets__id'], 'integer'],
            [['tax_amount'], 'number'],
            [['_uid', 'eo_uid'], 'string', 'max' => 36],
            [['title'], 'string', 'max' => 150],
            [['_uid'], 'unique'],
            [['tax_presets__id'], 'exist', 'skipOnError' => true, 'targetClass' => TaxPresets::className(), 'targetAttribute' => ['tax_presets__id' => '_id']],
        ];
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
}
