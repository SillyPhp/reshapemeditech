<?php

use yii\helpers\Url;

$this->title = $detail['title'];
$ref_link = Url::to('/site/shop-detail?id=' . $product_id, 'https');
$internalPrice = Yii::$app->functions->getCountryWisePrice();
$sharingLinks = Yii::$app->urlManager->createAbsoluteUrl(Url::to());
echo $this->render('/widgets/breadcrumb', [
    'title' => $detail['title'],
    'parentName' => 'Shop',
    'parentLink' => '/shop',
]);
?>
<!-- <ul class="breadcrumb">
    <li><a href="/">Home</a></li>
    <li><a href="/shop">Shop</a></li>
    <li><?= $detail['title'] ?></li>
</ul> -->
<section class="product-detail">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="product-imgs">
                    <div class="img-display">
                        <div class="img-showcase">
                            <?php
                            if ($imageData) {
                                foreach ($imageData as $img) {
                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product_id . '/' . $img['file_enc_name'];
                                    ?>
                                    <img src="<?= $image_path ?>" alt="Product Image" class="bannerImg">
                                    <?php
                                }
                            } else {
                                $image_path = '/images/default-image.png';
                                echo '<img src="' . $image_path . '" alt="Product Image" class="bannerImg">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="img-select">
                        <?php
                        if ($imageData) {
                            foreach ($imageData as $k => $img) {
                                $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product_id . '/' . $img['file_enc_name'];
                                ?>
                                <div class="img-item">
                                    <a href="#" data-id="<?= $k + 1 ?>">
                                        <img src="<?= $image_path ?>" alt="shoe image" class="sideImage">
                                    </a>
                                </div>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="product-detail">
                    <h1><?= $detail['title'] ?></h1>
                    <div class="price">
                        <?php
                        if ($internalPrice) {
                            $sale_price = $internalPrice + $detail['sale_price'];
                        } else {
                            $sale_price = $detail['sale_price'];
                        }
                        ?>
                        <h2>₹ <?= number_format($sale_price, '2') ?></h2>
                        <del>
                            <?php if ($detail['productCombinationsOptions']) {
                                foreach ($detail['productCombinationsOptions'] as $option) {
                                    $mrp = '';
                                    if ($option['label'] == 'MRP') {
                                        if ($internalPrice) {
                                            $title_price_grid = $internalPrice + $option['label_value'];
                                        } else {
                                            $title_price_grid = $option['label_value'];
                                        }
                                        $mrp = '<del>₹ ' . $title_price_grid . '</del>';
                                    }
                                    echo $mrp;
                                }
                            } ?>
                        </del>
                    </div>
                    <div class="quantity">
                        <div class="minus">-</div>
                        <input type="number" class="count" name="qty" value="1" size="2" id="input-quantity">
                        <div class="plus">+</div>
                    </div>
                    <?php if ($flavours) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-filter">
                                    <ul class="m-filter" id="proof_of_ul">
                                        <?php
                                        foreach ($flavours as $flavour) {
                                            $flavour_name = ucfirst($flavour['name']);
                                            ?>
                                            <li>
                                                <input class="checkbox checkbox_proof_of"
                                                       id="sort-<?= $flavour['_uid'] ?>" type="radio" name="flavour"
                                                       value="<?= $flavour_name ?>">
                                                <label for="sort-<?= $flavour['_uid'] ?>">
                                                    <div>
                                                        <?= $flavour_name ?>
                                                    </div>
                                                </label>
                                            </li>
                                            <?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>

                    <a href="/site/checkout-single?id=<?= $product_id ?>" target="_blank" class="buy-now"
                       data-id="<?= $product_id ?>">Buy Now</a>
                    <a href="javascript:;" class="cart-btn1 quantity_add_to_cart" data-id="<?= $product_id ?>"
                       title="Add to Cart">
                        Add to Cart
                    </a>
                    <div class="ushare">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $sharingLinks ?>"><img
                                    src="/images/icons/fb1.png" height="25px" width="25px"></a>
                        <a href="https://twitter.com/intent/tweet?text=<?= $sharingLinks ?>" target="_blank"><img
                                    src="/images/icons/twitter.png" height="25px" width="25px"></a>
                        <a href="https://wa.me/?text=<?= $sharingLinks ?>" target="_blank"><img
                                    src="/images/icons/WhatsApp.png" height="30px" width="30px"></a>
                    </div>
                </div>
            </div>
            <?php
            if ($detail['short_description']) {
                ?>
                <div class="col-md-12">
                    <h2 style="text-align: center; font-weight: 700">Description</h2>
                </div>
                <div class="col-md-12">
                    <?= $detail['short_description'] ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>
<?php if ($popularProducts) { ?>
    <section class="similar-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="heading">Similar Products</h1>
                </div>

                <?php foreach ($popularProducts as $pro) { ?>
                    <div class="col-lg-3 col-md-4">
                        <div class="product-box">
                            <?php
                            $image = Yii::$app->functions->ProductImage($pro['_id']);
                            $boxImage = Yii::$app->functions->ProductImages($pro['_id']);
                            if ($image) {
                                $image_path = Yii::$app->params['upload_directories']['products']['image'] . $pro['_id'] . '/' . $image['file_enc_name'];
                            } elseif ($boxImage) {
                                $image_path = Yii::$app->params['upload_directories']['products']['image'] . $pro['_id'] . '/' . $boxImage['file_enc_name'];
                            } else {
                                $image_path = '/images/default-image.png';
                            }
                            ?>
                            <?php
                            $countCartData = 0;
                            if (isset($session['cart_data'])) {
                                foreach ($session['cart_data'] as $cartItem) {
                                    if ($pro['_id'] == $cartItem['prod_id']) {
                                        $countCartData = $countCartData + 1;
                                    }
                                }
                            }
                            ?>
                            <div class="product-img">
                                <div class="img-overlay"></div>
                                <img src="<?= $image_path ?>" alt="Product Image" class="productCartImage">
                                <div class="action-btns">
                                    <a href="javascript:;" class="add_to_cart cart-btn"
                                       data-id="<?= $pro['_id'] ?>"><img
                                                src="/images/content/shop/shopping-cart.png">Add to
                                        Cart <?= ($countCartData == 0) ? '' : '( ' . $countCartData . ' )' ?>
                                    </a>
                                    <a href="/site/checkout-single?id=<?= $pro['_id'] ?>" target="_blank"
                                       class="buy-btn" data-id="<?= $pro['_id'] ?>"><img
                                                src="/images/content/shop/thunder-icon.png">Buy Now</a>
                                </div>
                            </div>
                            <div class="prod-det">
                                <h1>
                                    <a href="<?= Url::to('/product/' . $pro['slug']) ?>"><?= $pro['title'] ?></a>
                                </h1>
                                <?php if ($pro['short_description']) { ?>
                                    <span class="desc"><?= substr($pro['short_description'], 0, 150); ?></span>
                                <?php } ?>
                                <div class="price">
                                    <h2>₹ <?= number_format($pro['sale_price'], 2) ?></h2>
                                    <del class="">
                                        <?php if ($pro['productCombinationsOptions']) {
                                            $marketPrice = '';
                                            foreach ($pro['productCombinationsOptions'] as $option) {
                                                $mrp = '';
                                                if ($option['label'] == 'MRP') {
                                                    $marketPrice = $option['label_value'];
                                                    $mrp = '<del>₹ ' . $option['label_value'] . '</del>';
                                                }
                                                echo $mrp;
                                            }
                                            if ($marketPrice) {
                                                $discount = $pro['sale_price'] / $marketPrice * 100;
                                                $discount = 100 - $discount;
                                                $discount = floor($discount) . ' %';
                                            }
                                        } ?>
                                    </del>
                                </div>
                                <?php if ($discount) { ?>
                                    <span class="discountLabel">-<?= $discount ?></span>
                                <?php } ?>
                                <a href="javascript:;" class="add_to_cart cart-btn"
                                   data-id="<?= $pro['_id'] ?>">Add to
                                    Cart <?= ($countCartData == 0) ? '' : '( ' . $countCartData . ' )' ?></a>
                                <a href="/site/checkout-single?id=<?= $pro['_id'] ?>" target="_blank"
                                   class="buy-now" data-id="<?= $pro['_id'] ?>">Buy Now</a>
                            </div>
                        </div>
                    </div>


                    <?php
                }
                ?>

            </div>
        </div>
    </section>
<?php } ?>
<?php
$this->registerCSS('
.m-filter {
    display: flex;
    flex-wrap: wrap;
    list-style-type: none;
    padding-inline-start: 0px;
}
.m-filter li {
    box-shadow: inset 0 0 4px 0px rgba(0, 0, 0, .1);
    margin: 2px 1px;
    border-radius: 5px;
}
.m-filter li label {
    height: 42px;
    font-family: Roboto;
    color: #333;
    text-align: center;
    display: table;
    position: relative;
    width: 100%;
    margin-bottom: 0;
    padding: 0 20px;
    cursor: pointer;
}
.m-filter li label div {
    vertical-align: middle;
    display: table-cell;
}
.m-filter li label span {
    position: absolute;
    top: 4px;
    right: 5px;
}
.m-filter li input[type=radio] {
    display: none;
}
.m-filter li input:checked + label {
    transition: .2s ease;
    color: #fff;
    background: #00a0e3;
    border-radius: 5px;
    
}
.bannerImg
{
    object-fit: contain;
    width: 100%;
}
.sideImage
{
    height: 100px;
    object-fit: contain;
    width: 100%;
}
 .product-detail{
        margin-bottom: 20px;
        margin-top: 30px;
        
    }
    .product-img {
        display: flex;
        align-items: flex-start;
    }
    .all-images {
        margin-right: 60px;
    }
    .small-img {
        margin-bottom: 12px;
        border: 1px solid #686868;
        height: 55px;
        width: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .main-image {
        border: 1px solid #ddd;
    }
    .product-detail h1{
        font-size: 18pt;
    }
    .price h2 {
        font-size: 20px;
        font-weight: 700;
        display: inline-block;
    }
    
    .price del {
        margin-left: 6px;
    }
    
    span.discount {
        margin-left: 6px;
        color: #4cb145;
        font-weight: 600;
    } 
    
    a.cart-btn1, a.buy-now {
        display: inline-block;
        padding: 5px 10px;
        background: #57bce2;
        color: #fff !important;
        font-weight: 700;
        min-width: 120px;
        text-align: center;
    }
    a.buy-now{
        background: #42d79e;
    }
    .reviews .fa-star{
        color: #FF5C58;
    }
    .quantity {
        display: flex;
        border: 1px solid #818181;
        padding: 0 0px;
        align-items: center;
        width: fit-content;
        margin: 10px 0;
    }
    .quantity1 {
        display: flex;
        padding: 0 0px;
        align-items: center;
        width: fit-content;
        margin: 10px 0;
    }
    .minus, .count, .plus {
        display: flex;
        width: 38px !important;
        height: 32px;
        line-height: 32px !important;
        align-items: center;
        justify-content: center;
        margin-bottom: 0 !important;
        border: none !important;
        padding: 0 !important;
        cursor: pointer;
    }
    .count{
        padding-left: 14px !important;
        cursor: auto;    
        width: 50px !important;
    }
    .ushare {
        width: 260px;
        text-align: center;
        margin-top: 9px;
    }
    .product-box {
        margin: 20px auto;
        border: 1px solid #dbdbdb;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .product-box img {
        display: block;
        margin: auto;
    }
    .prod-det {
        padding: 15px;
    }
//    .product-box h1 {
//        font-size: 18px;
//        margin: 0;
//        height: 24px;
//        line-height: 24px;
//    }
    
    span.ratings {
        background: #FF5C58;
        padding: 0 6px;
        border-radius: 5px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
    }
    
    .stars {
//        display: inline-block;
    }
    
    .ratings .fa-star{
        display: inline-blok;
        margin-left: 2px;
    }
    
    .price h2 {
        font-size: 20px;
        font-weight: 700;
        display: inline-block;
    }
    
    .price del {
        margin-left: 6px;
    }
    
    span.discount {
        margin-left: 6px;
        color: #4cb145;
        font-weight: 600;
    }
    
    .prod-det > a {
        display: inline-block;
        padding: 5px 0;
        background: #57bce2;
        color: #fff !important;
        font-weight: 700;
        margin-top: 10px;
        width: 49%;
        font-size: 13px;
        text-align: center;
    }
    .prod-det .buy-now{
        background: #42d79e;
    }

    
    @media only screen and (max-width: 767px){
        .product-img {
            flex-direction: column-reverse;
        }
        .all-images {
            display: flex;
            margin: 20px 0;
        }
        .small-img {
            margin-bottom: 12px;
            border: 1px solid #686868;
            margin-right: 10px;
        }
        .main-image{
            margin: auto;
            max-width: 300px;
        }

    }



    /*====Slider====*/
    .card-wrapper{
        max-width: 1100px;
        margin: 0 auto;
    }
//    img{
//        width: 100%;
//        display: block;
//    }
    .img-display{
        overflow: hidden;
    }
    .img-showcase{
        display: flex;
        width: 100%;
        transition: all 0.5s ease;
    }
    .img-showcase img{
        min-width: 100%;
    }
    .img-select{
        display: flex;
        flex-wrap: wrap;
    }
    .img-item{
        margin: 0.3rem;
        flex-basis: 20%;
    }
    // .img-item:nth-child(1),
    // .img-item:nth-child(2),
    // .img-item:nth-child(3){
    //     margin-right: 0;
    // }
    .img-item:hover{
        opacity: 0.8;
    }
    .product-content{
        padding: 2rem 1rem;
    }
    .product-title{
        font-size: 3rem;
        text-transform: capitalize;
        font-weight: 700;
        position: relative;
        color: #12263a;
        margin: 1rem 0;
    }
    .product-title::after{
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 4px;
        width: 80px;
        background: #12263a;
    }
    .product-link{
        text-decoration: none;
        text-transform: uppercase;
        font-weight: 400;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 0.5rem;
        background: #256eff;
        color: #fff;
        padding: 0 0.3rem;
        transition: all 0.5s ease;
    }
    .product-link:hover{
        opacity: 0.9;
    }
    .product-rating{
        color: #ffc107;
    }
    .product-rating span{
        font-weight: 600;
        color: #252525;
    }
    .product-price{
        margin: 1rem 0;
        font-size: 1rem;
        font-weight: 700;
    }
    .product-price span{
        font-weight: 400;
    }
    .last-price span{
        color: #f64749;
        text-decoration: line-through;
    }
    .new-price span{
        color: #256eff;
    }
    .product-detail h2{
        text-transform: capitalize;
        color: #12263a;
        padding-bottom: 0.6rem;
    }
    .product-detail p{
        font-size: 0.9rem;
        padding: 0.3rem;
        opacity: 0.8;
    }
    .product-detail ul{
        margin: 1rem 0;
        font-size: 0.9rem;
    }
    .product-detail ul li{
        margin: 0;
        list-style: none;
        background: url(shoes_images/checked.png) left center no-repeat;
        background-size: 18px;
        padding-left: 1.7rem;
        margin: 0.4rem 0;
        font-weight: 600;
//        opacity: 0.9;
    }
    .product-detail ul li span{
        font-weight: 400;
    }
    .purchase-info{
        margin: 1.5rem 0;
    }
    .purchase-info input,
    .purchase-info .btn{
        border: 1.5px solid #ddd;
        border-radius: 25px;
        text-align: center;
        padding: 0.45rem 0.8rem;
        outline: 0;
        margin-right: 0.2rem;
        margin-bottom: 1rem;
    }
    .purchase-info input{
        width: 60px;
    }
    .purchase-info .btn{
        cursor: pointer;
        color: #fff;
    }
    .purchase-info .btn:first-of-type{
        background: #256eff;
    }
    .purchase-info .btn:last-of-type{
        background: #f64749;
    }
    .purchase-info .btn:hover{
        opacity: 0.9;
    }
    .social-links{
        display: flex;
        align-items: center;
    }
    .social-links a{
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        color: #000;
        border: 1px solid #000;
        margin: 0 0.2rem;
        border-radius: 50%;
        text-decoration: none;
        font-size: 0.8rem;
        transition: all 0.5s ease;
    }
    .social-links a:hover{
        background: #000;
        border-color: transparent;
        color: #fff;
    }
    
    @media screen and (min-width: 992px){
        .card{
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 1.5rem;
        }
        .card-wrapper{
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .product-imgs{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .product-content{
            padding-top: 0;
        }
    }
    
    
    .productCartImage {
    height: 300px;
    object-fit: contain;
    width: 100%;
}
.discountLabel{
    position: absolute;
    background-color: #57bce2;
    color: #fff;
    z-index: 9;
    padding: 5px 15px;
    top: 25px; left: 20px;
    border-bottom-right-radius: 8px;
}
a, a:hover{
    text-decoration: none;
}
.search-box {
    margin: auto;
    max-width: 550px;
    display: flex;
    margin-bottom: 15px;
}
input.search {
    margin: 0;
    height: 30px;
    padding: 5px;
}
.search-icon {
    line-height: 30px;
    padding: 0 15px;
    background: #57bce2;
    color: #fff;
}
.product-box {
    margin: 20px auto;
    border: 1px solid #dbdbdb;
    border-radius: 8px;
    overflow: hidden;
}
.product-box img {
    display: block;
    margin: auto;
}
.prod-det {
    padding: 15px;
}
.product-box h1 {
    font-size: 18px;
    margin: 0;
    height: 24px;
    line-height: 24px;
    overflow: hidden;
}
.product-box .quantity {
    font-size: 13px;
    font-weight: 700;
    color: #8d8d8d;
    display: block;
    margin-top: -2px;
    margin-bottom: 12px;
}
.product-box .desc {
    font-size: 13px;
    font-weight: 700;
    color: #8d8d8d;
    display: block;
    margin-top: -2px;
    margin-bottom: 12px;
}
span.ratings {
    background: #FF5C58;
    padding: 0 6px;
    border-radius: 5px;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
}
.stars {
//    display: inline-block;
}
.ratings .fa-star{
    display: inline-blok;
    margin-left: 2px;
}
.price h2 {
    font-size: 20px;
    font-weight: 700;
    display: inline-block;
}
.price del {
    margin-left: 6px;
}
span.discount {
    margin-left: 6px;
    color: #4cb145;
    font-weight: 600;
}
.prod-det > a {
    display: inline-block;
    padding: 5px 0;
    background: #57bce2;
    color: #fff !important;
    font-weight: 700;
    margin-top: 10px;
    width: 48%;
    font-size: 13px;
    text-align: center;
}
.prod-det .buy-now{
    background: #42d79e;
}
.pagination li a {
    font-size: 16px;
    line-height: 14px;
    font-weight: 500;
    display: inline-block;
    height: unset;
    width: max-content;
}
.pagination{
    margin-bottom: 20px;
    margin-top: 30px;
}
.pagination-section .row{
    justify-content: center;
}
/*ADD TO CARD AND BUY BUTTON*/
.product-img{
    position: relative;
}
.product-img .cart-btn, .buy-btn {
    background: #fff;
    padding: 5px 10px;
    color: #000;
    border-bottom: 3px solid #42d79e;
    display: inline-block;
    font-weight: 500;
    font-size: 11px;
}
.product-img .buy-btn{
    border-bottom: 3px solid #57bce2;
    margin-left: 10px;
}
.product-img .cart-btn:hover{
    background-color: #42d79e;
    color: #fff;
    transition: 0.2s ease-in all;
}
.product-img .buy-btn:hover{
    background-color: #57bce2;
    color: #fff;
    transition: 0.2s ease-in all;    
}
.product-img .cart-btn:hover img, .buy-btn:hover img{
    filter: invert(1);
    transition: 0.2s ease-in all;
}
.product-img .action-btns img{
    width: 15px;
    margin-right: 2px;
    display: inline-block;
    transition: 0.2s ease-in all;
}
.product-img .action-btns {
    opacity: 0;
    position: absolute;
    bottom: 10px;
    transition: 0.2s ease-in all;
    display: flex;
    align-items: center;
    width: 100%;
    justify-content: center;
}
.product-box:hover .action-btns{
    opacity: 1;
}
.product-box:hover .img-overlay{
    width: 100%;
    height: 100%;
    background-color: #000;
    opacity: 0.6;
    position: absolute;
    transition: 0.2s ease-in all;
}
.product-img a.shop-btn {
    display: block;
    padding: 10px 20px;
    border: 2px solid #333;
    font-weight: 500;
    margin: 10px auto;
    width: fit-content;
    text-decoration: none;
}
@media only screen and (min-width: 1200px){
    .prod-det .cart-btn, .prod-det .buy-now{
        display: none !important;
    }
}
@media only screen and (max-width: 1199px){
    .img-overlay, .action-btns{
        display: none !important;
    }
}
//.pt20{
//padding-top:20px;
//}
//@media (min-width: 768px) and (max-width: 991px){
//	.hs_shop_prodt_img_cont_wrapper a{
//		display: block;
//		padding: 6px 12px;
//		margin-bottom: 6px;
//	}
//}
.filters {
    position: -webkit-sticky;
    position: sticky;
    top: 107px;
}
.shadow-sm {
    box-shadow: 0 0.125rem 1.25rem rgb(0 0 0 / 8%) !important;
}
.rounded {
    border-radius: 0.25rem!important;
}
.border-bottom {
    border-bottom: 1px solid #EFF2F7 !important;
}
.filters-card-header a {
    color: #3C4858 !important;
    display: inline-block;
    font-size: 15px;
    font-weight: 500;
    width: 100%;
}
.filters-card-header a i {
    color: #3868fb;
    margin: 2px -2px 0 0;
}
.filters-card-body {
    padding: 14px 0 0;
}
.filters-card-body .custom-control, .filters-card-body .custom-control-label {
    color: #8492A6;
    cursor: pointer;
    margin: 0 0 4px;
    width: 100%;
}
.filters-card-body .custom-control-label::before {
    background-color: #E5E9F2;
    border: #adb5bd solid 0px;
    box-shadow: none !important;
}
.filters-card-body .custom-checkbox .custom-control-label::before {
    background-color: #E5E9F2;
    border: #EFF2F7 solid 0;
    box-shadow: none;
}
    
 /* Style the list */
ul.breadcrumb {
  padding: 10px 16px;
  list-style: none;
  background-color: #eee;
}

/* Display list items side by side */
ul.breadcrumb li {
  display: inline;
  font-size: 18px;
}

/* Add a slash symbol (/) before/behind each list item */
ul.breadcrumb li+li:before {
  padding: 8px;
  color: black;
  content: "/\00a0";
}

/* Add a color to all links inside the list */
ul.breadcrumb li a {
  color: #0275d8;
  text-decoration: none;
}

/* Add a color on mouse-over */
ul.breadcrumb li a:hover {
  color: #01447e;
  text-decoration: underline;
}   
');
$script = <<<JS
$(document).ready(function(){
		    $('.count').prop('disabled', true);
   			$(document).on('click','.plus',function(){
				$('.count').val(parseInt($('.count').val()) + 1 );
    		});
        	$(document).on('click','.minus',function(){
    			$('.count').val(parseInt($('.count').val()) - 1 );
    				if ($('.count').val() == 0) {
						$('.count').val(1);
					}
    	    	});
 		});

$(document).on('click','.add_to_cart',function (e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.attr('data-id');
    var quantity = 1;
    if(btn.text() == 'Remove'){
    $.ajax({
            url: '/site/remove-to-cart',
            method: 'POST',
            data: {id: id},
            success: function (response) {
                if (response.status == 200) {
                    btn.text('Add to Cart');
                    // $.pjax.reload({container:"#add_to_cart_pjax"});
                    location.reload();
                } 
            },
        });    
    } else {
    $.ajax({
            url: '/site/add-to-cart',
            method: 'POST',
            data: {id: id,quantity:quantity},
            success: function (response) {
                if (response.status == 200) {
                    btn.text('Remove');
                    location.reload();
                    // $.pjax.reload({container:"#add_to_cart_pjax"});
                } 
            },
        });
    }
    // console.log(btn.text('Remove'));
    
});
$(document).on('click','.quantity_add_to_cart',function (e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.attr('data-id');
    var quantity = $('#input-quantity').val();
    var btn_data = 1; 
    if(!quantity){
        quantity = 1;
    }
    $.ajax({
            url: '/site/add-to-cart',
            method: 'POST',
            data: {id: id,quantity:quantity,btn_data:btn_data},
            success: function (response) {
                if (response.status == 200) {
                    location.reload();
                    toastr.success(response.message, response.title);
                    // $.pjax.reload({container:"#add_to_cart_pjax"});
                } else {
                    toastr.error(response.message, response.title);
                }
            },
        });
});
JS;
$this->registerJS($script);

$this->registerJsFile('https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<script>
    function changeQty(increase) {
        var qty = parseInt($('.select_number').find("input").val());
        if (!isNaN(qty)) {
            qty = increase ? qty + 1 : (qty > 1 ? qty - 1 : 1);
            $('.select_number').find("input").val(qty);
        } else {
            $('.select_number').find("input").val(1);
        }
    }


    /* Product Images Slider JS */
    const imgs = document.querySelectorAll('.img-select a');
    const imgBtns = [...imgs];
    let imgId = 1;

    imgBtns.forEach((imgItem) => {
        imgItem.addEventListener('click', (event) => {
            event.preventDefault();
            imgId = imgItem.dataset.id;
            slideImage();
        });
    });

    function slideImage() {
        const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

        document.querySelector('.img-showcase').style.transform = `translateX(${-(imgId - 1) * displayWidth}px)`;
    }

    window.addEventListener('resize', slideImage);
</script>