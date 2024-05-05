<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class ServicesForm extends Model
{
    public $service_name;
    public $short_desc;
    public $description;
    public $image;
    public $base64image;
    public $recursive_path;
    public $path;
    public $tb_image;
    public $tb_image_location;
    public $file;
    public $most_service;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['service_name', 'short_desc','image','base64image'], 'required'],
            [['most_service','description'], 'safe'],
            [['description'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function add($id = null,$uid = null,$enc_image = null)
    {
        $model = new Services();
        if($uid){
            $model->_uid = $uid;
        } else {
        $model->_uid = Yii::$app->security->generateRandomString(15);
        }
        $model->name = $this->service_name;
        $model->short_description = $this->short_desc;
        $model->description = $this->description;
        if($this->most_service){
            $model->is_most_service = $this->most_service;
        }
        if($id){
            $model->parent_enc_id = $id;
        }
        if($enc_image){
            $model->image = $enc_image;
        } else {
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->service->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->service->image_path;
        $this->tb_image = 'image';
        $this->file = $this->base64image;
        $this->_flag = $query->saveBase64File($model, $this, null, $model->_uid);
        }
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Service added'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'error',
                'message' => $model->getErrors()
            ];
        }
    }

    public function addSubService($id)
    {
        $model = new SubServices();
        $model->_uid = Yii::$app->security->generateRandomString(15);
        $model->name = $this->service_name;
        $model->short_description = $this->short_desc;
        $model->description = $this->description;
        $model->service_id = $id;
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->service->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->service->image_path;
        $this->tb_image = 'image';
        $this->file = $this->base64image;
        $this->_flag = $query->saveBase64File($model, $this, null, $model->_uid);
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Service added'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'error',
                'message' => $model->getErrors()
            ];
        }
    }
}