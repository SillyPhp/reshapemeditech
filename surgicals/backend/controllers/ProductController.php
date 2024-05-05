<?php

namespace backend\controllers;

use app\models\extented\Products;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class ProductController extends Controller
{

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout','add'],
//                'rules' => [
//                    [
//                        'actions' => ['logout', 'add'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }


//    /**
//     * {@inheritdoc}
//     */
//    public function actions()
//    {
//        return [
//            'error' => [
//                'class' => 'yii\web\ErrorAction',
//            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
//        ];
//    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionAdd()
    {
        $model = new Products();
        $displayTypes = $model->getDisplayTypes();
        $displayResolutions = $model->getDisplayResolutions();
        $processors = $model->getProcessorsList();
        $gpuModels = $model->getGpuModelsList();
        $chargeTypesList = $model->getChargeTypesList();

        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($model->colors){
                $colors = explode(',', $model->colors);
                foreach ($colors as $c) {
                    $string = strtolower(trim($c));
                    $c = str_replace(" ","_", $string);
                    $field = $c . '_image';
                    $model->image[$c] = UploadedFile::getInstances($model, $field);
                }
            }
            return $model->add();
        }

        return $this->render('create', [
            'model' => $model,
            'displayTypes' => $displayTypes,
            'displayResolutions' => $displayResolutions,
            'processors' => $processors,
            'gpuModels' => $gpuModels,
            'chargeTypesList' => $chargeTypesList,
        ]);
    }

    public function actionGetOsVersionsList($type)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Products();
        return $data = $model->getOsVersionsList($type);
    }

}
