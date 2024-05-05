<?php

namespace app\models\extented;

use app\models\PoolDetailGroups;
use yii\db\Exception;
use Yii;

class ProductCombinations extends \app\models\ProductCombinations
{
    public $_flag;

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
//    public function rules()
//    {
//        return [
//            [['cat_id', 'pool_id'], 'required'],
//            [['cat_id'], 'string', 'max' => 50],
//        ];
//    }


    public function getVariants()
    {
        return $this->hasMany(\app\models\Products::className(), ['variant_id' => 'enc_id']);
    }
}
