<?php

namespace backend\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Model;

class BrandForm extends Model
{
    public $brand_logo;
    public $image;
    public $base64image;
    public $is_popular;
    public $recursive_path;
    public $path;
    public $tb_image;
    public $tb_image_location;
    public $file;
    public $name;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['image', 'brand_logo'], 'required'],
            [['is_popular','name'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function add(){
        $model = new Brands();
        $query = new SaveQueries();
        $model->_uid = Yii::$app->security->generateRandomString(10);
        $this->path = Yii::$app->params->upload_directories->brand->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->brand->image_path;
        $this->tb_image = 'image_enc_name';
        $model->name = $this->name;
        $model->is_popular = ($this->is_popular)?$this->is_popular:0;
        $this->file = $this->image;
        $this->_flag = $query->saveFile($model, $this, null, $model->_uid);
        if ($this->_flag) {
            $model->image_name = $this->image->name;
            $model->created_at = date('Y-m-d H:i:s');
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Image Upload Successfully...'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'error',
                    'message' => $model->getErrors()
                ];
            }
        } else {
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => 'Image Not Saved'
            ];
        }
    }
}