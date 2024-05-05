<?php

namespace app\controllers;

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
use app\models\Faq;
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
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'view'], // Actions that require authentication
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Require authenticated users
                    ],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
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

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $searchModel = new OrdersSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        $this->layout = 'login-main';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    public function actionAddFaq($id = null){
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
        return $this->render('add-faq',[
            'model' => $model
        ]);
    }
    public function actionFaq(){
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['is_deleted' => 0]);
        return $this->render('faq',[
           'dataProvider' => $dataProvider,
           'searchModel' => $searchModel
        ]);
    }
    public function actionSubscribers(){
        $searchModel = new SubscribersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('subscribers',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
    public function actionOrders(){
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('orders',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
    public function actionOrderItems(){
        $searchModel = new OrderItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('order-items',[
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
    public function actionReviews(){
        $searchModel = new ClientReviewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['is_deleted' => 0]);
        return $this->render('reviews',[
           'searchModel' => $searchModel,
           'dataProvider' => $dataProvider
        ]);
    }
    public function actionAddReview(){
        $model = new ReviewForm();

        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->add();
        }

        return $this->render('add-reviews', [
            'model' => $model,
        ]);
    }
    public function actionEditReview($id){
        $model = new EditReviewForm();
        $clientReview = ClientReviews::find()
            ->where(['_uid' => $id])
            ->asArray()
            ->one();
        $model->client_name = $clientReview['name'];
        $model->designation = $clientReview['designation'];
        $model->comment = $clientReview['description'];
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->update($id);
        }

        return $this->render('edit-reviews', [
            'model' => $model,
            'clientReview' => $clientReview,
            'client_image' => $clientReview['image'],
            'id' =>$id
        ]);
    }
    public function actionReviewTrash(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = ClientReviews::findOne(['_id' => $id]);
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
    public function actionAddVideos(){
    $model = new VideosForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->video_name = UploadedFile::getInstance($model, 'video_name');
            return $model->add();
        }
    return $this->render('add-videos',[
        'model' => $model
    ]);
    }
    public function actionVideos(){
        $searchModel = new VideosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('videos', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionVideoTrash(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Videos::findOne(['id' => $id]);
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
    public function actionAssignMedia($id){
        $model = new AssignMediaForm();
        $searchModel = new AssignMediaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['media_id' => $id]);
        $mediaName = Videos::findOne(['id' => $id])->title;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->add($id);
        }
    return $this->render('assign-media',[
        'model' => $model,
        'id' => $id,
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'mediaName' => $mediaName
    ]);
    }
    public function actionAppointments(){
        $searchModel = new AppointmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('appointments', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionPrayers(){
        $searchModel = new PrayersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('prayers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAddPrayer($id = null){
        $model = new PrayerForm();
        if($id){
            $prayerModel = Prayers::findOne(['uid' => $id]);
            $model->title = $prayerModel->title;
            $model->description = $prayerModel->description;
        }
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($id){
                return $model->update($id);
            } else {
            return $model->save();
            }
        }
        return $this->render('add-prayer',[
            'model' => $model,
            'id' => $id
        ]);
    }
    public function actionPrayerTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Prayers::findOne(['id' => $id]);
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
    public function actionAppointmentTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $model = Appointment::findOne(['_id' => $id]);
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
    public function actionTeamTrash()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = OurTeam::findOne(['id' => $id]);
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
    public function actionOurTeam(){
        $searchModel = new OurTeamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('our-team', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionAddTeam(){
        $model = new OurTeamForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->save();
        }

        return $this->render('add-team',[
            'model' => $model
        ]);
    }
    public function actionEditTeam($id)
    {
        $team = OurTeam::find()
            ->where(['id' => $id])
            ->asArray()->one();
        $model = new OurTeamEditForm();
        $model->name = $team['name'];
        $model->description = $team['description'];
        $model->phone = $team['phone'];
        $model->designation = $team['designation'];
        $model->charges = $team['charges'];
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->update($id);
        }
        return $this->render('edit-team', [
            'model' => $model,
            'id' => $team['uid'],
            'team_image' => $team['image']
        ]);
    }
    public function actionEditAppointments(){
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('pk');
            $name = Yii::$app->request->post('name');
            $value = Yii::$app->request->post('value');
            $model = Appointment::findOne(['_id' => $id]);
            $model->$name = $value;
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'date Add Successfully..'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'error',
                    'message' => $model->getErrors()
                ];
            }
        }
    }
    public function actionEditAppointment($id){
        $model = new EditAppointmentForm();
        $appointmentModel = Appointment::findOne(['_id' => $id]);
        $model->gender = $appointmentModel->gender;
        $model->email = $appointmentModel->email;
        $model->prev_appointment = $appointmentModel->previous_appointment;
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->post()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->update($id);
        }
        return $this->renderAjax('edit-appointment', [
            'model' => $model,
        ]);
    }
    public function actionAddProduct(){
        $model = new AddProductForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->save();
        }
        $categories = Categories::find()
            ->select(['_id','name'])
            ->asArray()
            ->all();
        $categories = ArrayHelper::map($categories, '_id', 'name');
        return $this->render('add-products',[
            'model' => $model,
            'categories' => $categories
        ]);
    }
    public function actionContactUs(){
        $searchModel = new ContactSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('contact-us', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSeo(){
        $searchModel = new SeoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('seo', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSeoCreate(){
        $model = new AddSeoForm();
        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->add();
        }
        return $this->render('seo-create', [
            'model' => $model,
        ]);
    }
    public function actionSeoEdit($id){
        $model = new AddSeoForm();
        $dataModel = Seo::find()
            ->where(['_uid' => $id])
            ->asArray()
            ->one();
        $model->route = $dataModel['route'];
        $model->title = $dataModel['title'];
        $model->description = $dataModel['description'];
        $model->keywords = $dataModel['keywords'];
        if (Yii::$app->request->post() && Yii::$app->request->isAjax) {
            $model->load(Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->image = UploadedFile::getInstance($model, 'image');
            return $model->edit($id);
        }
        return $this->render('seo-edit', [
            'model' => $model,
            'dataModel' => $dataModel,
        ]);
    }
    public function actionTrashSeo(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');

            $model = Seo::findOne(['_uid' => $id]);
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
    public function actionTrash(){
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $table = Yii::$app->request->post('table');
            switch($table){
                case 'faq':
                    $model = Faq::findOne(['_uid' => $id]);
                    break;
            }
            $model->is_deleted = 1;
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => $table. 'Delete Successfully..'
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
