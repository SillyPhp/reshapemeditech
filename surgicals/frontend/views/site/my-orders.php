<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;

$this->title = 'My Orders';
?>
    <div class="cart-main-area pt-90 pb-100">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <?php if(!Yii::$app->user->isGuest) { ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php
                    if($data) {
                    ?>
                    <form action="#">
                        <div class="table-content table-responsive cart-table-content">
                            <table>
                                <thead>
                                <tr>
                                    <th>Order id</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>View Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($data as $orders){
                                ?>
                                <tr>
                                    <td class="order_id"><?= $orders['_uid']?></td>
                                    <td class="name"><?= $orders['first_name'] . ' ' . $orders['last_name']?></td>
                                    <td class="product-name"><?= $orders['address1'] . ' ' . $orders['address2'] . ' (' . $orders['zip_code'] . ')'?></td>
                                    <td class="price-cart"><span class="amount">₹ <?= $orders['grand_total']?></span></td>
                                    <td class="place-datetime">
                                        <span class="order_datetime"><?= date('d M Y H:i:s', strtotime($orders['created_at'])) ?></span>
                                    </td>
<!--                                    <td class="product-subtotal">$110.00</td>-->
                                    <td class="product-wishlist-cart">
                                        <a href="<?= Url::to('/site/order-detail?id='.$orders['_id'])?>">View Detail</a>
                                    </td>
                                </tr>
                                    <?php }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                        <?php
                    } else {
                        echo "You have no orders";
                    }
                        ?>
                </div>
            </div>
            <?php } else {?>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <span>Please Login to use this page</span>
                    </div>
                </div>
        <?php } ?>
        </div>
    </div>
    <style>
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
            color: #fff;
        }

        .cart-table-content table tbody > tr td.product-subtotal {
            font-weight: 500;
            color: #fff;
        }

        .cart-table-content table tbody > tr td.product-quantity {
            width: 435px;
        }

        .cart-table-content table tbody > tr td.product-quantity .cart-plus-minus {
            display: inline-block;
            height: 40px;
            padding: 0;
            position: relative;
            width: 110px;
        }

        .cart-table-content table tbody > tr td.product-quantity .cart-plus-minus .qtybutton {
            color: #fff;
            cursor: pointer;
            float: inherit;
            font-size: 16px;
            margin: 0;
            position: absolute;
            -webkit-transition: all 0.3s ease 0s;
            -o-transition: all 0.3s ease 0s;
            transition: all 0.3s ease 0s;
            width: 20px;
            text-align: center;
        }

        .cart-table-content table tbody > tr td.product-quantity .cart-plus-minus .dec.qtybutton {
            border-right: 1px solid #e5e5e5;
            height: 40px;
            left: 0;
            padding-top: 8px;
            top: 0;
        }

        .cart-table-content table tbody > tr td.product-quantity .cart-plus-minus .inc.qtybutton {
            border-left: 1px solid #e5e5e5;
            height: 40px;
            padding-top: 9px;
            right: 0;
            top: 0;
        }

        .cart-table-content table tbody > tr td.product-quantity .cart-plus-minus input.cart-plus-minus-box {
            color: #fff;
            float: left;
            font-size: 14px;
            height: 40px;
            margin: 0;
            width: 110px;
            background: transparent none repeat scroll 0 0;
            border: 1px solid #e1e1e1;
            padding: 0;
            text-align: center;
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

        .cart-table-content table tbody > tr td {
            font-size: 15px;
            padding: 30px 0;
            text-align: center;
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
    color: black;
}
');
$script = <<<JS

JS;
$this->registerJs($script);