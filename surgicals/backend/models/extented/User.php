<?php

namespace backend\models\extented;

use app\models\globals\SaveQueries;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class User extends Model
{
    public $first_name;
    public $last_name;
    public $username;
    public $email;


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
            [['first_name','last_name','username','email'], 'required'],
            [['first_name','last_name','username'], 'string', 'max' => 50],
            [['email'], 'email'],
        ];
    }
    public function save(){
        if ($this->validate()) {
            $usersEmail = \app\models\User::findOne(['email' => $this->email]);
            if($usersEmail){
                return [
                  'status' => 201,
                  'title' => 'errors',
                  'message' => 'Email Already exist'
                ];
            }
            $userName = \app\models\User::findOne(['username' => $this->username]);
            if($userName){
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Username Already exist'
                ];
            }
            $user = new \app\models\User();
            $user->enc_id = Yii::$app->security->generateRandomString();
            $user->username = $this->username;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;

            $user->email = $this->email;
            $user->password_hash = Yii::$app->security->generatePasswordHash(Yii::$app->security->generateRandomString());

            $user->generateAuthKey();
            if ($user->save()) {

                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'User add successfully'
                ];

            } else {
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => $user->getErrors()
                ];
            }

        }
    }

}
