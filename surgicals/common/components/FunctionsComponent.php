<?php

namespace common\components;

use common\models\Currencies;
use common\models\Categories;
use common\models\IpRefferal;
use common\models\Organizations;
use common\models\ProductCombinations;
use common\models\RawDatabase;
use common\models\Refferal;
use common\models\Seo;
use common\models\Services;
use common\models\Subscribers;
use common\models\UnclaimedOrganizations;
use common\models\User;
use common\models\Users;
use frontend\models\applications\ApplicationsSearch;
use frontend\models\applications\ApplicationsVolunteerSearch;
use frontend\models\appliedEmailLogs\AppliedEmailLogsSearch;
use frontend\models\assignedCategories\AssignedCategories;
use frontend\models\assignedCategories\AssignedCategoriesSearch;
use frontend\models\blogs\PostsSearch;
use frontend\models\countries\CountriesSearch;
use frontend\models\labels\LabelsSearch;
use frontend\models\newOrganizationReviews\NewOrganizationReviewsSearch;
use frontend\models\organizations\OrganizationsSearch;
use frontend\models\partnershipData\PartnershipDataSearch;
use frontend\models\quizPool\QuizPoolSearch;
use frontend\models\unclaimedOrganizations\UnclaimedOrganizationsSearch;
use frontend\models\users\UsersSearch;
use Yii;
use yii\db\Expression;
use yii\base\Component;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class FunctionsComponent extends Component
{

    public function contactNumber(){
        return '+919815516789';
    }

    public function getServices($most_service, $limit = null)
    {
        $query = Services::find()
            ->andWhere(['is_deleted' => 0, 'is_most_service' => $most_service,'parent_enc_id' => NULL]);
        if ($limit) {
            $query = $query->limit($limit);
        }
        $query = $query->asArray()
            ->all();
        return $query;
    }

    public function ProductImage($id){
        $imageData = \common\models\ProductCombinationMedia::find()
            ->select(['file_enc_name'])
            ->where(['product_combination__id' => $id,'is_cover_image' => 1,'is_deleted' => 0])
            ->asArray()
            ->one();
        return $imageData;
    }
    public function ProductCombinations($category = null){
        if($category){
            $cat = Categories::find()
                ->select(['_id','name'])
                ->where(['not',['status' => 3]])
                ->andWhere(['type' => $category])
                ->all();
        }
        $products = ProductCombinations::find()
            ->alias('z')
            ->select(['z._id', 'z.slug','z.products__id', 'z.title', 'z.price', 'z.sale_price', 'z.status'])
            ->joinWith(['products a' => function ($a) {
                $a->andWhere(['not', ['a.status' => 3]]);
                $a->joinWith(['categories a1'],false);
            }])
            ->joinWith(['productCombinationsOptions b' => function($b){
                $b->addSelect(['b.product_combinations__id','b.product_option_values__id','b1.name label_value','b2.name label']);
                $b->joinWith(['productOptionValues b1' => function($b1){
                    $b1->joinWith(['productOptionLabels b2']);
                }],false);
            }])->limit(4);
                if($category){
                    if($cat){
                        $categoryData[] = 'OR';
                        foreach ($cat as $c) {
                            if($c){
                                $categoryData[] = ['like', 'a1.name', $c->name];
                            }
                        }
                        $products = $products->andWhere($categoryData);
                    }
                }

            $products = $products->orderBy(['z.created_at' => SORT_DESC])
            ->groupBy('z._id')
            ->asArray()
            ->all();
        return $products;
    }
    public function ProductImages($id){
        $imageData = \common\models\ProductCombinationMedia::find()
            ->select(['file_enc_name'])
            ->where(['product_combination__id' => $id,'is_deleted' => 0])
            ->asArray()
            ->one();
        return $imageData;
    }
    public function getCountryWisePrice(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ipaddress));
        $price = '';
        if($ip_data->geoplugin_countryName != 'India'){
            $price = 3000;
        }
        return $price;
    }

    public function setSeoByRoute($route, $object)
    {
        if ($route) {
            $seoDetails = Seo::find()
                ->where([
                    "route" => $route,
                    "is_deleted" => 0,
                ])
                ->one();

            if ($seoDetails) {
                $object->view->title = $seoDetails->title;
                if ($seoDetails->image_enc_name) {
                    $image = Yii::$app->params->upload_directories->seo->image . $seoDetails->_uid . '/' . $seoDetails->image_enc_name;
                } else {
                    $image = Yii::$app->urlManager->createAbsoluteUrl('/images/banners/mobile/mb1.jpg');
                }
                $object->view->params['seo_tags'] = [
                    'rel' => [
                        'canonical' => Yii::$app->request->getAbsoluteUrl("https"),
                    ],
                    'property' => [
                        'og:locale' => 'en',
                        'og:type' => 'website',
                        'og:site_name' => 'The BodyBay',
                        'og:url' => Yii::$app->request->getAbsoluteUrl("https"),
                        'og:title' => $seoDetails->title,
                        'og:description' => $seoDetails->description,
                        'og:image' => $image,
                    ],
                ];
            }
        }
        return false;
    }
    public function checkRefferal($ref){
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_ref = IpRefferal::find()->where(['ip_address' => $ip, 'ref_id' => $ref])->one();
        $user_id = Refferal::findOne(['code' => $ref]);
        if(!$ip_ref && $user_id){
            $model = new IpRefferal();
            $model->_uid = Yii::$app->security->generateRandomString(15);
            $model->ref_id = $ref;
            $model->ip_address = $ip;
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            $user = User::findOne(['id' => $user_id->user_id]);
            $user->total_referance = $user->total_referance + 1;
            $user->save();
        }

    }
}