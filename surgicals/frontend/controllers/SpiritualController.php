<?php

namespace frontend\controllers;

use common\models\Videos;
use common\models\AssignMedia;
use frontend\models\AddMediaPasswordForm;
use frontend\models\LoginMediaForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SpiritualController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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

    public function actionMedia($token, $slug)
    {
        $model = new AddMediaPasswordForm();
        $assignMedia = AssignMedia::findOne(['has_token_key' => $token]);
        $media = Videos::find()->where(['_uid' => $slug])->asArray()->one();
        if (!$assignMedia->password) {
                    if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
                        Yii::$app->response->format = Response::FORMAT_JSON;
                        return $model->add($assignMedia->id);
                    }
                    return $this->render('media', [
                        'assignMedia' => $assignMedia,
                        'model' => $model,
                        'media' => $media
                    ]);
                } else {
                    return $this->redirect('/spiritual/medias?token=' . $token . '&slug=' . $slug);
                }
    }

    public function actionMedias($token, $slug)
    {
        $model = new LoginMediaForm();
        $assignMedia = AssignMedia::findOne(['has_token_key' => $token]);
        $media = Videos::find()->where(['_uid' => $slug])->asArray()->one();
        if ($model->load(Yii::$app->request->post()) && Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $model->add($assignMedia->id);
        }
        return $this->render('medias', [
            'media' => $media,
            'model' => $model,
            'assignMedia' => $assignMedia
        ]);
    }
}