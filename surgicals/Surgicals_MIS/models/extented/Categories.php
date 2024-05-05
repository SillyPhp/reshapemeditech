<?php

namespace app\models\extented;

use app\models\globals\SaveQueries;
use Yii;
use yii\helpers\ArrayHelper;

class Categories extends \app\models\Categories
{
    public $data;
    public $tb_image;
    public $tb_image_location;
    public $path;
    public $recursive_path;
    public $file;

    public $_flag;

    public function formName()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'string', 'max' => 50],
            [['parent_id'], 'default', 'value'=> NULL],
            [['name'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'jpg, png, svg', 'skipOnEmpty' => true, 'maxFiles' => 1, 'on' => 'imageUploaded'],
        ];
    }

    public function add()
    {
        if (!$this->validate()) {
            $errors = $this->getErrors();
            $error = "";
            foreach ($errors as $key => $value) {
                $error .= implode('<br>', $value) . '<br>';
            }
            return [
                'status' => 201,
                'title' => 'Validation Error',
                'message' => $error
            ];
        };
        $this->enc_id = Yii::$app->security->generateRandomString(10);
        $query = new SaveQueries();
        if ($this->image) {
            $this->path = Yii::$app->params->upload_directories->category->image_path;
            $this->recursive_path = Yii::$app->params->nagpal_telestore->upload_directories->category->image_path;
            $this->tb_image = 'image';
            $this->file = $this->image;
            $this->_flag = $query->saveFile($this, $this, null, null);
            if (!$this->_flag) {
                return [
                    'status' => 201,
                    'title' => 'Image Error',
                    'message' => 'Image Saving problem...'
                ];
            }
        }
        $this->created_by = '21200885095';
        if($this->save()){
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Added Successfully...',
            ];
        } else {
            $errors = $this->getErrors();
            $error = "";
            foreach ($errors as $key => $value) {
                $error .= implode('<br>', $value) . '<br>';
            }
            return [
                'status' => 201,
                'title' => 'model Error',
                'message' => $error
            ];
        }
    }

    public function fetchParentCategories($parent = null, $level = 0)
    {
        $model = \app\models\Categories::find()
            ->select(['enc_id', 'name'])
            ->andWhere(['parent_id' => $parent])
            ->asArray()->all();
//        foreach ($model as $key) {
//            $this->data .= '<option value="' . $key['enc_id'] . '">' . str_repeat('&nbsp', ($level * 3)) . $key['name'] . "</option>";
//            $this->fetchParentCategories($key['enc_id'], $level + 1);
//        }
        $this->data = ArrayHelper::map($model,'enc_id','name');
        return $this->data;
    }

}
