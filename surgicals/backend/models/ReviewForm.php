<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Model;

class ReviewForm extends Model
{
    public $client_name;
    public $comment;
    public $designation;
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
            [['client_name', 'comment','image','designation','base64image'], 'required'],
            [['comment'], 'string', 'max' => 255],
            [['client_name','designation'], 'string', 'max' => 50],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }

    public function add()
    {
        $model = new ClientReviews();
        $model->_uid = Yii::$app->security->generateRandomString(15);
        $model->name = $this->client_name;
        $model->designation = $this->designation;
        $model->description = $this->comment;
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->client->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->client->image_path;
        $this->tb_image = 'image';
        $this->file = $this->base64image;
        $this->_flag = $query->saveBase64File($model, $this, null, $model->_uid);
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Client says added'
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