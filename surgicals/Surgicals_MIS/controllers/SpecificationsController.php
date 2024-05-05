<?php

namespace app\controllers;

use app\models\Categories;
use app\models\DetailGroups;
use app\models\PoolDetailGroups;
use app\models\PoolSpecifications;
use Yii;
use app\models\Specifications;
use app\models\search\SpecificationsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SpecificationsController implements the CRUD actions for Specifications model.
 */
class SpecificationsController extends Controller
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
     * Lists all Specifications models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SpecificationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Specifications model.
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
     * Creates a new Specifications model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new \app\models\extented\Specifications();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $result = $model->add();
            if ($result) {
                self::refresh();
            } else {
                return $result;
            }
        }

        $categoryList = self::getCategories();
        $detailGroupList = self::getDetailGroupList();
        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList,
            'detailGroupList' => $detailGroupList,
        ]);
    }

    public function getDetailGroupList()
    {
        $list = DetailGroups::find()->all();
        return ArrayHelper::map($list, 'enc_id', 'pool.name');
    }

    public function getCategories()
    {
        $list = Categories::find()->asArray()->all();
        return ArrayHelper::map($list, 'enc_id', 'name');
    }

    public function actionGetGroupDetails($id)
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $specNameList = DetailGroups::findAll(['cat_id' => $id]);
            $specNameList = ArrayHelper::map($specNameList, 'enc_id', 'pool.name');
            $data = [];
            foreach ($specNameList as $i => $s) {
                array_push($data, '<option value="' . $i . '">' . $s . '</option>');
            }
            return $data;
        }
    }

    /**
     * Updates an existing Specifications model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->enc_id]);
        }
        $categoryList = self::getCategories();
        $detailGroupList = self::getDetailGroupList();
        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList,
            'detailGroupList' => $detailGroupList,
        ]);
    }

    /**
     * Deletes an existing Specifications model.
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
     * Finds the Specifications model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Specifications the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Specifications::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
