<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class PrayerForm extends Model
{
    public $title;
    public $description;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }
    public function save(){
        $model = new Prayers();
        $model->uid = Yii::$app->security->generateRandomString(15);
        $model->title = $this->title;
        $model->description = $this->description;
        $model->created_at = date('Y-m-d H:i:s');
        if($model->save()){
            return [
              'status' => 200,
              'title' => 'success',
              'message' => 'Prayer Add Successfully..'
            ];
        } else {
            return [
              'status' => 201,
              'title' => 'Oops!!',
              'message' => 'Something went wrong..'
            ];
        }
    }
    public function update($id){
        $model = Prayers::findOne(['uid' => $id]);
        $model->title = $this->title;
        $model->description = $this->description;
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Prayer Update Successfully..'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Oops!!',
                'message' => 'Something went wrong..'
            ];
        }
    }
}