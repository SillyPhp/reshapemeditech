<?php

namespace backend\controllers;

use app\models\Blogs;
use app\models\BlogsEditForm;
use app\models\globals\SaveQueries;
use app\models\search\ServicesSearch;
use app\models\search\SubServicesSearch;
use app\models\ServicesEditForm;
use app\models\ServicesForm;
use app\models\SubServices;
use Yii;
use app\models\Services;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

class ServicesController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Blogs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['parent_enc_id' => NULL]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $model = new ServicesForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $uid = Yii::$app->request->post('uid');
            $enc_image = Yii::$app->request->post('enc_image');
            return $model->add($id=null,$uid,$enc_image);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUploadImage(){
        if(Yii::$app->request->isPost && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $controllerid = Yii::$app->controller->id;
            $actionid = Yii::$app->controller->action->id;
            $image = UploadedFile::getInstanceByName('image');
            $baseImage = Yii::$app->request->post('baseImage');
            $uid = Yii::$app->getSecurity()->generateRandomString(15);
            $query = new SaveQueries();
            switch([$controllerid,$actionid]){
                case ['services','create']:
                case ['services','create-sub-services']:
                    $path = Yii::$app->params->upload_directories->service->image_path;
                    $recursive_path = Yii::$app->params->production->upload_directories->service->image_path;
                    $tb_image = 'image';
                    break;
            }
            $file = $baseImage;
            return $query->saveBase64FileDirect($path, $recursive_path,$tb_image,$file, null, $uid);


        }
    }
    public function actionUpdate($id)
    {
        $service = Services::find()
            ->where(['_uid' => $id])
            ->asArray()->one();
        $model = new ServicesEditForm();
        $model->service_name = $service['name'];
        $model->description = $service['description'];
        $model->short_desc = $service['short_description'];
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->update($id);
        }
        return $this->render('update', [
            'model' => $model,
            'id' => $service['_uid'],
            'service_image' => $service['image']
        ]);
    }
    public function actionSubUpdate($id)
    {
        $service = Services::find()
            ->where(['_uid' => $id])
            ->asArray()->one();
        $model = new ServicesEditForm();
        $model->service_name = $service['name'];
        $model->description = $service['description'];
        $model->short_desc = $service['short_description'];
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->update($id);
        }
        return $this->render('sub-update', [
            'model' => $model,
            'id' => $service['_uid'],
            'parent_id' => $service['parent_enc_id'],
            'service_image' => $service['image']
        ]);
    }
    public function actionTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Services::findOne(['id' => $id]);
            $model->is_deleted = 1;
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'Delete Successfully..'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Something went wrong...'
                ];
            }

        }
    }
    public function actionSubTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Services::findOne(['_uid' => $id]);
            $model->is_deleted = 1;
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'Delete Successfully..'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Something went wrong...'
                ];
            }

        }
    }
    public function actionSubServices($id){
        $searchModel = new ServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['parent_enc_id' => $id]);
        $dataProvider->query->andWhere(['is_deleted' => 0]);

        return $this->render('sub-services', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id
        ]);
    }
    public function actionCreateSubServices($id){
        $model = new ServicesForm();
        $service = Services::findOne(['_uid' => $id]);
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $uid = Yii::$app->request->post('uid');
            $enc_image = Yii::$app->request->post('enc_image');
            return $model->add($id,$uid,$enc_image);
        }
        return $this->render('create-sub-services', [
            'model' => $model,
            'id' => $id,
            'service' => $service
        ]);
    }
}