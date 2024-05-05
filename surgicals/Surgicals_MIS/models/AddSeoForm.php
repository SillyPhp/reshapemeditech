<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class AddSeoForm extends Model
{
    public $route;
    public $title;
    public $description;
    public $keywords;
    public $image;
    public $path;
    public $tb_image;
    public $tb_image_location;
    public $recursive_path;
    public $file;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['route', 'title', 'description' ,'keywords'], 'required'],
            [['description'], 'string'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function add()
    {
        $model = Seo::find()
        ->where(['route' => $this->route, 'is_deleted' => 0])
        ->one();
        if(empty($model)){
            $model = new Seo();
            $model->_uid = Yii::$app->security->generateRandomString(15);
            $model->title = $this->title;
            $model->description = $this->description;
            $model->route = $this->route;
            $model->keywords = $this->keywords;
            if($this->image) {
                $query = new SaveQueries();
                $this->path = Yii::$app->params->upload_directories->seo->image_path;
                $this->recursive_path = Yii::$app->params->production->upload_directories->seo->image_path;
                $this->tb_image = 'image_enc_name';
                $this->file = $this->image;
                $this->_flag = $query->saveFile($model, $this, null, $model->_uid);
                if(!$this->_flag){
                    return [
                        'status' => 201,
                        'title' => 'Oops!!',
                        'message' => 'Image error'
                    ];
                }
            }
            $model->created_at = date('Y-m-d H:i:s');
    } else {
            return [
              'status' => 201,
              'title' => 'Oops!!',
              'message' => 'Route Already added'
            ];
        }
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'SEO Added',
                'message' => 'Successfully'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Oops!!',
                'message' => 'Something went wrong'
            ];
        }
    }
    public function edit($id){
        $model = Seo::find()
            ->where(['_uid' => $id])
            ->one();
        $model->title = $this->title;
        $model->description = $this->description;
        $model->keywords = $this->keywords;
        $model->updated_at = date('Y-m-d H:i:s');
        if($this->image) {
            $query = new SaveQueries();
            $this->path = Yii::$app->params->upload_directories->seo->image_path;
            $this->recursive_path = Yii::$app->params->production->upload_directories->seo->image_path;
            $this->tb_image = 'image_enc_name';
            $this->file = $this->image;
            $this->_flag = $query->saveFile($model, $this, null, $model->_uid);
            if(!$this->_flag){
                return [
                    'status' => 201,
                    'title' => 'Oops!!',
                    'message' => 'Image error'
                ];
            }
        }
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'SEO Update',
                'message' => 'Successfully'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Oops!!',
                'message' => 'Something went wrong'
            ];
        }
    }
}