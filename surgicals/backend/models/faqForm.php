<?php

namespace app\models;

use Yii;
use yii\base\Model;

class faqForm extends Model
{
    public $question;
    public $answer;
    public $type;


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
            [['question','answer' ,'type'], 'required'],
            [['question'], 'string', 'max' => 255],
            [['answer'], 'string'],
        ];
    }
    public function save(){
        $model = Faq::findOne(['question' => $this->question]);
        if($model){
            $model->question = $this->question;
            $model->answer = $this->answer;
            $model->type = $this->type;
            $model->updated_at = date('Y-m-d H:i:s');
            $type = 'Updated';
        } else {
            $model = new Faq();
            $model->_uid =  Yii::$app->security->generateRandomString(10);
            $model->question = $this->question;
            $model->answer = $this->answer;
            $model->type = $this->type;
            $model->created_at = date('Y-m-d H:i:s');
            $type = 'Added';

        }
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Faq '. $type .' SuccessFully..'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'Error',
                'message' => $model->getErrors()
            ];
        }
    }
}