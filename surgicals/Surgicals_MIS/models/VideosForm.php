<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class VideosForm extends Model
{
    public $video_name;
    public $video_title;
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
            [['video_title','video_name'], 'required'],
            [['video_title'], 'string', 'max' => 100],
            [['video_name'], 'file', 'extensions' => 'mp4,mp3, mts, avi,mov'],
        ];
    }
    public function add()
    {
        $model = new Videos();
        $model->_uid = Yii::$app->security->generateRandomString(15);
        $model->title = $this->video_title;
        $query = new SaveQueries();
        $this->path = Yii::$app->params->upload_directories->video->image_path;
        $this->recursive_path = Yii::$app->params->production->upload_directories->video->image_path;
        $this->tb_image = 'video';
        $this->file = $this->video_name;
        $this->_flag = $query->saveFile($model, $this, null, $model->_uid);
        $model->created_at = date('Y-m-d H:i:s');
        if ($model->save()) {
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Video added'
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