<?php

namespace backend\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Model;

class BlogsForm extends Model
{
    public $blog_name;
    public $short_desc;
    public $description;
    public $image;
    public $base64image;
    public $recursive_path;
    public $path;
    public $tb_image;
    public $tb_image_location;
    public $file;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['blog_name', 'short_desc', 'description','image'], 'required'],
            [['description'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function add()
    {
        $model = new Blogs();
        $model->_uid = Yii::$app->security->generateRandomString(15);
        $model->name = $this->blog_name;
        $model->short_description = $this->short_desc;
        $model->description = $this->description;
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->blog->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->blog->image_path;
        $this->tb_image = 'image';
        $this->file = $this->image;
        $this->_flag = $query->saveFile($model, $this, null, $model->_uid);
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Blog added'
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