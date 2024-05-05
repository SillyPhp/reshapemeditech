<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$this->title = 'Cart';
$session = Yii::$app->session;
$internalPrice = Yii::$app->functions->getCountryWisePrice();
?>
    <!-- hs About Title Start -->
    <section class="page-header">
        <div class="overlay section-padding">
            <div class="container">
                <h2>Cart</h2>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/ Cart </li>
                </ul>
            </div>
        </div>
    </section>

    <div class="cart-main-area pt-90 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <?php if (!empty($session['cart_data'])) { ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>View Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($session['cart_data'] as $cart) {
                                    $cartData = \common\models\ProductCombinations::find()
                                        ->select(['_id', 'title', 'price','sale_price', 'slug'])
                                        ->where(['_id' => $cart['prod_id']])
                                        ->asArray()->one();
                                    if($internalPrice){
                                        $sale_price = $internalPrice + $cartData['sale_price'];
                                    } else {
                                        $sale_price = $cartData['sale_price'];
                                    }
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <?php
                                            $image = Yii::$app->functions->ProductImage($cartData['_id']);
                                            $boxImage = Yii::$app->functions->ProductImages($cartData['_id']);
                                            if ($image) {
                                                $image_path = Yii::$app->params['upload_directories']['products']['image'] . $cartData['_id'] . '/' . $image['file_enc_name'];
                                            }
                                            elseif($boxImage) {
                                                $image_path = Yii::$app->params['upload_directories']['products']['image'] . $cartData['_id'] . '/' . $boxImage['file_enc_name'];
                                            }
                                            else {
                                                $image_path = '/images/default-image.png';
                                            }
                                            ?>
                                            <a href="#"><img src="<?= $image_path ?>" alt="" height="50px" width="50px"></a>
                                        </td>
                                        <td class="product-name"><a href="/product/<?= $cartData['slug'] ?>"><?= $cartData['title'] ?></a></td>
                                        <td class="product-price-cart"><span
                                                    class="amount">₹ <?= number_format($sale_price, 2) ?></span>
                                        </td>
                                        <td class="product-quantity">
                                            <div class="hs_shop_single_quantily_info">
                                                <div class="select_number">
                                                    <button title="increase" class="increase" data-id="cart-item-<?= $cartData['_id'] ?>" data-key="<?= $cartData['_id'] ?> " data-price="<?= $sale_price ?>">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <input type="text" name="quantity" value="<?= $cart['quantity'] ?>" size="2" id="cart-item-<?= $cartData['_id'] ?>" data-id="<?= $cartData['_id'] ?>" class="form-control quantity-items-input" />
                                                    <button title="decrease" class="decrease" data-id="cart-item-<?= $cartData['_id'] ?>" data-key="<?= $cartData['_id'] ?>" data-price="<?= $sale_price ?>">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal priceData"><?= $cart['quantity'] * $sale_price ?></td>
                                        <td class="product-wishlist-cart">
                                            <a href="javascript:;" class="remove_product" data-id="<?= $cartData['_id'] ?>">Remove</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="hs_effect_btn pull-right mt-20">
                            <ul>
                                <li><a href="<?= Url::to('/site/checkout') ?>"
                                       class="hs_btn_hover open-link">checkout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <span>Cart is empty</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <style>
        .mt-20{
            margin-top:20px;
        }
        @media only screen and (max-width: 767px) {
            .cart-main-area.pb-100 {
                padding-bottom: 60px;
            }
        }

        h3.cart-page-title {
            font-size: 20px;
            font-weight: 500;
            margin: 0 0 15px;
        }

        .cart-table-content table {
            border: 1px solid #56bce0;
        }

        .cart-table-content table thead > tr {
            background-color: #56bce0;
            border: 1px solid #56bce0;
        }

        .cart-table-content table thead > tr th {
            border-top: medium none;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            padding: 21px 45px 22px;
            text-align: center;
            text-transform: uppercase;
            vertical-align: middle;
            white-space: nowrap;
        }

        @media only screen and (min-width: 992px) and (max-width: 1199px) {
            .cart-table-content table thead > tr th {
                padding: 21px 35px 22px;
            }
        }

        @media only screen and (max-width: 767px) {
            .cart-table-content table thead > tr th {
                padding: 21px 20px 22px;
            }
        }

        .cart-table-content table tbody > tr {
            border-bottom: 1px solid #56bce0;
        }

        .cart-table-content table tbody > tr td.product-thumbnail {
            width: 150px;
        }

        .cart-table-content table tbody > tr td.product-name {
            width: 435px;
        }

        .cart-table-content table tbody > tr td.product-name a {
            /*color: #fff;*/
            font-size: 15px;
            font-weight: 500;
        }

        .cart-table-content table tbody > tr td.product-name a:hover {
            color: #ED3237;
        }

        .cart-table-content table tbody > tr td.product-price-cart {
            width: 435px;
        }

        .cart-table-content table tbody > tr td.product-price-cart span {
            font-weight: 500;
            /*color: #fff;*/
        }

        .cart-table-content table tbody > tr td.product-subtotal {
            font-weight: 500;
            /*color: #fff;*/
        }

        .cart-table-content table tbody > tr td.product-quantity {
            display: flex;
            justify-content: center;
        }

        .cart-table-content table tbody > tr td.product-remove {
            width: 100px;
        }

        .cart-table-content table tbody > tr td.product-remove a {
            color: #666;
            font-size: 17px;
            margin: 0 13px;
        }

        .cart-table-content table tbody > tr td.product-remove a:hover {
            color: #ED3237;
        }

        .cart-table-content table tbody > tr td.product-wishlist-cart > a {
            background-color: #ED3237;
            border-radius: 50px;
            color: #fff;
            font-size: 13px;
            font-weight: 500;
            line-height: 1;
            padding: 7px 12px;
            text-transform: uppercase;
        }

        .cart-table-content table tbody > tr td.product-wishlist-cart > a:hover {
            /*background-color: #fff;*/
        }

        .cart-table-content table tbody > tr td {
            font-size: 15px;
            padding: 30px 0;
            text-align: center;
        }
        .select_number{
            position: relative;
            display: flex;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .select_number button {
            background-color: transparent;
            border: 0;
            font-size: 12px;
        }
        .select_number input {
            text-align: center;
            margin-bottom: 0;
            border-radius: 0;
            border-color: #ddd;
        }
    </style>
<?php
$this->registerCss('
.pb-100 {
    padding-bottom: 100px;
}
.pt-90 {
    padding-top: 90px;
}
.cart-table-content table tbody > tr td.product-wishlist-cart > a:hover {
    background-color: #fff;
    color: black;
}
.decrease, .increase
{
    position: relative;
}
');
$script = <<<JS
$(document).on('click','.remove_product',function(e) {
  e.preventDefault();
  var btn = $(this);
    var id = btn.attr("data-id");
    btn.parent().parent().remove();
    $.ajax({
            url: "/site/remove-to-cart",
            method: "POST",
            data: {id: id},
            success: function (response) {
                if (response.status == 200) {
                    location.reload();
                    // $.pjax.reload({container:"#add_to_cart_pjax"});
                } 
            },
        });
});
$(document).on('change','.quantity-items-input',function (e){
    changeCart($(this).attr('data-id'), $(this).val());
});
$(document).on('click','.increase',function (e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.attr('data-id');
    var quantity = $('#'+id).val();
    var price = btn.attr('data-price');
    changeCart($(this).attr('data-key'), (parseInt(quantity)+1));
    $('#'+id).val((parseInt(quantity) +1));
    var updated_quantity = parseInt(quantity) + 1;
    $('.priceData').text(updated_quantity * parseInt(price));
});
$(document).on('click','.decrease',function (e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.attr('data-id');
    var quantity = $('#'+id).val();
    var price = btn.attr('data-price');
    if(quantity > 1){
        changeCart($(this).attr('data-key'), (parseInt(quantity)-1));
        $('#'+id).val((parseInt(quantity) -1));
        var updated_quantity = parseInt(quantity) - 1;
        $('.priceData').text(updated_quantity * parseInt(price));
    } else {
        alert('Minimum 1 Quantity Allowed');
    }
});
function changeCart(id, quantity) {
  var btn_data = 1; 
    $.ajax({
        url: '/site/add-to-cart',
        method: 'POST',
        data: {id: id,quantity:quantity,btn_data:btn_data},
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                $.pjax.reload({container:"#add_to_cart_pjax"});
            } else {
                toastr.error(response.message, response.title);
            }
        },
    });
}
JS;
$this->registerJs($script);