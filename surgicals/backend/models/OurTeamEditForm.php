<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Model;

class OurTeamEditForm extends Model
{
    public $name;
    public $designation;
    public $phone;
    public $description;
    public $image;
    public $charges;
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
            [['name','designation','phone'], 'required'],
            [['description','charges'], 'string'],
            [['image','description'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 1],
        ];
    }
    public function update($id)
    {
        $model = OurTeam::findOne(['id' => $id]);
        $model->name = $this->name;
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