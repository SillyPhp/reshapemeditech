<?php

namespace frontend\controllers;

use common\models\Faq;
use common\models\Brands;
use common\models\Categories;
use common\models\Cities;
use common\models\ClientReviews;
use common\models\Countries;
use common\models\CountriesMain;
use common\models\IpRefferal;
use common\models\LoginForm;
use common\models\Blogs;
use common\models\OrderItem;
use common\models\Orders;
use common\models\OurTeam;
use common\models\Payments;
use common\models\Prayers;
use common\models\ProductCombinations;
use common\models\ProductCombinationsFlavours;
use common\models\Products;
use common\models\Services;
use common\models\States;
use common\models\Subscribers;
use common\models\SubServices;
use common\models\User;
use frontend\models\AppointmentForm;
use frontend\models\ContactForm;
use frontend\models\OrderForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\Response;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    //                    [
                    //                        'actions' => ['signup'],
                    //                        'allow' => true,
                    //                        'roles' => ['?'],
                    //                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
     * @return mixed
     */

    public function beforeAction($action)
    {
        $route = ltrim(Yii::$app->urlManager->createAbsoluteUrl(Url::to()), '/');
        if ($route === "") {
            $route = "/";
        }
        Yii::$app->functions->setSeoByRoute($route, $this);
        return parent::beforeAction($action);
    }

    public function actionIndex($ref = null)
    {
        if($ref){
            $ref = Yii::$app->functions->checkRefferal($ref);
        }
        $brands = Brands::find()
            ->andWhere(['is_popular' => 1, 'is_deleted' => 0])
            ->orderBy(['sequence' => SORT_ASC])
            ->asArray()
            ->all();

        $categories = Categories::find()
            ->select(['name', '_uid'])
            ->where(['not', ['status' => 3]])
            ->andWhere(['not', ['_parent_id' => null]])
            ->limit('12')
            ->asArray()
            ->all();
        $recentProduct = Yii::$app->functions->ProductCombinations();
        $proteins = Yii::$app->functions->ProductCombinations('Proteins');
        $foods = Yii::$app->functions->ProductCombinations('Foods');
        $gainers = Yii::$app->functions->ProductCombinations('Gainers');
        $bcaa = Yii::$app->functions->ProductCombinations('BCAA');
        $vitamins = Yii::$app->functions->ProductCombinations('Vitamins');
        
        return $this->render('index', [
            'proteins' => $proteins,
            'gainers' => $gainers,
            'bcaa' => $bcaa,
            'vitamins' => $vitamins,
            'foods' => $foods,
            'categories' => $categories,
            'recentProduct' => $recentProduct,
            'brands' => $brands,
        ]);
    }

    public function actionRecentlyAdded()
    {
        $products = ProductCombinations::find()
            ->alias('z')
            ->select(['z._id', 'z.products__id', 'z.title', 'z.price', 'z.sale_price', 'z.status', 'a.short_description'])
            ->joinWith(['products a' => function ($a) {
                $a->joinWith(['categories a1']);
                $a->andWhere(['not', ['a.status' => 3]]);
            }])
            ->joinWith(['productCombinationsOptions b' => function ($b) {
                $b->addSelect(['b.product_combinations__id', 'b.product_option_values__id', 'b1.name label_value', 'b2.name label']);
                $b->joinWith(['productOptionValues b1' => function ($b1) {
                    $b1->joinWith(['productOptionLabels b2']);
                }], false);
            }])
            ->limit(20)
            ->groupBy('z._id')
            ->asArray()
            ->all();


        return $this->render('recently-added', ['products' => $products]);
    }
    public function actionShop($page = null, $keyword = null, $cat = null)
    {
        if (!$keyword) {
            $keyword = '';
        }
        if ($cat) {
            $cat = explode(',', $cat);
        }
        $words = \yii\helpers\BaseStringHelper::explode($keyword, $delimiter = ' ');
        $condition[] = 'OR';
        $condition[] = ['like', 'z.sale_price', $keyword];
        $condition[] = ['like', 'z.price', $keyword];
        $condition[] = ['like', 'z.title', $keyword];
        foreach ($words as $word) {
            $condition[] = ['like', 'z.sale_price', $word];
            $condition[] = ['like', 'z.price', $word];
            $condition[] = ['like', 'z.title', $word];
        }
        if (!$page) {
            $page = 1;
            $page_wise = 0;
        } else {
            $page_wise = $page - 1;
        }
        $products = ProductCombinations::find()
            ->alias('z')
            ->select(['z._id', 'z.products__id', 'z.slug', 'z.title', 'z.price', 'z.sale_price', 'z.status', 'a.short_description'])
            ->joinWith(['products a' => function ($a) {
                $a->joinWith(['categories a1']);
                $a->andWhere(['not', ['a.status' => 3]]);
            }])
            ->joinWith(['productCombinationsOptions b' => function ($b) {
                $b->addSelect(['b.product_combinations__id', 'b.product_option_values__id', 'b1.name label_value', 'b2.name label']);
                $b->joinWith(['productOptionValues b1' => function ($b1) {
                    $b1->joinWith(['productOptionLabels b2']);
                }], false);
            }])
            ->andWhere($condition);
        if ($cat) {
            $category[] = 'OR';
            foreach ($cat as $c) {
                if ($c) {
                    $category[] = ['like', 'a1.name', $c];
                }
            }
            $products = $products->andWhere($category);
        }
        $pagesData = count($products->asArray()->all()) / 18;
        $products = $products->limit(18)
            ->offset($page_wise * 18)
            ->groupBy('z._id')
            ->asArray()
            ->all();

        $categories = Categories::find()
            ->select(['name', '_id'])
            ->where(['not', ['status' => 3]])
            ->andWhere(['_parent_id' => null])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        return $this->render('shop', [
            'products' => $products,
            'keyword' => $keyword,
            'all_products' => floor($pagesData),
            'current_page' => $page,
            'categories' => $categories,
            'cat' => $cat
        ]);
    }

    public function actionAddToCart()
    {
        if (Yii::$app->request->isPOST) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $quantity = Yii::$app->request->post('quantity');
            $btn_data = Yii::$app->request->post('btn_data');
            $session = Yii::$app->session;
            if (isset($session['cart_data'])) {
                $sessionData = $session['cart_data'];
                if ($btn_data) {
                    foreach ($sessionData as $key => $delete) {
                        if ($id == $delete['prod_id']) {
                            unset($sessionData[$key]);
                        }
                    }
                }
                $arrayData = [
                    'prod_id' => $id,
                    'quantity' => $quantity
                ];
                array_push($sessionData, $arrayData);
                $session['cart_data'] = $sessionData;
            } else {
                $arrayData = [
                    'prod_id' => $id,
                    'quantity' => $quantity
                ];
                $session['cart_data'] = array($arrayData);
            }
            if ($session['cart_data']) {
                return [
                    'status' => 200,
                    'title' => 'Add to Cart',
                    'message' => 'Success'
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

    public function actionRemoveToCart()
    {
        if (Yii::$app->request->isPOST) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $id = Yii::$app->request->post('id');
            $quantity = Yii::$app->request->post('quantity');
            $session = Yii::$app->session;
            if (isset($session['cart_data'])) {
                $sessionData = $session['cart_data'];
                foreach ($sessionData as $key => $delete) {
                    if ($id == $delete['prod_id']) {
                        unset($sessionData[$key]);
                    }
                }
                $session['cart_data'] = $sessionData;
            } else {
                $session['cart_data'] = '';
            }
            return [
                'status' => 200,
                'title' => 'Remove to Cart',
                'message' => 'Success'
            ];
        }
    }

    public function actionShopDetail($id)
    {
        setlocale(LC_MONETARY, 'en_IN');
        $detail = ProductCombinations::find()->alias('z')
            ->select(['z._id', 'z.products__id', 'z.title', 'z.price', 'z.sale_price', 'z.status', 'a.short_description', 'a.name product_name'])
            ->where(['z.slug' => $id])
            ->joinWith(['products a'], false)
            ->joinWith(['productCombinationsOptions b' => function ($b) {
                $b->addSelect(['b.product_combinations__id', 'b.product_option_values__id', 'b1.name label_value', 'b2.name label']);
                $b->joinWith(['productOptionValues b1' => function ($b1) {
                    $b1->joinWith(['productOptionLabels b2']);
                }], false);
            }])
            ->asArray()
            ->one();
        $imageData = \common\models\ProductCombinationMedia::find()
            ->select(['_id', '_uid', 'file_enc_name'])
            ->where(['product_combination__id' => $detail['_id'], 'is_deleted' => 0])
            ->orderBy(['is_cover_image' => SORT_DESC])
            ->asArray()
            ->all();
        $popularProducts = ProductCombinations::find()
            ->alias('z')
            ->select(['z._id', 'z.slug', 'z.products__id', 'z.title', 'z.price', 'z.sale_price', 'a.short_description', 'z.status'])
            ->joinWith(['products a' => function ($a) {
                $a->andWhere(['not', ['a.status' => 3]]);
            }])
            ->joinWith(['productCombinationsOptions b' => function ($b) {
                $b->addSelect(['b.product_combinations__id', 'b.product_option_values__id', 'b1.name label_value', 'b2.name label']);
                $b->joinWith(['productOptionValues b1' => function ($b1) {
                    $b1->joinWith(['productOptionLabels b2']);
                }], false);
            }])
            ->where(['!=', 'z._id', $detail['_id']])
            ->limit(9)
            ->asArray()
            ->all();
        $flavours = ProductCombinationsFlavours::find()
            ->alias('z')
            ->select(['z._uid', 'z.flavour_id' ,'z.product_combination_id', 'a.name'])
            ->joinWith(['flavours a'],false)
            ->joinWith(['productCombinations b' => function($b) use($id){
                $b->andWhere(['b.slug' => $id]);
            }],false)
            ->andWhere(['z.is_deleted' => 0])
            ->asArray()
            ->all();
        return $this->render('detail', [
            'detail' => $detail,
            'product_id' => $detail['_id'],
            'imageData' => $imageData,
            'popularProducts' => $popularProducts,
            'flavours' => $flavours
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLoginRequest()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionBlog($page = null, $keyword = null)
    {
        if (!$keyword) {
            $keyword = '';
        }
        $words = \yii\helpers\BaseStringHelper::explode($keyword, $delimiter = ' ');
        $condition[] = 'OR';
        $condition[] = ['like', 'z.name', $keyword];
        $condition[] = ['like', 'z.short_description', $keyword];
        $condition[] = ['like', 'z.description', $keyword];
        foreach ($words as $word) {
            $condition[] = ['like', 'z.name', $word];
            $condition[] = ['like', 'z.short_description', $word];
            $condition[] = ['like', 'z.description', $word];
        }
        if (!$page) {
            $page = 0;
        } else {
            $page = $page - 1;
        }
        $data = Blogs::find()->alias('z')
            ->select(['z._id', 'z._uid', 'z.created_at', 'z.name', 'z.short_description', 'z.image'])
            ->where(['z.is_deleted' => 0])
            ->andWhere($condition);
        $pagesData = count($data->asArray()->all()) / 10;
        $data = $data->limit(10)
            ->orderBy(['z.created_at' => SORT_DESC])
            ->offset($page * 10)
            ->asArray()
            ->all();
        return $this->render('blog-categories', [
            'data' => $data,
            'keyword' => $keyword,
            'all_blogs' => floor($pagesData),
            'current_page' => $page,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            //            if ($model->emails()) {
            //                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            //            } else {
            //                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            //            }
            return $model->save();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAppointment()
    {
        $model = new AppointmentForm();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->post()) {
            //            if ($model->emails()) {
            //                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            //            } else {
            //                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            //            }
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->save();
        }
        return $this->render('appointment', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        $ourTeam = OurTeam::find()
            ->select(['uid', 'name', 'designation', 'phone', 'description', 'charges', 'image'])
            ->where(['is_deleted' => 0])
            ->asArray()->all();
        $services = Yii::$app->functions->getServices(0);
        return $this->render('about', [
            'ourTeam' => $ourTeam,
            'services' => $services
        ]);
    }

    public function actionCheckout()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new OrderForm();
            $statesModel = new States();
            $session = Yii::$app->session;
            if (isset($session['cart_data']) && count($session['cart_data']) <= 0) {
                return $this->redirect('/');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
            $header = [
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded',
                'Authorization-Key: ePz5DRXvkE/1XaIu++wGwe5EzgmvM3jNTbHRe9dGMRM='
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_USERPWD, Yii::$app->params['rzr_id'] . ':' . Yii::$app->params['rzr_secret']);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=500&currency=INR&receipt=rcptid_11");

            // In real life you should use something like:
            // curl_setopt($ch, CURLOPT_POSTFIELDS,
            //          http_build_query(array('postvar1' => 'value1')));

            // Receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $server_output = curl_exec($ch);

            $v = json_decode($server_output, true);
            curl_close($ch);

            return $this->render('checkout', [
                'model' => $model,
                'statesModel' => $statesModel,
                'data' => $v
            ]);
        } else {
            return Yii::$app->response->redirect(Url::to(['site/login'], true));
        }
    }

    public function actionCheckoutSingle($id)
    {
        if (!Yii::$app->user->isGuest) {
            $model = new OrderForm();
            $statesModel = new States();
            $productData = ProductCombinations::find()
                ->alias('z')
                ->select(['z._id', 'z.sale_price', 'z.title', 'a1.short_description gst'])
                ->joinWith(['products a' => function ($a) {
                    $a->joinWith(['taxPresets a1']);
                }], false)
                ->where(['z._id' => $id])
                ->asArray()
                ->one();
            return $this->render('checkout-single', [
                'model' => $model,
                'statesModel' => $statesModel,
                'productData' => $productData,
                'id' => $id
            ]);
        } else {
            return Yii::$app->response->redirect(Url::to(['site/login'], true));
        }
    }

    public function actionCheckoutData()
    {
        $model = new OrderForm();
        if ($model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->payment_method = Yii::$app->request->post('payment_method');
            return $model->save();
        }
    }

    public function actionCheckoutSingleData($id)
    {
        $model = new OrderForm();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->payment_method = Yii::$app->request->post('payment_method');
            return $model->update($id);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionDirectSignup()
    {
        if (Yii::$app->request->post()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $first_name = Yii::$app->request->post('first_name');
            $last_name = Yii::$app->request->post('last_name');
            $email = Yii::$app->request->post('email');
            $contact = Yii::$app->request->post('contact');
            $name = $first_name . ' ' . $last_name;
            $username = self::generate_username($name, 100);
            $model = new SignupForm();
            $user = User::findOne(['email' => $email]);
            if ($user) {
                $model = new LoginForm();
                $model->username = $user->username;
                $model->password = $contact;
                $model->login();
                return [
                    'status' => 200,
                    'user_id' => $user->id,
                ];
            } else {
                $model->username = $username;
                $model->email = $email;
                $model->password = $contact;
                $model->contact = $contact;
                if ($model->signup()) {
                    $model = new LoginForm();
                    $model->username = $username;
                    $model->password = $contact;
                    $model->login();
                    $user = User::findOne(['email' => $email]);
                    return [
                        'status' => 200,
                        'user_id' => $user->id,
                    ];
                }
            }
        }
    }
    public function actionDirectLogin()
    {
        if (Yii::$app->request->post()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model = new LoginForm();
            $model->username = Yii::$app->request->post('username');
            $model->password = Yii::$app->request->post('password');
            if ($model->login()) {
                return [
                    'status' => 200,
                    'message' => 'Login Successfully'
                ];
            } else {
                return [
                    'status' => 201,
                    'message' => 'Login Failed'
                ];
            }
        }
    }
    private function generate_username($string_name = null, $rand_no = 200)
    {
        $username_parts = array_filter(explode(" ", strtolower($string_name))); //explode and lowercase name
        $username_parts = array_slice($username_parts, 0, 2); //return only first two arry part

        $part1 = (!empty($username_parts[0])) ? substr($username_parts[0], 0, 8) : ""; //cut first name to 8 letters
        $part2 = (!empty($username_parts[1])) ? substr($username_parts[1], 0, 5) : ""; //cut second name to 5 letters
        $part3 = ($rand_no) ? rand(0, $rand_no) : "";

        $username = $part1 . str_shuffle($part2) . $part3; //str_shuffle to randomly shuffle all characters
        return $username;
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionTermsConditions()
    {
        return $this->render('terms-conditions');
    }

    public function actionPrivacyPolicy()
    {
        return $this->render('privacy-policy');
    }
    public function actionReturnPolicy()
    {
        return $this->render('return-policy');
    }
    public function actionTermsOfUse()
    {
        return $this->render('terms-of-use');
    }

    public function actionRefundPolicy()
    {
        return $this->render('refund-policy');
    }

    public function actionMyOrders()
    {
        $data = [];
        if (!Yii::$app->user->isGuest) {
            $data = Orders::find()
                ->andWhere(['user_id' => Yii::$app->user->identity->id])
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()
                ->all();
        }
        return $this->render('my-orders', [
            'data' => $data
        ]);
    }

    public function actionSearch($keyword)
    {
        $words = \yii\helpers\BaseStringHelper::explode($keyword, $delimiter = ' ');
        $condition[] = 'OR';
        $condition[] = ['like', 'a.name', $keyword];
        $condition[] = ['like', 'b.name', $keyword];
        $condition[] = ['like', 'c.name', $keyword];
        foreach ($words as $word) {
            $condition[] = ['like', 'a.name', $word];
            $condition[] = ['like', 'b.name', $word];
            $condition[] = ['like', 'c.name', $word];
        }
        $products = Products::find()
            ->alias('a')
            ->joinWith(['cat b'])
            ->joinWith(['brand c'])
            ->where([
                'a.is_deleted' => 0,
                'a.status' => 'Active'
            ])
            ->andWhere($condition)
            ->asArray()
            ->limit(20)
            ->all();
        print_r($products);
        exit();
    }

    public function actionTest()
    {
        Yii::$app->mailer->compose()
            ->setFrom('noreply@themagicalvastu.com')
            ->setTo('ajayjuneja52@gmail.com')
            ->setSubject('Email sent from Yii2-Swiftmailer')
            ->send();
    }

    public function actionBlogDetail($id)
    {
        $blogData = Blogs::find()
            ->where(['_id' => $id])
            ->asArray()
            ->one();
        if(!$blogData){
            throw new \yii\web\NotFoundHttpException();
        }
        $allBlogs = Blogs::find()
            ->where(['!=', '_id', $id])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->asArray()
            ->all();
        return $this->render('blog-detail', [
            'blogData' => $blogData,
            'allBlogs' => $allBlogs,
            'id' => $id
        ]);
    }

    public function actionServiceDetail($id)
    {
        $service = Services::find()
            ->where(['_uid' => $id])
            ->andWhere(['is_deleted' => 0])
            ->asArray()
            ->one();
        $allServices = Services::find()
            ->where(['!=', '_uid', $id])
            ->andWhere(['is_deleted' => 0, 'parent_enc_id' => NULL])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->asArray()
            ->all();
        $subServices = Services::find()
            ->where(['parent_enc_id' => $id])
            ->andWhere(['is_deleted' => 0])
            ->asArray()
            ->all();
        return $this->render('service-detail', [
            'service' => $service,
            'allServices' => $allServices,
            'subServices' => $subServices
        ]);
    }

    public function actionGetState()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($id = Yii::$app->request->post('id')) {
            $states = States::find()->select(['id', 'name'])->where(['country_id' => $id])->orderBy(['name' => SORT_ASC])->asArray()->all();
        }

        if (count($states) > 0) {
            return [
                'status' => 200,
                'states' => $states
            ];
        } else {
            return [
                'status' => 201
            ];
        }
    }

    public function actionGetCitiesByState()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($id = Yii::$app->request->post('id')) {
            $cities = Cities::find()->select(['id', 'name'])->where(['state_id' => $id])->orderBy(['name' => SORT_ASC])->asArray()->all();
        }

        if (count($cities) > 0) {
            return [
                'status' => 200,
                'cities' => $cities
            ];
        } else {
            return [
                'status' => 201
            ];
        }
    }

    public function actionSubscribe()
    {
        if (Yii::$app->request->isPost && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $value = Yii::$app->request->post('email');
            $model = Subscribers::findOne(['email' => $value]);
            if (!$model) {
                $model = new Subscribers();
                $model->_uid = Yii::$app->security->generateRandomString(15);
                $model->email = $value;
                $model->created_at = date('Y-m-d H:i:s');
                if ($model->save()) {
                    return [
                        'status' => 200,
                        'title' => 'Success',
                        'message' => 'Subscribe Successfully'
                    ];
                } else {
                    return [
                        'status' => 201,
                        'title' => 'Errors',
                        'message' => 'Something went wrong..'
                    ];
                }
            }
        }
    }

    public function actionTest2()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
        $header = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization-Key: ePz5DRXvkE/1XaIu++wGwe5EzgmvM3jNTbHRe9dGMRM='
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, Yii::$app->params['rzr_id'] . ':' . Yii::$app->params['rzr_secret']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=50000&currency=INR&receipt=rcptid_11");

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS,
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        $v = json_decode($server_output, true);
        curl_close($ch);
        //        print_r($v);
        //        exit();

        return $this->render('test_razor_pay', [
            'data' => $v,
        ]);
    }

    public function actionRazorPayCurl($amount, $id)
    {
        $amount = $amount * 100;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.razorpay.com/v1/orders");
        $header = [
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization-Key: ePz5DRXvkE/1XaIu++wGwe5EzgmvM3jNTbHRe9dGMRM='
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, Yii::$app->params['rzr_id'] . ':' . Yii::$app->params['rzr_secret']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "amount=" . $amount . "&currency=INR&receipt=" . $id . "");

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS,
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        $v = json_decode($server_output, true);
        curl_close($ch);
        return $v;
    }

    public function actionPayment()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $paymentId = Yii::$app->request->post('payment_id');
            $orderId = Yii::$app->request->post('order_id');
            $signature = Yii::$app->request->post('signature');
            $amount = Yii::$app->request->post('amount');
            $status = Yii::$app->request->post('status');
            $receipt_id = Yii::$app->request->post('receipt_id');
            $model = new Payments();
            $model->_uid = Yii::$app->security->generateRandomString(15);
            $model->order_id = $orderId;
            $model->payment_amount = $amount / 100;
            $model->payment_id = $paymentId;
            $model->payment_status = $status;
            if ($status == 'active') {
                $session = Yii::$app->session;
                unset($session['cart_data']);
            }
            $model->payment_signature = $signature;
            $model->product_order_id = $receipt_id;
            $model->created_on = date('Y-m-d H:i:s');
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'success',
                    'message' => 'Payment SuccessFully'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'error',
                    'message' => 'Payment not Paid'
                ];
            }
        }
    }

    public function actionPaymentFailed()
    {
        if (Yii::$app->request->isPost) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $reason = Yii::$app->request->post('reason');
            $orderId = Yii::$app->request->post('order_id');
            $amount = Yii::$app->request->post('amount');
            $receipt_id = Yii::$app->request->post('receipt_id');
            $model = new Payments();
            $model->_uid = Yii::$app->security->generateRandomString(15);
            $model->order_id = $orderId;
            $model->payment_amount = $amount / 100;
            $model->reason = $reason;
            $model->payment_status = 'inactive';
            $model->product_order_id = $receipt_id;
            $model->created_on = date('Y-m-d H:i:s');
            if ($model->save()) {
                return [
                    'status' => 200,
                    'title' => 'Oops!!',
                    'message' => 'Payment Failed'
                ];
            } else {
                return [
                    'status' => 201,
                    'title' => 'error',
                    'message' => 'Payment not Paid'
                ];
            }
        }
    }

    public function actionOrderDetail($id)
    {
        if (!Yii::$app->user->isGuest) {
            $data = OrderItem::find()
                ->alias('z')
                ->select([
                    'z._id', 'z.product_id', 'z.order_id', 'z.price', 'z.quantity', 'a.first_name', 'a.last_name',
                    'a.grand_total', 'a.contact', 'a.email', 'a.address1', 'a.address2', 'a.city', 'a.zip_code', 'a.payment_mode', 'a1.name city_name',
                    'a2.name state_name', 'a.sub_total', 'a.discount', 'b.title'
                ])
                ->joinWith(['orders a' => function ($a) {
                    $a->joinWith(['cities a1' => function ($a1) {
                        $a1->joinWith(['state a2']);
                    }], false);
                    $a->andWhere(['a.user_id' => Yii::$app->user->identity->id]);
                    $a->joinWith(['payments c' => function ($c) {
                        $c->addSelect(['c.product_order_id', 'c.payment_status']);
                        $c->orderBy(['c.created_on' => SORT_DESC]);
                    }]);
                }])
                ->joinWith(['productCombinations b' => function ($b) use ($id) {
                }], false)
                ->andWhere(['z.order_id' => $id])
                ->asArray()
                ->all();
        }
        if (!$data || count($data) <= 0) {
            return $this->redirect('/');
        }
        return $this->render('order-detail', [
            'orders' => $data
        ]);
    }

    public function actionCart()
    {
        return $this->render('cart');
    }

    public function actionSubServices($id)
    {
        $services = Services::find()->where(['parent_enc_id' => $id, 'is_deleted' => 0])->asArray()->all();
        $ser = Services::find()->where(['_uid' => $id])->asArray()->one();
        return $this->render('sub-services', [
            'services' => $services,
            'ser' => $ser
        ]);
    }
    public function actionGetUser($id)
    {
        $model = User::findOne(['email' => $id]);
        print_r($model);
        die();
    }
    public function actionIndex1()
    {
        $products = ProductCombinations::find()
            ->alias('z')
            ->select(['z._id', 'z.products__id', 'z.title', 'z.price', 'z.sale_price', 'z.status'])
            ->joinWith(['products a' => function ($a) {
                $a->andWhere(['not', ['a.status' => 3]]);
            }])
            ->joinWith(['productCombinationsOptions b' => function ($b) {
                $b->addSelect(['b.product_combinations__id', 'b.product_option_values__id', 'b1.name label_value', 'b2.name label']);
                $b->joinWith(['productOptionValues b1' => function ($b1) {
                    $b1->joinWith(['productOptionLabels b2']);
                }], false);
            }])->limit(3)
            ->groupBy('z._id')
            ->asArray()
            ->all();
        return $this->render('index1', [
            'products' => $products
        ]);
    }
    public function actionProfile()
    {
        if (!Yii::$app->user->isGuest) {
            $model = User::find()
                ->select(['id', 'username', 'email', 'contact'])
                ->where(['id' => Yii::$app->user->identity->id])->asArray()->one();
            $orders = Orders::find()
                ->alias('a')
                ->select([
                    'a._id', 'a.first_name', 'a.last_name',
                    'a.grand_total', 'a.contact', 'a.email', 'a.address1', 'a.address2', 'a.city', 'a.zip_code', 'a.payment_mode', 'a1.name city_name',
                    'a2.name state_name', 'a.sub_total', 'a.discount', 'a.created_at'
                ])
                ->joinWith(['cities a1' => function ($a1) {
                    $a1->joinWith(['state a2']);
                }], false)
                ->andWhere(['user_id' => Yii::$app->user->identity->id])
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()
                ->all();
        }
        return $this->render('profile', [
            'model' => $model,
            'orders' => $orders
        ]);
    }
    public function actionMyAccount()
    {
        if (!Yii::$app->user->isGuest) {
            $model = User::find()
                ->select(['id', 'username', 'email', 'contact'])
                ->where(['id' => Yii::$app->user->identity->id])->asArray()->one();
            $orders = Orders::find()
                ->alias('a')
                ->select([
                    'a._id', 'a.first_name', 'a.last_name',
                    'a.grand_total', 'a.contact', 'a.email', 'a.address1', 'a.address2', 'a.city', 'a.zip_code', 'a.payment_mode', 'a1.name city_name',
                    'a2.name state_name', 'a.sub_total', 'a.discount', 'a.created_at'
                ])
                ->joinWith(['cities a1' => function ($a1) {
                    $a1->joinWith(['state a2']);
                }], false)
                ->andWhere(['user_id' => Yii::$app->user->identity->id])
                ->orderBy(['created_at' => SORT_DESC])
                ->asArray()
                ->all();
        }
        return $this->render('my-account', [
            'model' => $model,
            'orders' => $orders
        ]);
    }

    public function actionBrands()
    {
        $brands = Brands::find()
            ->andWhere(['is_deleted' => 0])
            ->asArray()
            ->orderBy(['sequence' => SORT_ASC])
            ->all();
        return $this->render('brands', [
            'brands' => $brands
        ]);
    }
    public function actionEditProfile()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->request->post()) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                $contact = Yii::$app->request->post('contact');
                $email = Yii::$app->request->post('email');
                $model = User::findOne(['id' => Yii::$app->user->identity->id]);
                $model->email = $email;
                $model->contact = $contact;
                $model->updated_at = date('Y-m-d H:i:s');
                if ($model->save()) {
                    return [
                        'status' => 200,
                        'title' => 'success',
                        'message' => 'Edit Profile Successfully'
                    ];
                } else {
                    return [
                        'status' => 201,
                        'title' => 'error',
                        'message' => 'Something went wrong...'
                    ];
                }
            }
        }
    }
    public function actionAddCat($cat, $type)
    {
        $model = Categories::find()
            ->where(['name' => $cat])
            ->one();
        if ($model) {
            $model->type = $type;
            if ($model->save()) {
                print_r('Update Successfully');
            } else {
                print_r('Update Failed');
            }
        } else {
            print_r('Data Not Found');
        }
    }
    public function actionCategory()
    {
        
        $proteins = Yii::$app->functions->ProductCombinations('Proteins');
        $gainers = Yii::$app->functions->ProductCombinations('Gainers');
        return $this->render('category', [
            'proteins' => $proteins,
            'gainers' => $gainers
        ]);
    }

    public function actionFaq(){
        $faqs = Faq::find()
            ->where(['is_deleted' => 0])
            ->orderBy(['created_at' => SORT_DESC])
            ->limit(5)
            ->asArray()
            ->all();

        
        return $this->render('faq', ['faqs' => $faqs]);
    }
}
