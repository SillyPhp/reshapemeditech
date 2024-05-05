<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class AssignMediaForm extends Model
{
    public $name;
    public $email;
    public $phone_num;
    public $password;
    public $expiry_date;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['name', 'phone_num', 'email', 'expiry_date'], 'required'],
            [['password'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['phone_num'], 'string', 'max' => 15],
            [['password'], 'string', 'min' => 3, 'max' => 15],
        ];
    }
    public function add($id){
        $model = new AssignMedia();
        $model->_uid = Yii::$app->security->generateRandomString(10);
        $model->media_id = $id;
        $model->created_at = date('Y-m-d H:i:s');
        $model->user_name = $this->name;
        $model->phone = $this->phone_num;
        $model->email = $this->email;
        $model->expiry_date_number = $this->expiry_date;
        $model->has_token_key = Yii::$app->security->generateRandomString(15);
        if($model->save()){
            return [
              'status' => 200,
              'title' => 'success',
              'message' => 'Assign Media'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => 'Something went wrong..'
            ];
        }
    }
}