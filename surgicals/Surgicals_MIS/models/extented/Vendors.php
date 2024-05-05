<?php

namespace app\models\extented;

use Yii;

class Vendors extends \app\models\Vendors
{
    public $_flag;

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name'], 'required'],
            [['user_id'], 'string', 'max' => 50],
            [['address'], 'safe'],
            [['phone'], 'string', 'min' => 10],
            [['phone'], 'string', 'max' => 10],
            [['user_id', 'email'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['email'], 'email'],
        ];
    }

    public function add(){
        return 'okk';
    }
}
