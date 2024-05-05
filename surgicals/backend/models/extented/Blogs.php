<?php

namespace backend\models\extented;

use Yii;
use yii\base\Security;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class Blogs extends \app\models\Blogs
{
    public $blog_name;
    public $short_desc;
    public $description;
    public $image;
    public $sharing_image;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['blog_name','short_desc','image','sharing_image'],'required'],
            [['description'], 'string'],
            [['name', 'short_description'], 'string', 'max' => 255],
            [['image','sharing_image'], 'file', 'extensions' => 'png, jpg, jpeg','maxSize' => 1024 * 1024 * 1],
        ];
    }
    public function add(){
        $this->_uid = Yii::$app->security->generateRandomString(15);
        $this->name = $this->blog_name;
        $this->short_description = $this->short_desc;
        $image = Yii::$app->security->generateRandomString(8) . '.' . $this->image->extension;
        $base_path = Yii::$app->params->upload_directories->blogs->image_path.Yii::$app->security->generateRandomString(8).'/';
        if (!is_dir($base_path)) {
            if (!mkdir($base_path, 0755, true)) {
                return false;
            }
        }
        $source_path = $base_path . DIRECTORY_SEPARATOR . $image;
        if ($this->image->saveAs($source_path)) {
            $this->image = $image;
        }
        $this->created_at = date('Y-m-d H:i:s');
        if($this->save()){
            return [
              'status' => 200,
              'title' => 'success',
              'message' => 'Blog added'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'error',
                'message' => 'Something went wrong..'
            ];
        }
        print_r($this);die();
    }
}