<?php

namespace frontend\models;

use common\models\AssignMedia;
use Yii;
use yii\base\Model;

class LoginMediaForm extends Model
{

    public $phone_number;
    public $password;

    public function FormName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['phone_number', 'password'], 'required'],
            [['phone_number', 'password'], 'trim'],
            [['phone_number', 'password'], 'filter', 'filter' => '\yii\helpers\HtmlPurifier::process'],
            [['password'], 'string', 'length' => [3, 15]],
        ];
    }
    public function add($id){
        $session = Yii::$app->session;
        $model = AssignMedia::findOne(['id' => $id]);
        if($this->phone_number && $this->password){
            if($model->phone == $this->phone_number){
                if($model->password == md5($this->password)){
                    $session['media_login'] = 'login';
                    return [
                      'status' => 200,
                        'title' => 'success',
                        'message' => 'Login SuccessFully'
                    ];
                } else {
                    return [
                        'status' => 201,
                        'title' => 'error',
                        'message' => 'Password Incorrect'
                    ];
                }
            } else {
                return [
                    'status' => 201,
                    'title' => 'Oops!!',
                    'message' => 'Phone Number Incorrect'
                ];
            }
        }
    }
}