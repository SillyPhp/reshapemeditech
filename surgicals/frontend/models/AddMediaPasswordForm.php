<?php

namespace frontend\models;

use common\models\AssignMedia;
use Yii;
use yii\base\Model;

class AddMediaPasswordForm extends Model {

    public $password;
    public $confirm_password;

    public function FormName()
    {
        return '';
    }
    public function rules()
    {
        return [
            [['password', 'confirm_password'], 'required'],
            [['password', 'confirm_password'], 'trim'],
            [['password', 'confirm_password'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
            [['password', 'confirm_password'], 'string', 'length' => [3, 15]],
            [['confirm_password'], 'compare', 'compareAttribute' => 'password'],
        ];
    }
    public function add($id){
        $model = AssignMedia::findOne(['id' => $id]);
        if ($this->password && $this->confirm_password) {
        $model->password = md5($this->password);
        $model->updated_at = date('Y-m-d H:i:s');
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Password Set SuccessFully..'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Oops!!',
                'message' => 'Password Not Set'
            ];
        }
        } else {
            return [
                'status' => 201,
                'title' => 'Error',
                'message' => 'All Fields are required!!'
            ];
        }
    }
}