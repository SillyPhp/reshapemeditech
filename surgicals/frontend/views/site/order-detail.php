<?php

use yii\helpers\Url;
$this->title = 'Order Detail';
?>

<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2>Order Detail</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="cart-value">
    <div class="container">
        <div class="row">
            <?php
                foreach ($orders as $data){
                    ?>
            <div class="col-md-12">
                <div class="cart-box">
                    <div class="cart-item">
                        <div class="cart-img">
                            <?php
                            $image =  Yii::$app->functions->ProductImage($data['product_id']);
                            $image_path = Yii::$app->params['upload_directories']['products']['image'].$data['product_id'].'/'.$image['file_enc_name']; ?>
                            <img src="<?= $image_path ?>" alt="">
                        </div>
                        <div class="cart-name-data">
                            <h3><?= $data['title']?></h3>
                            <p>Quality : <span> <?= $data['quantity'] ?></span></p>
                            <p>Price : <span> ₹ <?= $data['price'] ?></span></p>
                        </div>
                    </div>
                    <div class="cart-detail">
                        <h3>Delivery Address :</h3>
                        <p class="name-u"><?= $data['first_name'].' '.$data['last_name']?></p>
                        <p class="adress-d"><?=$data['address1'] ?>,<?= $data['address2']?>,<?= $data['city_name'].','.$data['state_name'].','.$data['zip_code']?></p>
                        <p class="p-no">Phone Number : <?= $data['contact']?></p>
                        <p class="p-no">Email : <?= $data['email']?></p>
                    </div>
                    <div class="cart-price">
                        <h3>Price Details : </h3>
                        <p class="total-p">Payment Mode :
                         <span><?= ($data['payment_mode'] == 0)?'Cash On Delivery':'Online'?></span>
                        </p>
                        <?php if($data['payment_mode'] == 1 && $data['orders']['payments']){?>
                        <p class="total-p">Payment Status :
                            <?php if($data['orders']['payments'][0]['payment_status'] == 'active'){
                                $st = 'Paid';} else {
                                $st = 'Pending';
                            }?>
                            <span><?= $st ?></span>
                        </p>
                        <?php } ?>
                        <p class="total-p">Total Price : <span><?= $data['grand_total']?></span></p>
                        <p class="total-p">Discount : <span><?= $data['discount']?></span></p>
                        <p class="total-p">Sub Price : <span><?= $data['sub_total']?></span></p>
                    </div>
                </div>
            </div>

                    <?php
                }
            ?>
        </div>
    </div>
</section>
<?php
$this->registerCSS('
.heading-cart {
            font-family: rovoto;
            font-size: 22px;
            margin-top: 10px;
        }
        .cart-box {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            box-shadow: 0 0 14px 2px #eee;
            padding: 40px;
            border-radius: 4px;
            margin: 10px 0;
            flex-wrap: wrap;
        }
        .cart-item {
            flex-basis: 33%;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        .cart-detail,
        .cart-price {
            flex-basis: 33%;
        }
        /* .cart-name-data {
            flex-basis: 68%;
        } */
        .cart-img {
            width: 100px;
            height: 100px;
            margin-right: 10px;
            min-width: 100px;
            margin-bottom: 10px;
        }
        .cart-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .cart-name-data h3,
        .cart-detail h3,
        .cart-price h3 {
            margin: 0 0 10px 0;
            font-family: roboto;
            font-size: 16px;
            font-weight: 500;
            color: #969191;
        }
        .cart-name-data p,
        .cart-detail p,
        .cart-price p {
            margin: 0 0 5px;
            font-family: "Roboto";
            color: #969191;
        }
        @media only screen and(max-width:992px) {
            .cart-item,
            .cart-detail,
            .cart-price {
                flex-basis: 100%;
                margin-bottom: 20px;
            }
        }
');
