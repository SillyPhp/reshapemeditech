<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Model;

class OurTeamForm extends Model
{
    public $name;
    public $designation;
    public $phone;
    public $description;
    public $charges;
    public $image;
    public $base64image;
    public $path;
    public $recursive_path;
    public $file;
    public $_flag;
    public $tb_image;
    public $tb_image_location;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['name', 'designation', 'phone', 'base64image'], 'required'],
            [['charges', 'description','image'], 'safe'],
            [['name', 'designation'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 15],
        ];
    }

    public function save()
    {
        $model = new OurTeam();
        $model->name = $this->name;
        $model->uid = Yii::$app->getSecurity()->generateRandomString(15);
        $model->designation = $this->designation;
        $model->phone = $this->phone;
        $model->description = $this->description;
        $model->charges = $this->charges;
        if ($this->base64image) {
            $query = new SaveQueries();
            $this->path = Yii::$app->params->upload_directories->team->image_path;
            $this->recursive_path = Yii::$app->params->production->upload_directories->team->image_path;
            $this->file = $this->base64image;
            $this->tb_image = 'image';
            $this->tb_image_location = 'image_location';
            $this->_flag = $query->saveBase64File($model, $this, null, $model->uid);
            if (!$this->_flag) {
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