<?php

namespace backend\controllers;

use app\models\Faq;
use app\models\faqForm;
use app\models\search\FaqSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

class FaqController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['is_deleted' => 0]);
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionCreate($id = null){
        $model = new faqForm();
        if($id){
            $data = Faq::findOne(['_uid' => $id]);
            $model->question = $data->question;
            $model->answer = $data->answer;
            $model->type = $data->type;
        }
        if($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->save();
        }
        return $this->render('create',[
            'model' => $model
        ]);
    }
}