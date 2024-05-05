<?php

namespace app\controllers;

use app\models\BrandForm;
use app\models\ImagesForm;
use Yii;
use app\models\Brands;
use app\models\search\BrandsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BrandsController implements the CRUD actions for Brands model.
 */
class BrandsController extends Controller
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

    public function beforeAction($action)
    {
        if ($action->id == 'index' || $action->id == '' || $action->id == 'trash') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    /**
     * Lists all Brands models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new BrandForm();
        $searchModel = new BrandsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstanceByName('brand_logo');
            return $model->add();
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single Brands model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brands model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Brands();

        $model->enc_id = Yii::$app->security->generateRandomString(10);
        $model->created_by = Yii::$app->user->identity->enc_id;
        if ($model->load(Yii::$app->request->post())) {
            if (!$model->parent_id) {
                $model->parent_id = NULL;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->enc_id]);
            }
        }
        $parentList = self::getParentList();
        return $this->render('create', [
            'model' => $model,
            'parentList' => $parentList,
        ]);
    }

    public function getParentList()
    {
        $list = Brands::find()->asArray()->all();
        return ArrayHelper::map($list, 'enc_id', 'name');
    }

    /**
     * Updates an existing Brands model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->parent_id) {
                $model->parent_id = NULL;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->enc_id]);
            }
        }
        $parentList = self::getParentList();
        return $this->render('update', [
            'model' => $model,
            'parentList' => $parentList,
        ]);
    }

    /**
     * Deletes an existing Brands model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Brands model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Brands the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brands::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionTrash(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = Brands::findOne(['_id' => $id]);
            $model->updated_at = date('Y-m-d H:i:s');
            $model->is_deleted = 1;
            if($model->save()){
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'Brand Deleted SuccessFully'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Something went wrong..'
                ];
            }
        }
    }
}
