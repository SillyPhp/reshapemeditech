<?php

namespace frontend\models;

use common\models\OrderItem;
use common\models\Orders;
use common\models\ProductCombinations;
use Yii;
use yii\base\Model;


/**
 * ContactForm is the model behind the contact form.
 */
class OrderForm extends Model
{
    public $first_name;
    public $last_name;
    public $contact;
    public $email;
    public $country;
    public $address1;
    public $address2;
    public $state;
    public $city;
    public $zip_code;
    public $notes;
    public $payment_method;
    public $user_id;
    public $_flag;
    public $mrp = 0;

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'contact', 'email', 'address1', 'state', 'city', 'zip_code'], 'required'],
            [['address2', 'notes','country','payment_method','user_id'], 'safe'],
            [['email'],'email'],
            [['email','contact'], 'trim'],
            [['contact','zip_code'],'integer'],
            [['email'], 'string', 'max' => 50],
            [['contact'], 'string', 'length' => [10, 15]],
            [['zip_code'], 'string', 'max' => 7],
        ];
    }
    public function formName()
    {
        return '';
    }
    public function save()
    {
        $session = Yii::$app->session;
        $transaction = Yii::$app->db->beginTransaction();
        try {
            if ($session['cart_data']) {
                $model = new Orders();
                $model->_uid = Yii::$app->security->generateRandomString(15);
                $model->user_id = Yii::$app->user->identity->id;
                $model->first_name = $this->first_name;
                $model->last_name = $this->last_name;
                $model->contact = $this->contact;
                $model->email = $this->email;
                $model->address1 = $this->address1;
                $model->address2 = $this->address2;
                $model->zip_code = $this->zip_code;
                $model->notes = $this->notes;
                $model->created_at = date('Y-m-d H:i:s');
                $model->status = 1;
                if($this->payment_method == 'online_payment'){
                    $model->payment_mode = 1;
                } else {
                    $model->payment_mode = 0;
                }
                $model->sub_total = 0;
                $model->discount = 0;
                $model->grand_total = 0;
                $model->tax_amount = 0;
                $model->city = $this->city;
                if ($model->save()) {
                    $this->_flag = true;
                } else {
                    $this->_flag = false;
                    $transaction->rollback();
                }
                if ($this->_flag) {
                    $subtotal = 0;
                    $allDiscount = 0;
                    $tax = 0;
                    foreach ($session['cart_data'] as $cart) {
                        $cartData = \common\models\ProductCombinations::find()
                            ->alias('z')
                            ->select(['z._id','z.title', 'z.price','z.sale_price','c1.short_description gst'])
                            ->where(['z._id' => $cart['prod_id']])
                            ->joinWith(['productCombinationsOptions b' => function($b){
                                $b->addSelect(['b.product_combinations__id','b.product_option_values__id','b1.name label_value','b2.name label']);
                                $b->joinWith(['productOptionValues b1' => function($b1){
                                    $b1->joinWith(['productOptionLabels b2']);
                                }],false);
                            }])
                            ->joinWith(['products c' => function($c){
                                $c->joinWith(['taxPresets c1']);
                            }],false)
                            ->asArray()->one();
                        $cart_price = $cart['quantity'] * $cartData['sale_price'];
                        $subtotal += $cart_price;
                        if ($cartData['productCombinationsOptions']) {
                            foreach ($cartData['productCombinationsOptions'] as $option) {
                                if ($option['label'] == 'MRP') {
                                    $mrp = $option['label_value'];
                                }
                            }
                            if($mrp){
                                $discount = $mrp - $cartData['sale_price'];
                            } else {
                                $discount = 0;
                            }
                        }
                        $allDiscount += $discount * $cart['quantity'];
                        if($cartData['gst']){
                            $gst =  $cartData['sale_price'] / 100 * $cartData['gst'];
                            $tax += $gst;
                        } else {
                            $gst = 0;
                        }
                        $orderItemModel = new OrderItem();
                        $orderItemModel->_uid = Yii::$app->security->generateRandomString(15);
                        $orderItemModel->product_id = $cart['prod_id'];
                        $orderItemModel->order_id = $model->_id;
                        $orderItemModel->price = $cartData['sale_price'];
                        if ($cartData['productCombinationsOptions']) {
                            foreach ($cartData['productCombinationsOptions'] as $option) {
                                $mrp_discount = 0;
                                if ($option['label'] == 'MRP') {
                                    $mrp_discount = $option['label_value'];
                                }
                                $orderItemModel->discount = $mrp_discount - $cartData['sale_price'];
                            }
                        }  else {
                        $orderItemModel->discount = 0;
                        }
                        $orderItemModel->tax_amount = $gst;
                        $orderItemModel->quantity = $cart['quantity'];
                        $orderItemModel->created_at = date('Y-m-d H:i:s');
                        if ($orderItemModel->save()) {
                            $this->_flag = true;
                        } else {
                            $this->_flag = false;
                            $transaction->rollback();
                        }

                    }
                }
                if ($this->_flag) {
                    $model->grand_total = $subtotal + 40;
                    $model->sub_total = $subtotal;
                    $model->discount = $allDiscount;
                    $model->tax_amount = $tax;
                    if ($model->save()) {
                        $this->_flag = true;
                    } else {
                        $this->_flag = false;
                        $transaction->rollback();
                    }
                }
            }
            if($this->_flag && $model->payment_mode == 0){
                unset($session['cart_data']);
            }
            if ($this->_flag) {
                $transaction->commit();
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Items Add SuccessFully..',
                    'enc_id' => $model->_uid
                ];
            } else {
                $transaction->rollback();
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Something went wrong..'
                ];
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => $e->getMessage()
            ];
        }
    }
    public function update($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $productCombination = ProductCombinations::find()
                ->alias('z')
                ->select(['z._id','z.title', 'z.price','z.sale_price','c1.short_description gst'])
                ->where(['z._id' => $id])
                ->joinWith(['productCombinationsOptions b' => function($b){
                    $b->addSelect(['b.product_combinations__id','b.product_option_values__id','b1.name label_value','b2.name label']);
                    $b->joinWith(['productOptionValues b1' => function($b1){
                        $b1->joinWith(['productOptionLabels b2']);
                    }],false);
                }])
                ->joinWith(['products c' => function($c){
                    $c->joinWith(['taxPresets c1']);
                }],false)
                ->asArray()
                ->one();
                $model = new Orders();
                $model->_uid = Yii::$app->security->generateRandomString(15);
                $model->user_id = Yii::$app->user->identity->id;
                $model->first_name = $this->first_name;
                $model->last_name = $this->last_name;
                $model->contact = $this->contact;
                $model->email = $this->email;
                $model->address1 = $this->address1;
                $model->address2 = $this->address2;
                $model->zip_code = $this->zip_code;
                $model->notes = $this->notes;
                $model->created_at = date('Y-m-d H:i:s');
                $model->status = 1;
                if($this->payment_method == 'online_payment'){
                    $model->payment_mode = 1;
                } else {
                    $model->payment_mode = 0;
                }
                $model->sub_total = $productCombination['sale_price'];
                if ($productCombination['productCombinationsOptions']) {
                foreach ($productCombination['productCombinationsOptions'] as $option) {
                    $mrp_discount = 0;
                    if ($option['label'] == 'MRP') {
                        $mrp_discount = $option['label_value'];
                    }
                }
                    if($mrp_discount){
                        $model->discount = $mrp_discount - $productCombination['sale_price'];
                    } else {
                        $model->discount = 0;
                    }
                }
                $model->grand_total = $productCombination['sale_price'] + 40;
                if($productCombination['gst']){
                    $gst = $productCombination['sale_price'] / 100 * $productCombination['gst'];
                } else {
                    $gst = 0;
                }
                $model->tax_amount = $gst;
                $model->city = $this->city;
                if ($model->save()) {
                    $this->_flag = true;
                } else {
                    $this->_flag = false;
                    $transaction->rollback();
                }
                if($this->_flag) {
                    $orderItemModel = new OrderItem();
                    $orderItemModel->_uid = Yii::$app->security->generateRandomString(15);
                    $orderItemModel->product_id = $id;
                    $orderItemModel->order_id = $model->_id;
                    $orderItemModel->price = $productCombination['sale_price'];
                    $orderItemModel->discount = 0;
                    $orderItemModel->tax_amount = $gst;
                    $orderItemModel->quantity = 1;
                    $orderItemModel->created_at = date('Y-m-d H:i:s');
                    if ($orderItemModel->save()) {
                        $this->_flag = true;
                    } else {
                        $this->_flag = false;
                        $transaction->rollback();
                    }
                }
            if ($this->_flag) {
                $transaction->commit();
                return [
                    'status' => 200,
                    'title' => 'Success',
                    'message' => 'Items Add SuccessFully..',
                    'enc_id' => $model->_uid
                ];
            } else {
                $transaction->rollback();
                return [
                    'status' => 201,
                    'title' => 'errors',
                    'message' => 'Something went wrong..'
                ];
            }
        } catch (Exception $e) {
            $transaction->rollBack();
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => $e->getMessage()
            ];
        }
    }
}