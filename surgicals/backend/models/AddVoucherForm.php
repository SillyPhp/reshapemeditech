<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class AddVoucherForm extends Model
{
    public $brand_id;
    public $category_id;
    public $type;
    public $name;
    public $use_once;
    public $end_datetime;
    public $amount;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['amount', 'type', 'name', 'use_once', 'end_datetime', 'end_datetime'], 'required'],
            [['brand_id', 'category_id'], 'safe'],
        ];
    }

    public function add()
    {
        if(!$this->brand_id && !$this->category_id){
            return [
              'status' => 201,
              'title' => 'Oops!!',
              'message' => 'Please Select Brand or Category',
            ];
        }
        $model = new Vouchers();
        $model->_uid = Yii::$app->security->generateRandomString(15);
        $model->name = $this->name;
        $model->type = $this->type;
        $model->use_once = $this->use_once;
        $model->amount = $this->amount;
        $model->end_datetime = date('Y-m-d H:i:s',strtotime($this->end_datetime));
        if($this->brand_id){
            $model->brand_id = $this->brand_id;
        }
        if($this->category_id){
            $model->category_id = $this->category_id;
        }
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Add Voucher'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Oops!!',
                'message' => 'Something went wrong...'
            ];
        }
    }
}