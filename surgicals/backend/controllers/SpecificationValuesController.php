<?php

namespace backend\controllers;

use app\models\PoolSpecificationValues;
use app\models\Products;
use app\models\Specifications;
use Yii;
use app\models\SpecificationValues;
use app\models\search\SpecificationValuesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SpecificationValuesController implements the CRUD actions for SpecificationValues model.
 */
class SpecificationValuesController extends Controller
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
     * Lists all SpecificationValues models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecificationValuesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SpecificationValues model.
     * @param integer $id
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
     * Creates a new SpecificationValues model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SpecificationValues();

        if ($model->load(Yii::$app->request->post())) {
            $model->enc_id = Yii::$app->security->generateRandomString(10);
            $model->created_by = Yii::$app->user->identity->enc_id;
            $chk = PoolSpecificationValues::findOne(['name' => $model->pool_id]);
            if($chk){
                $model->pool_id = $chk->enc_id;
            } else {
                $poolModel = new PoolSpecificationValues();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = $model->pool_id;
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if(!$poolModel->save()){
                    return false;
                }
                $model->pool_id = $poolModel->enc_id;
            }
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $productList = self::getProductList();
        return $this->render('create', [
            'model' => $model,
            'productList' => $productList,
        ]);
    }

    public function getProductList()
    {
        $data = Products::findAll(['is_deleted' => 0]);
        return ArrayHelper::map($data, 'enc_id', 'name');
    }

    public function actionGetSpecifications($id)
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $catId = Products::findOne(['enc_id' => $id])['cat_id'];
            $specNameList = Specifications::findAll(['cat_id' => $catId]);
            $specNameList = ArrayHelper::map($specNameList, 'enc_id', 'pool.name');
            $data = [];
            foreach ($specNameList as $i => $s) {
                array_push($data, '<option value="' . $i . '">' . $s . '</option>');
            }
            return $data;
        }
    }

    /**
     * Updates an existing SpecificationValues model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SpecificationValues model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SpecificationValues model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SpecificationValues the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SpecificationValues::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
