<?php
use yii\helpers\Url;
?>

<div class="category-page">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="subcat-list">
                    <div class="cat-head-drop">
                        <h1>Categories</h1>
                        <i class="fas fa-angle-down"></i>
                    </div>
                    <div class="cat cat1">
                        <h2 class="cat-head">Proteins</h2>
                        <ul>
                            <li>Whey Protein</li>
                            <li>Protein Powder</li>
                            <li>Weight gainer</li>
                        </ul>
                    </div>
                    <div class="cat cat2">
                        <h2 class="cat-head">Vitamins, Minerals and Supplements</h2>
                        <ul>
                            <li>Omega 3</li>
                            <li>Fish Oil</li>
                            <li>Fat Burner</li>
                        </ul>
                    </div>
                    <div class="cat cat3">
                        <h2 class="cat-head">Aurvedic and Herbs</h2>
                        <ul>
                            <li>Milk Thistle</li>
                            <li>Ginsing Tablet and Capsule</li>
                            <li>Lutein Tablet and Capsule</li>
                        </ul>
                    </div>
                    <div class="cat cat4">
                        <h2 class="cat-head">Health, Food and Drinks</h2>
                        <ul>
                            <li>Peanut Butters</li>
                            <li>Protein Bars</li>
                        </ul>
                    </div>
                    <div class="cat cat5">
                        <h2 class="cat-head">Wellness</h2>
                        <ul>
                            <li>Biotin Tablets</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="cat-banner">
                    <img src="/images/banners/desktop/protein-banner.jpg" alt="">
                </div>
                <div class="treding-sections">
                    <div class="trending-cat trending-cat1">

                        <h1 class="trending-cat-head">Treding in Proteins</h1>

                        <?php
                        if ($proteins) {
                        ?>
                            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">
                                <div class="col medium-10 small-12 large-10">
                                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                                            <!--fwp-loop-->

                                            <?php
                                            foreach ($proteins as $x => $product) {
                                            ?>
                                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                                    <div class="col-inner">

                                                        <div class="badge-container absolute left top z-1">
                                                            <?php
                                                            $discount = '';
                                                            $mrp = '';
                                                            if ($product['productCombinationsOptions']) {
                                                                $marketPrice = '';
                                                                foreach ($product['productCombinationsOptions'] as $option) {
                                                                    if ($option['label'] == 'MRP') {
                                                                        $marketPrice = $option['label_value'];
                                                                        $mrp = $option['label_value'];
                                                                    }
                                                                }
                                                                if ($marketPrice) {
                                                                    $discount = $product['sale_price'] / $marketPrice * 100;
                                                                    $discount = 100 - $discount;
                                                                    $discount = floor($discount) . '%';
                                                                }
                                                            }
                                                            if ($discount) {
                                                            ?>
                                                                <div class="callout badge badge-circle">
                                                                    <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="product-small box ">
                                                            <div class="box-image">
                                                                <div class="image-none">
                                                                    <a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank">
                                                                        <?php
                                                                        $image = Yii::$app->functions->ProductImage($product['_id']);
                                                                        $boxImage = Yii::$app->functions->ProductImages($product['_id']);
                                                                        if ($image) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $image['file_enc_name'];
                                                                        } elseif ($boxImage) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $boxImage['file_enc_name'];
                                                                        } else {
                                                                            $image_path = '/images/default-image.png';
                                                                        }
                                                                        ?>
                                                                        <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail">
                                                                    </a>
                                                                </div>
                                                                <div class="image-tools is-small top right show-on-hover">
                                                                </div>
                                                                <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                                </div>
                                                                <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                                </div>
                                                            </div><!-- box-image -->

                                                            <div class="box-text box-text-products text-center grid-style-2">
                                                                <div class="title-wrapper">
                                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank"><?= $product['title'] ?></a></p>
                                                                </div>
                                                                <div class="price-wrapper">
                                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                                    </div>

                                                                    <span class="price">From:
                                                                        <?php if ($mrp) { ?>
                                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                                        <?php } ?>
                                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($product['sale_price'], '2') ?></span></ins></span>
                                                                </div>
                                                                <div class="inline-badges">
                                                                    <div class="xlwcfg_text_outer_wrap"></div>
                                                                </div>
                                                            </div><!-- box-text -->
                                                        </div><!-- box -->
                                                    </div><!-- .col-inner -->
                                                </div><!-- col -->

                                            <?php
                                            }
                                            ?>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                    <div class="trending-cat trending-cat2">

                        <h1 class="trending-cat-head">Treding in Protein Powder</h1>

                        <?php
                        if ($gainers) {
                        ?>
                            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">
                                <div class="col medium-10 small-12 large-10">
                                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                                            <!--fwp-loop-->

                                            <?php
                                            foreach ($gainers as $x => $product) { if($x < 3){
                                            ?>
                                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                                    <div class="col-inner">

                                                        <div class="badge-container absolute left top z-1">
                                                            <?php
                                                            $discount = '';
                                                            $mrp = '';
                                                            if ($product['productCombinationsOptions']) {
                                                                $marketPrice = '';
                                                                foreach ($product['productCombinationsOptions'] as $option) {
                                                                    if ($option['label'] == 'MRP') {
                                                                        $marketPrice = $option['label_value'];
                                                                        $mrp = $option['label_value'];
                                                                    }
                                                                }
                                                                if ($marketPrice) {
                                                                    $discount = $product['sale_price'] / $marketPrice * 100;
                                                                    $discount = 100 - $discount;
                                                                    $discount = floor($discount) . '%';
                                                                }
                                                            }
                                                            if ($discount) {
                                                            ?>
                                                                <div class="callout badge badge-circle">
                                                                    <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="product-small box ">
                                                            <div class="box-image">
                                                                <div class="image-none">
                                                                    <a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank">
                                                                        <?php
                                                                        $image = Yii::$app->functions->ProductImage($product['_id']);
                                                                        $boxImage = Yii::$app->functions->ProductImages($product['_id']);
                                                                        if ($image) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $image['file_enc_name'];
                                                                        } elseif ($boxImage) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $boxImage['file_enc_name'];
                                                                        } else {
                                                                            $image_path = '/images/default-image.png';
                                                                        }
                                                                        ?>
                                                                        <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail">
                                                                    </a>
                                                                </div>
                                                                <div class="image-tools is-small top right show-on-hover">
                                                                </div>
                                                                <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                                </div>
                                                                <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                                </div>
                                                            </div><!-- box-image -->

                                                            <div class="box-text box-text-products text-center grid-style-2">
                                                                <div class="title-wrapper">
                                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank"><?= $product['title'] ?></a></p>
                                                                </div>
                                                                <div class="price-wrapper">
                                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                                    </div>

                                                                    <span class="price">From:
                                                                        <?php if ($mrp) { ?>
                                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                                        <?php } ?>
                                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($product['sale_price'], '2') ?></span></ins></span>
                                                                </div>
                                                                <div class="inline-badges">
                                                                    <div class="xlwcfg_text_outer_wrap"></div>
                                                                </div>
                                                            </div><!-- box-text -->
                                                        </div><!-- box -->
                                                    </div><!-- .col-inner -->
                                                </div><!-- col -->

                                            <?php
                                            }}
                                            ?>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                    
                    <div class="trending-cat trending-cat1">

                        <h1 class="trending-cat-head">Treding in Proteins</h1>

                        <?php
                        if ($proteins) {
                        ?>
                            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">
                                <div class="col medium-10 small-12 large-10">
                                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                                            <!--fwp-loop-->

                                            <?php
                                            foreach ($proteins as $x => $product) { if($x < 3){
                                            ?>
                                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                                    <div class="col-inner">

                                                        <div class="badge-container absolute left top z-1">
                                                            <?php
                                                            $discount = '';
                                                            $mrp = '';
                                                            if ($product['productCombinationsOptions']) {
                                                                $marketPrice = '';
                                                                foreach ($product['productCombinationsOptions'] as $option) {
                                                                    if ($option['label'] == 'MRP') {
                                                                        $marketPrice = $option['label_value'];
                                                                        $mrp = $option['label_value'];
                                                                    }
                                                                }
                                                                if ($marketPrice) {
                                                                    $discount = $product['sale_price'] / $marketPrice * 100;
                                                                    $discount = 100 - $discount;
                                                                    $discount = floor($discount) . '%';
                                                                }
                                                            }
                                                            if ($discount) {
                                                            ?>
                                                                <div class="callout badge badge-circle">
                                                                    <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="product-small box ">
                                                            <div class="box-image">
                                                                <div class="image-none">
                                                                    <a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank">
                                                                        <?php
                                                                        $image = Yii::$app->functions->ProductImage($product['_id']);
                                                                        $boxImage = Yii::$app->functions->ProductImages($product['_id']);
                                                                        if ($image) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $image['file_enc_name'];
                                                                        } elseif ($boxImage) {
                                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $product['_id'] . '/' . $boxImage['file_enc_name'];
                                                                        } else {
                                                                            $image_path = '/images/default-image.png';
                                                                        }
                                                                        ?>
                                                                        <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail">
                                                                    </a>
                                                                </div>
                                                                <div class="image-tools is-small top right show-on-hover">
                                                                </div>
                                                                <div class="image-tools is-small hide-for-small bottom left show-on-hover">
                                                                </div>
                                                                <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                                                </div>
                                                            </div><!-- box-image -->

                                                            <div class="box-text box-text-products text-center grid-style-2">
                                                                <div class="title-wrapper">
                                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $product['slug']) ?>" target="_blank"><?= $product['title'] ?></a></p>
                                                                </div>
                                                                <div class="price-wrapper">
                                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                                    </div>

                                                                    <span class="price">From:
                                                                        <?php if ($mrp) { ?>
                                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                                        <?php } ?>
                                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($product['sale_price'], '2') ?></span></ins></span>
                                                                </div>
                                                                <div class="inline-badges">
                                                                    <div class="xlwcfg_text_outer_wrap"></div>
                                                                </div>
                                                            </div><!-- box-text -->
                                                        </div><!-- box -->
                                                    </div><!-- .col-inner -->
                                                </div><!-- col -->

                                            <?php
                                            }}
                                            ?>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    let dropIcon = document.querySelector('.cat-head-drop i');
    let catList = document.querySelector('.subcat-list');
    dropIcon.addEventListener('click', ()=>{
        catList.classList.toggle('drop-open');
    });
</script>


<?php
$this->registerCss('
.category-page{
    padding-top: 60px;
    margin-bottom: 50px;
}

/*=====CATEGORY LIST CSS======*/
.subcat-list {
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 3px 0 #aaa;
    margin-bottom: 20px;
    transition: .3s ease-out all;
}
.subcat-list h1 {
    font-size: 24px;
    font-weight: 800;
    color: #333;
    margin-bottom: 20px;
}
.subcat-list .cat-head-drop{
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    transition: .3s ease-out all;
}
.cat-head-drop i{
    display: none;
}
.drop-open.subcat-list{
    height: 675px;
    transition: .3s ease-out all;
}
.drop-open.subcat-list i {
    transform: rotate(180deg);
    transition: .3s ease-out all;
}
.cat h2.cat-head {
    font-size: 18px;
    font-weight: 600;
    color: #333;
}
.cat ul li {
    color: #666;
    font-weight: 500;
}
.cat {
    margin-bottom: 35px;
}
.cat:last-child{
    margin-bottom: 0;
}

/*=========CATEGORY BANNER===========*/
.cat-banner img{
    width: 100%;
}




/*=========TRENDING SECTION CSS===========*/
.product-small.col{
    max-width: 33%;
}
.trending-cat-head{
    font-size: 24px;
    font-weight: 700;
    color: #666;
}
.trending-cat{
    margin-top: 50px;
}


/*=========PRODUCT CSS==============*/
.badge-container {
    margin: 10px 0 0;
}
.badge {
    display: table;
    z-index: 20;
    pointer-events: none;
    height: 2.8em;
    width: 2.8em;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.row-collapse .badge-circle {
    height: 40px;
    width: 40px;
    padding: 0;
}
.badge-inner.on-sale {
    background-color: #222B3D;
}
.badge-inner {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    width: 100%;
    height: 100%;
    background-color: #446084;
    line-height: .85;
    color: #fff;
    font-weight: bolder;
    padding: 2px;
    white-space: nowrap;
    transition: background-color .3s,color .3s,border .3s;
}
.badge-circle-inside .badge-inner, .badge-circle .badge-inner {
    border-radius: 999px;
}
.badge-container .onsale {
    display: block!important;
}
.box-image {
    position: relative;
    height: auto;
    margin: 0 auto;
    overflow: hidden;
}
.box-image img {
    max-width: 100%;
    width: 100%;
    transform: translateZ(0);
    margin: 0 auto;
}
#widget-lite-short-woo {
    position: relative;
}
.widget-lite {
    display: inline-block;
}
.widget-lite, .wiremo-widget-top .widget-lite .widget-lite-container {
    position: relative;
}
.widget-lite .widget-lite-container {
    display: flex;
    flex-wrap: wrap;
    font-size: 18px;
    line-height: 0;
}
.widget-lite .widget-lite-container a, .widget-lite .widget-lite-container svg {
    position: initial;
    width: auto!important;
    background: 0 0;
    border: none;
    border-bottom: none;
    border-left: none;
    border-right: none;
    border-top: none;
    top: initial;
    right: initial;
    bottom: initial;
    left: initial;
    box-shadow: none;
    display: inline-block;
    filter: none;
    float: none;
    margin: 0;
    opacity: 1;
    outline: 0;
    padding: 0;
    transform: none;
    vertical-align: middle;
}
.box-text h1, .box-text h2, .box-text h3, .box-text h4, .box-text h5, .box-text h6, .box-text a:not(.button) {
    line-height: 1.3;
    margin-top: 0.1em;
    margin-bottom: 0.1em;
    color: #545bc4;
}
p.name.product-title {
    height: 45px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow:hidden;
}
.widget-lite-score, .widget-lite .widget-lite-score {
    position: fixed;
    max-width: 100%;
    display: none;
    width: 300px;
    padding: 20px;
    z-index: 999999;
    background-color: #fff;
    border-radius: 5px;
    border: 1px solid #d8d8d8;
    left: 83px;
}
.widget-lite-score .widget-lite-score-detailed {
    table-layout: auto!important;
    display: table!important;
    font-size: 14px!important;
    font-weight: 600!important;
    border-collapse: collapse!important;
    white-space: nowrap!important;
    margin: 0!important;
    padding: 0!important;
    border: 0!important;
    border: none!important;
    border-top: none!important;
    border-right: none!important;
    border-bottom: none!important;
    border-left: none!important;
    display: table!important;
}
.widget-lite-score .widget-lite-score-detailed, .widget-lite-score .widget-lite-score-detailed tr, .widget-lite-score .widget-lite-score-detailed tr td, .widget-lite div {
    background: 0 0;
    top: initial;
    right: initial;
    bottom: initial;
    left: initial;
    box-shadow: none;
    filter: none;
    float: none;
    opacity: 1;
    outline: 0;
    transform: none;
}

element.style {
}
.widget-lite-score .widget-lite-score-detailed tr, .widget-lite-score .widget-lite-score-detailed tr td {
    padding: 0!important;
    margin: 0!important;
    border: none!important;
    text-transform: lowercase!important;
    border-top: none!important;
    border-right: none!important;
    border-bottom: none!important;
    border-left: none!important;
    line-height: 1!important;
    padding-left: 10px!important;
}
.price-wrapper .price {
    display: block;
}

.price {
    line-height: 1;
}
span.amount {
    white-space: nowrap;
    color: #111;
    font-weight: 700;
}
del span.amount {
    opacity: .6;
    font-weight: 400;
    margin-right: 0.3em;
    font-size:13px;
}
.product-small.col{
    width: 100%;
    max-width: 240px;
    display: inline-block;
    margin-bottom: 5px;
    padding-bottom: 20px;
    transition: all 0.3s ease-in;
}
.product-small.col:hover{
    box-shadow:1px 1px 10px 1px #ddd;
}
.row.row-box-shadow-1-hover {
    display: block;
}
#row-77444144 > div > .col-inner{
    margin:15px 0px 10px 0px !important;
}
.price-wrapper .price ins{
    text-decoration: none;
}
#row-77444144 > div.medium-2 > .col-inner {
//    margin-top: 110px !important;
}

@media only screen and (max-width: 1199px){
    .product-small.col{
        max-width: 49%;
    }
}

@media only screen and (max-width: 767px){
    .subcat-list h1 {
        font-size: 20px;
    }
    .subcat-list {
        height: 60px;
        overflow: hidden;
    }
    .cat-head-drop i{
        display: block;
    }
}

');
?>