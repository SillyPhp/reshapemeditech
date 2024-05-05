<?php

namespace app\controllers;

use Yii;
use app\models\Categories;
use app\models\UserAuthorities;
use app\models\search\CategoriesSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends Controller
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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();
        if ($model->load(Yii::$app->request->post())) {
            $model->enc_id = Yii::$app->security->generateRandomString(10);
            $model->parent_id = NULL;
            $model->image = NULL;
            $model->created_by = Yii::$app->user->identity->enc_id;
            $model->updated_by = Yii::$app->user->identity->enc_id;
            $model->is_deleted = 0;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->enc_id]);
            }
        }

        $parentCatList = self::getParentCategories();
        return $this->render('create', [
            'model' => $model,
            'parentCatList' => $parentCatList,
        ]);
    }

    public function getParentCategories(){
        $list = Categories::findAll(['parent_id' => NULL, 'is_deleted' => 0]);
        return ArrayHelper::map($list, 'enc_id', 'name');
    }
    /**
     * Updates an existing Categories model.
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

        $parentCatList = self::getParentCategories();
        return $this->render('update', [
            'model' => $model,
            'parentCatList' => $parentCatList,
        ]);
    }

    /**
     * Deletes an existing Categories model.
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
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionSubCategory(){
        $categories = Categories::find()
            ->select(['_id' ,'name'])
            ->where(['_parent_id' => null])
            ->andWhere(['not',['status' => 3]])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $searchModel = new \app\models\CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['not',['z._parent_id' => null]]);
        if(Yii::$app->request->isPost && Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $category = Yii::$app->request->post('category');
            $sub_category = Yii::$app->request->post('subcategory');
            $subCategory = Categories::findOne(['name' => $sub_category]);
            if(!$subCategory){
                $subCategory = new Categories();
                $rand = rand();
                $subCategory->_uid = md5($rand);
                $subCategory->status = 1;
                $subCategory->name = $sub_category;
                $subCategory->eo_uid = 'a28462ee-416a-411e-8e62-93ddf21a181f';
                $subCategory->user_authorities__id = 2;
                $subCategory->created_at = date('Y-m-d H:i:s');
                if($subCategory->save()){
                    $_flag = true;
                } else {
                    $_flag = false;
                }
            } else {
                $subCategory->status = 1 ;
                $subCategory->updated_at = date('Y-m-d H:i:s');
                if($subCategory->save()){
                    $_flag = true;
                } else {
                    $_flag = false;
                }
            }
            $model = Categories::find()
                ->where(['_id' => $subCategory->_id])
                ->one();
            $model->_parent_id = $category;
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->save()){
                return [
                  'status' => 200,
                  'title' => 'Success',
                  'message' => 'Sub Category'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'Oops!',
                    'message' => 'Something went wrong..'
                ];
            }

        }
        return $this->render('sub-category', [
            'categories' => $categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
