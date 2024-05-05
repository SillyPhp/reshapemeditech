<?php

namespace backend\controllers;

use app\models\BlogsEditForm;
use app\models\BlogsForm;
use app\models\search\BlogsSearch;
use Yii;
use app\models\Blogs;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * SiteController implements the CRUD actions for Blogs model.
 */
class BlogsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
        $searchModel = new BlogsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Blogs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlogsForm();

        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
        $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->add();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Blogs::findOne(['_id' => $id]);
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

    public function actionUpdate($id)
    {
        $blog = Blogs::find()
            ->where(['_id' => $id])
            ->asArray()->one();
        $model = new BlogsEditForm();
        $model->blog_name = $blog['name'];
        $model->description = $blog['description'];
        $model->short_desc = $blog['short_description'];
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->update($id);
        }
        return $this->render('update', [
            'model' => $model,
            'id' => $blog['_uid'],
            'blog_image' => $blog['image']
        ]);
    }
}
