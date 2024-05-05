<?php

namespace backend\controllers;

use app\models\AssignedMediaFiles;
use app\models\Brands;
use app\models\Categories;
use app\models\Colours;
use app\models\Flavours;
use app\models\globals\SaveQueries;
use app\models\ImagesForm;
use app\models\MediaFiles;
use app\models\PoolColours;
use app\models\PoolSpecificationValues;
use app\models\PoolVariants;
use app\models\ProductCombinationMedia;
use app\models\ProductCombinations;
use app\models\ProductCombinationsFlavours;
use app\models\ProductCombinationsOptions;
use app\models\ProductImages;
use app\models\search\ProductCombinationsSearch;
use app\models\Specifications;
use app\models\SpecificationValues;
use app\models\SpecificationVariantValues;
use app\models\Stocks;
use app\models\Variants;
use Imagine\Filter\Basic\Save;
use Yii;
use app\models\Products;
use app\models\search\ProductsSearch;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    public $recursive_path;
    public $path;
    public $tb_image;
    public $tb_image_location;
    public $file;
    public $_flag;

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
        if ($action->id == 'images') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }
    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductCombinationsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = Categories::find()
            ->select(['_id' ,'name'])
            ->where(['not',['_parent_id' => null]])
            ->andWhere(['not',['status' => 3]])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories
        ]);
    }
    public function actionFlavours($id){
        if(Yii::$app->request->isAjax && Yii::$app->request->post()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
                $name = Yii::$app->request->post('flavour_name');
                $price = Yii::$app->request->post('flavour_price');
                $total_flavours = count($name);
                for($i =0; $i< $total_flavours; $i++){
                    if($name['flavour_'.$i]) {
                        $flavour = Flavours::findOne(['name' => $name['flavour_' . $i]]);
                        if (!$flavour) {
                            $flavour = new Flavours();
                            $flavour->_uid = Yii::$app->security->generateRandomString(15);
                            $flavour->name = $name['flavour_' . $i];
                        } else {
                            $flavour->is_deleted = 0;
                        }
                        $flavour->save();
                        $combination = ProductCombinationsFlavours::findOne(['product_combination_id' => $id, 'flavour_id' => $flavour->_id]);
                        if (!$combination) {
                            $combination = new ProductCombinationsFlavours();
                            $combination->_uid = Yii::$app->security->generateRandomString(15);
                            $combination->product_combination_id = $id;
                            $combination->flavour_id = $flavour->_id;
                            $combination->price = $price['flavour_' . $i];
                            $combination->created_at = date('Y-m-d H:i:s');
                        } else {
                            $combination->price = $price['flavour_' . $i];
                            $combination->is_deleted = 0;
                            $combination->updated_at = date('Y-m-d H:i:s');
                        }
                        if ($combination->save()) {
                            $_flag = true;
                        } else {
                            $_flag = false;
                        }
                    }
                }
            if($_flag){
                return [
                  'status' => 200,
                  'title' => 'success',
                  'message' => 'Add Flavours',
                ];
            } else {
                return [
                  'status' => 201,
                  'title' => 'Oops!!',
                    'message' => 'Something went wrong..'
                ];
            }
        }
        $flavours = ProductCombinationsFlavours::find()->where(['product_combination_id' => $id,'is_deleted' => 0])->all();
        $all_flavours = count($flavours);
        return $this->render('flavours',[
            'id' => $id,
            'flavours' => $flavours,
            'all_flavours' => $all_flavours
        ]);
    }
    public function actionProduct(){
        $searchModel = new \app\models\ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $brands = Brands::find()
            ->select(['_id', 'name'])
            ->andWhere(['is_deleted' => 0])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        return $this->render('product-view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'brands' => $brands,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

//        print_r(Yii::$app->request->post());exit();
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $query = new SaveQueries();
            $model->media_id = UploadedFile::getInstance($model, 'media_id');
            $model->enc_id = Yii::$app->security->generateRandomString(10);
            $model->status = 'Active';
            $model->created_by = Yii::$app->user->identity->enc_id;
            $model->slug = str_replace(' ', '-', strtolower($model->name));
            if ($model->media_id) {
                $mediaFileModel = new MediaFiles();
                $mediaFileModel->enc_id = Yii::$app->security->generateRandomString(10);
                $mediaFileModel->file_name = $model->media_id->name;
                $mediaFileModel->created_by = Yii::$app->user->identity->enc_id;
                $this->path = Yii::$app->params->upload_directories->product->image_path;
                $this->recursive_path = Yii::$app->params->nagpal_telestore->upload_directories->product->image_path;
                $this->tb_image = 'enc_name';
                $this->file = $model->media_id;
                $this->_flag = $query->saveFile($mediaFileModel, $this, null, $model->enc_id);
                if (!$this->_flag) {
                    return false;
                }
                if (!$mediaFileModel->save() || !$mediaFileModel->validate()) {
                    print_r($mediaFileModel->getErrors());
                    exit();
                }
                $model->media_id = $mediaFileModel->enc_id;
            }
            if (!$model->save() || !$model->validate()) {
                print_r($model->getErrors());
                exit();
            } else {
                return $this->redirect(['index']);
            }
        }
        $categoryList = self::getCategories();
        $brandList = self::getBrands();
        return $this->render('create', [
            'model' => $model,
            'categoryList' => $categoryList,
            'brandList' => $brandList,
        ]);
    }

    public function getCategories()
    {
        $data = Categories::find()
            ->where(['is_deleted' => 0])
            ->orderBy(['name' => SORT_ASC])
            ->all();
        return ArrayHelper::map($data, 'enc_id', 'name');
    }

    public function getBrands()
    {
        $data = Brands::find()->all();
        return ArrayHelper::map($data, 'enc_id', 'name');
    }

    public function getColors($id)
    {
        $data = Colours::findAll(['product_id' => $id]);
        return ArrayHelper::map($data, 'enc_id', 'colour.name');
    }

    public function getVariants($id)
    {
        $data = Variants::findAll(['product_id' => $id]);
        return ArrayHelper::map($data, 'enc_id', 'variant.name');
    }

    public function actionProfile($id)
    {
        $model = ProductCombinations::findOne(['_uid' => $id]);
        $brandList = json_encode(self::getBrands());
        $colours = self::getColors($model->enc_id);
        $variants = self::getVariants($model->enc_id);
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $color_id = Yii::$app->request->post('Products')['id'];
            $images = UploadedFile::getInstances($model, 'media_id');
            $this->_flag = self::uploadImages($images, $color_id, $model->enc_id);
            if (!$this->_flag) {
                return false;
            }
            self::refresh();
        }
        return $this->render('profile', [
            'model' => $model,
            'brandList' => $brandList,
            'colours' => $colours,
            'variants' => $variants,
        ]);
    }

    public function actionChangeHighlight()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = SpecificationValues::findOne(['enc_id' => $id]);
            $value = 1;
            if ($model->is_highlighted) {
                $value = 0;
            }
            $model->is_highlighted = $value;
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function uploadImages($images, $color_id, $product_id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $query = new SaveQueries();
            foreach ($images as $img) {
                $mediaFileModel = new MediaFiles();
                $mediaFileModel->enc_id = Yii::$app->security->generateRandomString(10);
                $mediaFileModel->file_name = $img->name;
                $this->path = Yii::$app->params->upload_directories->product->image_path;
                $this->recursive_path = Yii::$app->params->nagpal_telestore->upload_directories->product->image_path;
                $this->tb_image = 'enc_name';
                $this->file = $img;
                $this->_flag = $query->saveFile($mediaFileModel, $this, $transaction, $product_id);
                if (!$this->_flag) {
                    $transaction->rollBack();
                    return false;
                }
                $mediaFileModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$mediaFileModel->save() || !$mediaFileModel->validate()) {
                    $transaction->rollBack();
                    return false;
                }
                $productImages = new ProductImages();
                $productImages->enc_id = Yii::$app->security->generateRandomString(10);
                $productImages->product_id = $product_id;
                $productImages->media_file_id = $mediaFileModel->enc_id;
                $productImages->colour_id = $color_id;
                $productImages->created_by = Yii::$app->user->identity->enc_id;
                if (!$productImages->save() || !$productImages->validate()) {
                    $transaction->rollBack();
                    return false;
                }
            }
            $transaction->commit();
            return true;
        } catch (yii\db\Exception $e) {
            $transaction->rollBack();
            return $e->getMessage();
        }
    }

    public function actionClearMyCache()
    {
        $cache = Yii::$app->cache->flush();

        if ($cache) {
            $this->redirect(Yii::$app->request->referrer);
        } else {
            $this->redirect('/jobs/clear-my-cache');
            return 'something went wrong...! please try again later';
        }
    }

    public function actionAddCategory()
    {
        if (Yii::$app->request->isPost) {
            $catName = Yii::$app->request->post('cat_name');
            $chk = Categories::findOne(['name' => $catName]);
            if (!$chk) {
                $model = new Categories();
                $model->enc_id = Yii::$app->security->generateRandomString(10);
                $model->name = ucwords(trim($catName));
                $model->created_by = Yii::$app->user->identity->enc_id;
                if (!$model->save()) {
                    return 201;
                }
                return 200;
            } else {
                return 302;
            }
        }
    }

    public function actionAddBrand()
    {
        if (Yii::$app->request->isPost) {
            $brandName = Yii::$app->request->post('brand_name');
            $chk = Brands::findOne(['name' => $brandName]);
            if (!$chk) {
                $model = new Brands();
                $model->enc_id = Yii::$app->security->generateRandomString(10);
                $model->name = ucwords(trim($brandName));
                $model->created_by = Yii::$app->user->identity->enc_id;
                if (!$model->save()) {
                    return 201;
                }
                return 200;
            } else {
                return 302;
            }
        }
    }

    public function actionAddColour()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $color = Yii::$app->request->post('color');
            $colorModel = new Colours();
            $colorModel->enc_id = Yii::$app->security->generateRandomString(10);
            $colorModel->product_id = $id;
            $chk = PoolColours::findOne(['name' => $color]);
            if ($chk) {
                $colorModel->colour_id = $chk->enc_id;
            } else {
                $poolModel = new PoolColours();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = ucwords($color);
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $colorModel->colour_id = $poolModel->enc_id;
            }
            $colorModel->created_by = Yii::$app->user->identity->enc_id;
            if (!$colorModel->save()) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function actionAddVariant()
    {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $variant = Yii::$app->request->post('variant');
            $variantModel = new Variants();
            $variantModel->enc_id = Yii::$app->security->generateRandomString(10);
            $variantModel->product_id = $id;
            $chk = PoolVariants::findOne(['name' => $variant]);
            if ($chk) {
                $variantModel->variant_id = $chk->enc_id;
            } else {
                $poolModel = new PoolVariants();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = ucwords($variant);
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $variantModel->variant_id = $poolModel->enc_id;
            }
            $variantModel->created_by = Yii::$app->user->identity->enc_id;
            if (!$variantModel->save()) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function actionXeditColor()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('pk');
            $name = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');
            $model = Colours::findOne(['enc_id' => $id]);
            $chk = PoolColours::findOne(['name' => $value]);
            if ($chk) {
                $model->colour_id = $chk->enc_id;
            } else {
                $poolModel = new PoolColours();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = ucwords($value);
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $model->colour_id = $poolModel->enc_id;
            }
            if ($model->hasAttribute('updated_by')) {
                $model->updated_by = Yii::$app->user->identity->enc_id;
            }
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function actionXeditVariant()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('pk');
            $name = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');
            $model = Variants::findOne(['enc_id' => $id]);
            $chk = PoolVariants::findOne(['name' => $value]);
            if ($chk) {
                $model->variant_id = $chk->enc_id;
            } else {
                $poolModel = new PoolVariants();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = ucwords($value);
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $model->variant_id = $poolModel->enc_id;
            }
            if ($model->hasAttribute('updated_by')) {
                $model->updated_by = Yii::$app->user->identity->enc_id;
            }
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function actionXeditStock()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('pk');
            $variant_id = Yii::$app->request->post('variant_id');
            $color_id = Yii::$app->request->post('color_id');
            $name = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');
            if ($id) {
                $model = Stocks::findOne(['enc_id' => $id]);
            } else {
                $model = Stocks::findOne(['colour_id' => $color_id, 'variant_id' => $variant_id]);
                if (!$model) {
                    $model = new Stocks();
                    $model->enc_id = Yii::$app->security->generateRandomString(20);
                    $model->colour_id = $color_id;
                    $model->variant_id = $variant_id;
                    $model->created_by = Yii::$app->user->identity->enc_id;
                }
            }
            $model->$name = $value;
            if ($model->hasAttribute('updated_by')) {
                $model->updated_by = Yii::$app->user->identity->enc_id;
            }
            if ($model->save()) {
                return true;
            } else {
                return $model->getErrors();
                return false;
            }
        }
    }

    public function actionXeditable()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('pk');
            $name = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');
            $model = Products::findOne(['enc_id' => $id]);
            $model->$name = $value;
            if ($model->hasAttribute('last_updated_by')) {
                $model->last_updated_by = Yii::$app->user->identity->user_enc_id;
            }
            if ($model->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function actionXedit()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $product_id = Yii::$app->request->post('pk');
            $specification_id = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');

            $updateModel = SpecificationValues::findOne(['product_id' => $product_id, 'specification_id' => $specification_id]);
            if (!$updateModel) {
                $updateModel = new SpecificationValues();
                $updateModel->enc_id = Yii::$app->security->generateRandomString(10);
                $updateModel->product_id = $product_id;
                $updateModel->specification_id = $specification_id;
                $updateModel->created_by = Yii::$app->user->identity->enc_id;
            }
            $chk = PoolSpecificationValues::findOne(['name' => $value]);
            if ($chk) {
                $updateModel->pool_id = $chk->enc_id;
            } else {
                $poolModel = new PoolSpecificationValues();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = $value;
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $updateModel->pool_id = $poolModel->enc_id;
            }
            if ($updateModel->hasAttribute('updated_by')) {
                $updateModel->updated_by = Yii::$app->user->identity->enc_id;
            }
            if ($updateModel->save()) {
                return true;
            } else {
                return $updateModel->getErrors();
//                return false;
            }
        }
    }

    public function actionXeditVariantValues()
    {
        $referrerUrl = explode('/', Yii::$app->request->referrer)[4];
        $actionid = explode('?', $referrerUrl)[0];
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $variant_id = Yii::$app->request->post('pk');
            $specification_id = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');

            $updateModel = SpecificationVariantValues::findOne(['variant_id' => $variant_id, 'specification_id' => $specification_id]);
            if (!$updateModel) {
                $updateModel = new SpecificationVariantValues();
                $updateModel->enc_id = Yii::$app->security->generateRandomString(10);
                $updateModel->variant_id = $variant_id;
                $updateModel->specification_id = $specification_id;
                $updateModel->created_by = Yii::$app->user->identity->enc_id;
            }
            $chk = PoolSpecificationValues::findOne(['name' => $value]);
            if ($chk) {
                $updateModel->pool_id = $chk->enc_id;
            } else {
                $poolModel = new PoolSpecificationValues();
                $poolModel->enc_id = Yii::$app->security->generateRandomString(10);
                $poolModel->name = $value;
                $poolModel->created_by = Yii::$app->user->identity->enc_id;
                if (!$poolModel->save()) {
                    return false;
                }
                $updateModel->pool_id = $poolModel->enc_id;
            }
            if ($updateModel->hasAttribute('updated_by')) {
                $updateModel->updated_by = Yii::$app->user->identity->enc_id;
            }
            if ($updateModel->save()) {
                return true;
            } else {
                return $updateModel->getErrors();
//                return false;
            }
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $query = new SaveQueries();
            $model->media_id = UploadedFile::getInstance($model, 'media_id');
            if ($model->media_id) {
                $mediaFileModel = new MediaFiles();
                $mediaFileModel->enc_id = Yii::$app->security->generateRandomString(10);
                $mediaFileModel->file_name = $model->media_id->name;
                $mediaFileModel->created_by = Yii::$app->user->identity->enc_id;
                $this->path = Yii::$app->params->upload_directories->product->image_path;
                $this->recursive_path = Yii::$app->params->nagpal_telestore->upload_directories->product->image_path;
                $this->tb_image = 'enc_name';
                $this->file = $model->media_id;
                $this->_flag = $query->saveFile($mediaFileModel, $this, null, $model->enc_id);
                if (!$this->_flag) {
                    return false;
                }
                if (!$mediaFileModel->save() || !$mediaFileModel->validate()) {
                    print_r($mediaFileModel->getErrors());
                    exit();
                }
                $model->media_id = $mediaFileModel->enc_id;
            }
            if ($model->save()) {
//                return $this->redirect(['index']);
                return $this->redirect(['view', 'id' => $model->enc_id]);
            }
        }

        $categoryList = self::getCategories();
        $brandList = self::getBrands();
        return $this->render('update', [
            'model' => $model,
            'categoryList' => $categoryList,
            'brandList' => $brandList,
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionImages($id){
        $model = new ImagesForm();
        $images = $this->getProductCombination($id);
        $cover_images = $this->getProductCombination($id,1);
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->save($id);
        }
        return $this->render('images',[
            'model' => $model,
            'images' => $images,
            'id' => $id,
            'cover_images' => $cover_images,
        ]);
    }
    public function getProductCombination($id,$is_cover = 0){
        $images = ProductCombinationMedia::find()
            ->where(['product_combination__id' => $id,'is_cover_image' => $is_cover,'is_deleted' => 0])
            ->asArray()
            ->all();
        return $images;
    }
    public function actionDeleteImage(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = ProductCombinationMedia::findOne(['_uid' => $id]);
            $model->is_deleted = 1;
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->save()){
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Image Deleted SuccessFully'
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
    public function actionEditImage(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = ProductCombinationMedia::findOne(['_uid' => $id]);
            if($model->is_cover_image == 1){
                $model->is_cover_image = 0;
            } else {
                $model->is_cover_image = 1;
            }
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->save()){
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Image Updated SuccessFully'
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
    public function actionTrash(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = ProductCombinations::findOne(['_id' => $id]);
            $productMedia = ProductCombinationMedia::findAll(['product_combination__id' => $id]);
            $_flag = true;
            if($productMedia){
                foreach($productMedia as $media){
                    if($media->delete()){
                        $_flag = true;
                    } else {
                        $_flag = false;
                    }
                }
            }
            $productOptions = ProductCombinationsOptions::findAll(['product_combinations__id' => $id]);
            if($productOptions && $_flag){
                foreach($productOptions as $option){
                    if($option->delete()){
                        $_flag = true;
                    } else {
                        $_flag = false;
                    }
                }
            }
            if($model->delete() && $_flag){
                return [
                  'status' => 200,
                  'title' => 'success',
                  'message' => 'Product Deleted SuccessFully'
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
    public function actionChangeSubCategory(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $key = Yii::$app->request->post('key');
            $value = Yii::$app->request->post('value');
            $model = Products::findOne(['_id' => $key]);
            $model->categories__id = $value;
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->save()){
                return [
                  'status' => 200,
                  'title' => 'Success',
                  'message' => 'Change sub Category'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'Oops!',
                    'message' => 'Something went wrong..'
                ];
            }
        }
    }
    public function actionUpdateBrands(){
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $key = Yii::$app->request->post('key');
            $value = Yii::$app->request->post('value');
            $model = Products::findOne(['_id' => $key]);
            $model->brand_id = $value;
            $model->updated_at = date('Y-m-d H:i:s');
            if($model->save()){
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Update Brand'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'Oops!',
                    'message' => 'Something went wrong..'
                ];
            }
        }
    }
    public function actionDelete(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $table = Yii::$app->request->post('table');
            switch($table){
                case 'product_combination_favour' :
                    $model = ProductCombinationsFlavours::findOne(['_uid' => $id]);
                break;
            }
            $model->is_deleted = 1;
            if($model->save()){
                return [
                  'status' => 200,
                  'title' => 'Success',
                  'message' => 'Delete successfully..'
                ];
            } else {
                return [
                  'status' => 201,
                  'title' => 'Oops!!',
                  'message' => 'Something went wrong..'
                ];
            }
        }
    }
}
