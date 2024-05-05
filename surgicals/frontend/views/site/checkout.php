<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Checkout';
$myOrdersLink = Url::to('/site/my-orders');
$statesModel = ArrayHelper::map($statesModel->find()->alias('z')->select(['z.id', 'z.name', 'z.country_id'])->joinWith(['country a' => function ($a) {
    $a->andWhere(['a.name' => 'India']);
}])->orderBy(['z.name' => SORT_ASC])->asArray()->all(), 'id', 'name');
$session = Yii::$app->session;
$totalAmount = 0;
$rzr_id = Yii::$app->params['rzr_id'];
$internalPrice = Yii::$app->functions->getCountryWisePrice();
?>
<?php if (!Yii::$app->user->isGuest) { ?>
    <!-- hs About Title Start -->
    <!-- hs About Title End -->
    <section class="chcekout-page">
        <div class="container">
            <div>
                <?php
                if (isset($session['cart_data'])) {
                    $form = ActiveForm::begin(['id' => 'order-form', 'options' => ['class' => 'row']]);
                    ?>
                    <div class="col-md-8 col-lg-8">
                        <div class="checkout-form">
                            <h1>Billing Detail</h1>
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="firstname">First Name</label>
                                        <?= $form->field($model, 'first_name')->textInput(["id" => "first_name", "class" => "form-control c-white", "placeholder" => "First Name"])->label(false) ?>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="firstname">Last Name</label>
                                        <?= $form->field($model, 'last_name')->textInput(["id" => "last_name", "class" => "form-control c-white", "placeholder" => "Last Name"])->label(false) ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="contact">Contact Number</label>
                                        <?= $form->field($model, 'contact')->textInput(["id" => "contact", "class" => "form-control c-white", "placeholder" => "Contact Number"])->label(false) ?>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="email">Email</label>
                                        <?= $form->field($model, 'email')->textInput(["id" => "email", "class" => "form-control c-white", "placeholder" => "Email"])->label(false) ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="address1">Address1</label>
                                        <?= $form->field($model, 'address1')->textInput(["class" => "form-control c-white", "placeholder" => "Address 1"])->label(false) ?>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="address2">Address2</label>
                                        <?= $form->field($model, 'address2')->textInput(["class" => "form-control c-white", "placeholder" => "Address 2"])->label(false) ?>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="state">State</label>
                                        <?=
                                        $form->field($model, 'state')->label(false)->dropDownList(
                                            $statesModel, [
                                            'prompt' => 'Select State',
                                            'id' => 'states_drp',
                                        ])->label(false);
                                        ?>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="city">City</label>
                                        <?=
                                        $form->field($model, 'city')->label('<i class="fa fa-map-marker"></i> City')->dropDownList(
                                            [], [
                                            'prompt' => 'Select City',
                                            'id' => 'cities_drp',
                                        ])->label(false);
                                        ?>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="zip_code">Zip Code</label>
                                        <?= $form->field($model, 'zip_code')->textInput(["class" => "form-control c-white", "placeholder" => "Postcode/ZIP"])->label(false) ?>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xs-12">
                                        <label for="phone">notes</label>
                                        <?= $form->field($model, 'notes')->textArea(['class' => 'c-white', 'autocomplete' => 'off', 'rows' => 3, 'placeholder' => 'Order Notes'])->label(false); ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-lg-4">
                        <div class="checkout">
                            <h1>Order Summary</h1>
                            <table class="amount">
                                <?php
                                $subtotal = 0;
                                $gst = 0;
                                foreach ($session['cart_data'] as $cart) {
                                    ?>
                                    <tr>
                                        <?php
                                        $cartData = \common\models\ProductCombinations::find()
                                            ->alias('z')
                                            ->select(['z.title', 'z.price', 'z.sale_price', 'z.products__id', 'a1.short_description gst'])
                                            ->joinWith(['products a' => function ($a) {
                                                $a->joinWith(['taxPresets a1']);
                                            }], false)
                                            ->where(['z._id' => $cart['prod_id']])
                                            ->asArray()->one();
                                        if ($internalPrice) {
                                            $sale_price = $internalPrice + $cartData['sale_price'];
                                        } else {
                                            $sale_price = $cartData['sale_price'];
                                        }
                                        $cart_price = $cart['quantity'] * $sale_price;
                                        $subtotal += $cart_price;
                                        $gst += $sale_price / 100 * $cartData['gst'];
                                        ?>
                                        <td><?= $cartData['title'] ?></td>
                                        <td><?= $cart['quantity'] . ' X ₹' . number_format($sale_price, 2) ?></td>
                                    </tr>
                                    <?php
                                }
                                //                                 $subtotal = number_format($subtotal, 2);
                                //                                 $gst = number_format($gst, 2);
                                ?>
                                <tr>
                                    <td>Subtotal</td>
                                    <td> <?= number_format($subtotal, 2) ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td><span>₹ <i class="shippingCharges">40.00</i></span></td>
                                </tr>
                                <tr>
                                    <td>GST</td>
                                    <td><span>₹ <?= number_format($gst, 2) ?></span></td>
                                </tr>
                                <?php $totalAmount = $subtotal + 40 + $gst ?>
                                <tr style="display:none">
                                    <td>Total</td>
                                    <td><span>₹ <i class="totalChargesClass"><?= $totalAmount ?></i></span></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>₹ <i class="totalCharges"><?= $totalAmount ?></i></span></td>
                                </tr>
                            </table>

                            <div class="payment_item">
                                <h6>Payment Method :-</h6>
<!--                                <div class="radion_btn">-->
<!--                                    <input type="radio" id="f-option5" name="payment_selector" value="cash">-->
<!--                                    <label for="f-option5">COD</label>-->
<!--                                    <div class="check"></div>-->
<!--                                </div>-->
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="payment_selector"
                                           value="online_payment" checked>
                                    <label for="f-option6">Online Payment </label>
                                    <img src="/images/card.jpg" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal
                                    account.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="terms_id" name="terms">
                                <label for="f-option4">I’ve read and accept the </label>
                                <a href="#">terms &amp; conditions*</a>
                            </div>
                            <?= Html::submitButton('Proceed to Pay', ['class' => 'btn btn-primary hs_btn_hover submit-btn paymentSubmit', 'id' => 'rzp-button1']) ?>
<!--                            <a href="" class="checkout-btn">Checkout</a>-->
                        </div>
                    </div>
                    <?php
                    ActiveForm::end();
                } else {
                ?>
                <div class="col-lg-12">
                    <div class="hs_kd_left_sidebar_main_wrapper">
                        <h3 class="text-center">No Items found in Cart</h3>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
    </section>
    <?php
} else {
    return Yii::$app->response->redirect(Url::to(['site/login'], true));
}
?>
<?php
$this->registerCss('
.chcekout-page{
    margin: 25px;
}

.checkout-form h1{
    margin-bottom: 20px;
}

.checkout {
    box-shadow: 0 0 2px 2px #ededed;
    padding: 15px 10px;
    background: #f3f3f3;
    margin-bottom: 25px;
}
.checkout h1 {
    font-size: 18pt;
    font-family: Segoe UI;
}
.amount {
    width: 100%;
}
.amount tr td:nth-child(2) {
    text-align: right;
}
.total {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
    font-size: 20px;
    font-weight: 700;
}
.checkout-btn {
    display: block;
    text-align: center;
    background: #42d79e;
    color: #fff;
    margin-top: 40px;
    font-weight: 700;
    padding: 8px 0;
    text-transform: uppercase;
    letter-spacing: 1.1px;
}
.checkout-btn:hover{
    color: #fff;
    background: #57bce2;
    text-decoration: none;
}
');
$script = <<<JS
var rzr_id = "$rzr_id";
$(document).on('change','#states_drp',function() {
   $("#cities_drp").empty().append($("<option>", { 
                 value: "",
                 text : "Select City" 
             }));
           $.ajax({
                url: '/site/get-cities-by-state',
                type: 'POST',
                data: {id: $(this).val(),_csrf: $("meta[name=csrf-token]").attr("content")},
                success: function(response) {
                    if (response.status == 200) {
                        drp_down("cities_drp", response.cities);
                    }
                },
            });
})
function drp_down(id, data) {
        var selectbox = $('#' + id + '');
        $.each(data, function () {
            selectbox.append($('<option>', {
                value: this.id,
                text: this.name
            }));
        });
    }
$(document).on('submit','#order-form',function(event) {
  event.preventDefault();
  var form = $(this);
  console.log('okkkk');
    var btn = $('#'+ $(this).find("button[type=submit]:focus").attr('id'));
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    var paymentMethod = $('input[name="payment_selector"]:checked').val();
    var terms = $('input[name="terms"]:checked').val();
    if(terms){
    if ( form.data('requestRunning') ) {
        return false;
    }
    // form.data('requestRunning', true);
    var url = form.attr('action');
     // var first_name = $('#first_name').val();
     // var last_name = $('#last_name').val();
     // var contact = $('#contact').val();
     // var email = $('#email').val();
    var method = form.attr('method');
    var data = form.serialize();
    var formData = new FormData(this);
    // var signup_user_id= '';
//    $.ajax({
//        url: '/site/direct-signup',
//        method: 'POST',
//        data: {'first_name':first_name,'last_name':last_name,'contact':contact,'email':email},
//        success: function (response) {
//            if(response.status == 200){
//                signup_user_id = response.user_id;
//                formData.append('payment_method',paymentMethod);
//                formData.append('user_id',signup_user_id);
//                checkout(formData,paymentMethod);
//            }
//    },
//    });
     if(paymentMethod == 'online_payment') {
          $.ajax({
        url: '/site/checkout-data',
        type: method,
        data: data + "&payment_method=" + paymentMethod,
        beforeSend: function () {
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            btn.attr('disabled', true);
        },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                var data_status = 'active';
               razorPay($totalAmount,response.enc_id,data_status);
                // window.location.replace('$myOrdersLink');
            } else {
                toastr.error(response.message, response.title);
            }
            btn.html(btn_value);
            btn.attr('disabled', false);
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
        }); 
     } else {
         $.ajax({
        url: '/site/checkout-data',
        type: method,
        data: data + "&payment_method=" + paymentMethod,
        beforeSend: function () {
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            btn.attr('disabled', true);
        },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                window.location.replace('$myOrdersLink');
            } else {
                toastr.error(response.message, response.title);
            }
            btn.html(btn_value);
            btn.attr('disabled', false);
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    }); 
     }
    } else {
        alert("I don't have read and don't accept the terms and Conditions");
    }
});

function razorPay(amount,id,data_status) {
   $.ajax({
                url:'/site/razor-pay-curl',
                type: 'GET',
                data: {amount:$totalAmount,id:id},
                success: function (r) {
                    razorpayModal(id,r.id,r.amount,data_status);
                },
                });
}
function razorpayModal(idd,id,amount,data_status){
    var options = {
        "key": rzr_id, // Enter the Key ID generated from the Dashboard
        "amount": amount, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        // "currency": "INR",
        "name": "The BodyBay",
        "description": "Best Online Health Supplements Store across PAN India with 100% Authentic Products",
        "image": "https://techneyo.com/images/logo/logo.png",
        "order_id": id, //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "modal": {
                "ondismiss": function () {
                  razorPayPaymentFailed('Close Payment Box',id,amount,idd);
                }   
            },
        "handler": function (response){
            razorpayPayment(response,id,amount,data_status,idd);
        },
        "prefill": {
        },
        "notes": {
        },
        "theme": {
            "color": "#3399cc"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.on('payment.failed', function (response){
        var reason = 'Payment Failed';
        razorPayPaymentFailed('Payment Failed',id,amount,idd);
    });
    rzp1.open();
}
function razorPayPaymentFailed(reason,id,amount,idd){
      $.ajax({
                url: '/site/payment-failed',
                type: "POST",
                data: {reason:reason,order_id:id,amount:amount,receipt_id:idd},
                success:function(res){
                    if(res.status == 200){
                    toastr.error(res.message, res.title);
                    window.location.reload();
                    } else {
                        toastr.error(res.message, res.title);
                    }
                },
            });
}
function razorpayPayment(response,id,amount,data_status,idd){
    $.ajax({
                url: '/site/payment',
                type: "POST",
                data: {payment_id:response.razorpay_payment_id,order_id:response.razorpay_order_id,signature:response.razorpay_signature,amount:amount,status:data_status,receipt_id:idd},
                success:function(res){
                    if(res.status == 200){
                    toastr.success(res.message, res.title);
                    // if(!response.razorpay_payment_id && status == 'active'){
                    //   $.ajax({
                    //     url: '/site/direct-login',
                    //     type: "POST",
                    //     data: {username:username,password:password},
                    //     });  
                    // }
                    window.location.replace('$myOrdersLink');
                    } else {
                        toastr.error(res.message, res.title);
                    }
                },
      });
}
JS;
$this->registerJs($script);
?>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>