<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class BlogsEditForm extends Model
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
            [['blog_name', 'short_desc', 'description'], 'required'],
            [['description'], 'string'],
            [['image','base64image'], 'safe'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function update($id)
    {
        $model = Blogs::findOne(['_id' => $id]);
        $model->name = $this->blog_name;
        $model->short_description = $this->short_desc;
        $model->description = $this->description;
        $model->updated_at = date('Y-m-d H:i:s');
        if ($this->image) {
            $query = new SaveQueries();
            $this->path = Yii::$app->params->upload_directories->blog->image_path;
            $this->recursive_path = Yii::$app->params->production->upload_directories->blog->image_path;
            $this->tb_image = 'image';
            $this->file = $this->base64image;
            $this->_flag = $query->saveBase64File($model, $this, null, $model->_uid);
            if(!$this->_flag){
                return [
                 'status' => 201,
                 'title' => 'errors',
                 'message' => 'Image Not Saved'
                ];
            }
        }
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Updated'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => $model->getErrors()
            ];
        }
    }
}