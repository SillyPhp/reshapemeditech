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

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['video_name'], 'required'],
            [['video_name'], 'file', 'extensions' => 'mp4, mts, avi,mov', 'maxSize' => 1024 * 1024 * 1],
        ];
    }
    public function add()
    {
    print_r($this);die();
    }
}