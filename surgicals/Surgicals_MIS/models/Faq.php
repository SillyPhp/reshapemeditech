<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%faq}}".
 *
 * @property int $_id
 * @property string $_uid
 * @property string $created_at
 * @property string|null $updated_at
 * @property string $question
 * @property string $answer
 * @property int $type 0 as Others, 1 as Account, 2 as Order, 3 as Payment, 4 as Deliveries , 5 as Cancellations & Modifications, 6 as Returns & Refunds, 7 as Coupon & Flash sales
 * @property int $is_deleted 0 as false , 1 as true
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%faq}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_uid', 'question', 'answer'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['answer'], 'string'],
            [['type', 'is_deleted'], 'integer'],
            [['_uid'], 'string', 'max' => 36],
            [['question'], 'string', 'max' => 255],
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
            'question' => Yii::t('app', 'Question'),
            'answer' => Yii::t('app', 'Answer'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }
}
