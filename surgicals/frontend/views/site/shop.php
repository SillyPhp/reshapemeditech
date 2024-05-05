<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use common\models\Categories;

$this->title = 'Our Shop';
$pageLink = Url::to('/site/shop', 'https');
$session = Yii::$app->session;
echo $this->render('/widgets/breadcrumb',[
    'title' => 'Products',
    'parentName' => 'Shop',
    'parentLink' => '/shop',
    'onlyParent' => true
]);
?>
    <!-- hs About Title Start -->
<!--    <section class="srch" style="margin-top: 50px;;">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-12">-->
<!--                    <div class="search-box">-->
<!--                        <input type="text" class="search" name=keyword id="shop_keyword" placeholder="Products Search.."-->
<!--                               value="--><?//= $keyword ?><!--">-->
<!--                        <i class="fa fa-search search-icon" id="shop_search" style="line-height: 30px;"></i>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="shop-products">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-sm-4">
                    <div class="filters shadow-sm rounded">
                        <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
                            <h5 class="m-0">Filter By</h5>
                        </div>
                        <div class="filters-body">
                            <?php
                            if($categories){
                                foreach($categories as $category) {
                            ?>
                                <div id="<?= $category['name']?>">
                                <div class="filters-card border-bottom p-4">
                                    <div class="filters-card-header" id="headingCategory">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse"
                                               data-target="#<?= $category['name'].$category['_id'] ?>" aria-expanded="true"
                                               aria-controls="<?= $category['name'].$category['_id'] ?>">
                                                <?= $category['name'] ?> <i class="icofont-thin-down float-right"></i>
                                            </a>
                                        </h6>
                                    </div>
                                    <div id="<?= $category['name'].$category['_id'] ?>" class="collapse show" aria-labelledby="headingCategory"
                                         data-parent="#<?= $category['name']?>" style="">
                                        <div class="filters-card-body card-shop-filters">
                                            <?php
                                            $subCategory = Categories::find()
                                                ->select(['name','_id'])
                                                ->where(['not',['status' => 3]])
                                                ->andWhere(['_parent_id' => $category['_id']])
                                                ->orderBy(['name' => SORT_ASC])
                                                ->asArray()
                                                ->all();
                                            if ($subCategory) {
                                                foreach ($subCategory as $subCat) {
                                                    $checkVal = '';
                                                    if ($cat) {
                                                        foreach ($cat as $c) {
                                                            if ($c == $subCat['name']) {
                                                                $checkVal = 'checked = "checked"';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input categories"
                                                               id="<?= $subCat['name'] ?>" name="stores"
                                                               value="<?= $subCat['name'] ?>" <?= $checkVal ?>>
                                                        <label class="custom-control-label"
                                                               for="<?= $subCat['name'] ?>"><?= $subCat['name'] ?> </label>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-sm-8">
                    <?php
                    Pjax::begin([
                        'id' => 'add_to_cart_btn_pjax']);
                    ?>
                    <div class="row">
                        <?php if ($products) {
                            foreach ($products as $pro) {
                                $discount = '';
                                ?>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="product-box">
                                        <?php
                                        $image = Yii::$app->functions->ProductImage($pro['_id']);
                                        $boxImage = Yii::$app->functions->ProductImages($pro['_id']);
                                        if ($image) {
                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $pro['_id'] . '/' . $image['file_enc_name'];
                                        }
                                        elseif($boxImage) {
                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $pro['_id'] . '/' . $boxImage['file_enc_name'];
                                        }
                                        else {
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
                                            <?php if($pro['short_description']){ ?>
                                                <span class="quantity"><?= substr($pro['short_description'], 0, 150);?></span>
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
                        } ?>
                    </div>
                    <?php
                    Pjax::end();
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php
$this->registerCSS('
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
');
$script = <<<JS
 $(".categories").click(function(){
     if($(this).attr('checked')){
         $(this).attr('checked',false);
     } else {
         $(this).attr('checked',true);
     }
     var categoriesData = '';
     $('input:checkbox[name=stores]:checked').each(function(k, v){
        categoriesData = categoriesData + $(v).val() +',';
     });
     window.location.href = '/shop?cat='+ categoriesData;
 });
$(document).on('click','.add_to_cart',function (e){
    e.preventDefault();
    var btn = $(this);
    var id = btn.attr('data-id');
    var quantity = 1;
    // if(btn.text() == 'Remove'){
    // $.ajax({
    //         url: '/site/remove-to-cart',
    //         method: 'POST',
    //         data: {id: id},
    //         success: function (response) {
    //             if (response.status == 200) {
    //                 btn.text('Add to Cart');
    //                 $.pjax.reload({container:"#add_to_cart_pjax"});
    //             } 
    //         },
    //     });    
    // } else {
    $.ajax({
            url: '/site/add-to-cart',
            method: 'POST',
            data: {id: id,quantity:quantity},
            success: function (response) {
                if (response.status == 200) {
                    // btn.text('Remove');
                    toastr.success(response.message, response.title);
                    $.pjax.reload({container:"#add_to_cart_pjax"});
                    $.pjax.reload({container:"#add_to_cart_btn_pjax"});
                    $.pjax.reload({container:"#add_to_cart_btn_pjax_title"});
                } 
            },
        });
    // }
    // console.log(btn.text('Remove'));
    
});
$(document).on('click','#shop_search',function(e) {
  e.preventDefault();
  var value = $('#shop_keyword').val();
  url = "$pageLink?keyword=" + value;
window.location.replace(url);
});
JS;
$this->registerJS($script);
?>