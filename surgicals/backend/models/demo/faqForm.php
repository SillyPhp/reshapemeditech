<?php

namespace backend\models\demo;

use app\models\globals\SaveQueries;
use Yii;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class faqForm extends Model
{
    public $question;
    public $short_ans;
    public $ans;


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
            [['question','short_ans'], 'required'],
            [['ans'], 'safe'],
            [['question', 'short_ans'], 'string', 'max' => 100],
            [['ans'], 'string'],
        ];
    }
}