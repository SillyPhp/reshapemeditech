<?php

namespace backend\controllers;

use app\models\AddProductForm;
use app\models\AddSeoForm;
use app\models\AddVoucherForm;
use app\models\Appointment;
use app\models\AssignMediaForm;
use app\models\Brands;
use app\models\ClientReviews;
use app\models\ContactSearch;
use app\models\EditAppointmentForm;
use app\models\EditReviewForm;
use app\models\extented\Categories;
use app\models\faqForm;
use app\models\OurTeam;
use app\models\OurTeamEditForm;
use app\models\OurTeamForm;
use app\models\PrayerForm;
use app\models\Prayers;
use app\models\ReviewForm;
use app\models\search\AppointmentSearch;
use app\models\search\AssignMediaSearch;
use app\models\search\ClientReviewsSearch;
use app\models\search\FaqSearch;
use app\models\search\OrderItemSearch;
use app\models\search\OurTeamSearch;
use app\models\search\PrayersSearch;
use app\models\search\SeoSearch;
use app\models\search\SubscribersSearch;
use app\models\search\OrdersSearch;
use app\models\search\VouchersSearch;
use app\models\Seo;
use app\models\Videos;
use app\models\VideosForm;
use app\models\search\VideosSearch;
use app\models\Vouchers;
use Yii;
use yii\base\BaseObject;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\LoginForm;
use app\models\ContactForm;

class VouchersController extends Controller
{
    public function actionIndex(){
        $searchModel = new VouchersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('vouchers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionAdd(){
        $model = new AddVoucherForm();
        $categories = \app\models\Categories::find()
            ->select(['_id' ,'name'])
            ->where(['not',['_parent_id' => null]])
            ->andWhere(['not',['status' => 3]])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $categories = ArrayHelper::map($categories, '_id', 'name');
        $brands = Brands::find()
            ->select(['_id', 'name'])
            ->andWhere(['is_deleted' => 0])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $brands = ArrayHelper::map($brands, '_id', 'name');
        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->add();
        }
        return $this->render('voucher-create', [
            'model' => $model,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    public function actionTrash(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Vouchers::findOne(['_uid' => $id]);
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

}
