<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class ImagesForm extends Model
{
    public $image;
    public $base64image;
    public $is_cover_image;
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
            [['image'], 'required'],
            [['is_cover_image','name'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function save($id)
    {
        $model = new ProductCombinationMedia();
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->product->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->product->image_path;
        $this->tb_image = 'file_enc_name';
        $this->file = $this->image;
        $this->_flag = $query->saveFile($model, $this, null, $id);
        if ($this->_flag) {
            $model->_uid = Yii::$app->security->generateRandomString(15);
            $model->file_name = $this->image->name;
            $model->product_combination__id = $id;
            if ($this->is_cover_image) {
                $model->is_cover_image = 1;
            }
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