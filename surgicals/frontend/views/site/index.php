<?php

use yii\helpers\Url;

$this->title = 'The BodyBay';

?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="/images/banners/desktop/b1.jpeg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/images/banners/desktop/b2.jpeg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="/images/banners/desktop/b3.jpeg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<?php
    if ($proteins) {
        ?>
            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">

                <div class="col medium-2 small-12 large-2">
                    <div class="col-inner text-center">

                        <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>📈 TRENDING
                                IN PROTEINS</strong></p>
                        <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                        <a rel="noopener noreferrer" href="/shop?cat=whey protein" target="_blank" class="button primary">
                            <span class="btb btn-info viewBtn">View All</span>
                            <i class="icon-angle-right"></i></a>
                    </div>
                </div>
                <div class="col medium-10 small-12 large-10">
                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                            <!--fwp-loop-->

                            <?php
                            foreach ($proteins as $protein) {
                            ?>
                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                    <div class="col-inner">

                                        <div class="badge-container absolute left top z-1">
                                            <?php
                                            $discount = '';
                                            $mrp = '';
                                            if ($protein['productCombinationsOptions']) {
                                                $marketPrice = '';
                                                foreach ($protein['productCombinationsOptions'] as $option) {
                                                    if ($option['label'] == 'MRP') {
                                                        $marketPrice = $option['label_value'];
                                                        $mrp = $option['label_value'];
                                                    }
                                                }
                                                if ($marketPrice) {
                                                    $discount = $protein['sale_price'] / $marketPrice * 100;
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
                                                    <a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank">
                                                        <?php
                                                        $image = Yii::$app->functions->ProductImage($protein['_id']);
                                                        $boxImage = Yii::$app->functions->ProductImages($protein['_id']);
                                                        if ($image) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $image['file_enc_name'];
                                                        } elseif ($boxImage) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $boxImage['file_enc_name'];
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
                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank"><?= $protein['title'] ?></a></p>
                                                </div>
                                                <div class="price-wrapper">
                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                    </div>

                                                    <span class="price">From:
                                                        <?php if ($mrp) { ?>
                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                        <?php } ?>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($protein['sale_price'], '2') ?></span></ins></span>
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

<?php
    if ($proteins) {
        ?>
            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">

                <div class="col medium-2 small-12 large-2">
                    <div class="col-inner text-center">

                        <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>⚡ Flash Sale</strong></p>
                        <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                        <a rel="noopener noreferrer" href="/shop?cat=whey protein" target="_blank" class="button primary">
                            <span class="btb btn-info viewBtn">View All</span>
                            <i class="icon-angle-right"></i></a>
                    </div>
                </div>
                <div class="col medium-10 small-12 large-10">
                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                            <!--fwp-loop-->

                            <?php
                            foreach ($proteins as $protein) {
                            ?>
                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                    <div class="col-inner">

                                        <div class="badge-container absolute left top z-1">
                                            <?php
                                            $discount = '';
                                            $mrp = '';
                                            if ($protein['productCombinationsOptions']) {
                                                $marketPrice = '';
                                                foreach ($protein['productCombinationsOptions'] as $option) {
                                                    if ($option['label'] == 'MRP') {
                                                        $marketPrice = $option['label_value'];
                                                        $mrp = $option['label_value'];
                                                    }
                                                }
                                                if ($marketPrice) {
                                                    $discount = $protein['sale_price'] / $marketPrice * 100;
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
                                                    <a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank">
                                                        <?php
                                                        $image = Yii::$app->functions->ProductImage($protein['_id']);
                                                        $boxImage = Yii::$app->functions->ProductImages($protein['_id']);
                                                        if ($image) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $image['file_enc_name'];
                                                        } elseif ($boxImage) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $boxImage['file_enc_name'];
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
                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank"><?= $protein['title'] ?></a></p>
                                                </div>
                                                <div class="price-wrapper">
                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                    </div>

                                                    <span class="price">From:
                                                        <?php if ($mrp) { ?>
                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                        <?php } ?>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($protein['sale_price'], '2') ?></span></ins></span>
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

<?php
    if ($proteins) {
        ?>
            <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px;align-items: center;" id="row-77444144">

                <div class="col medium-2 small-12 large-2">
                    <div class="col-inner text-center">

                        <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>📈 Trending Now</strong></p>
                        <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                        <a rel="noopener noreferrer" href="/shop?cat=whey protein" target="_blank" class="button primary">
                            <span class="btb btn-info viewBtn">View All</span>
                            <i class="icon-angle-right"></i></a>
                    </div>
                </div>
                <div class="col medium-10 small-12 large-10">
                    <div class="col-inner setProductMargin" style="margin:15px 0px 10px 0px;">


                        <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                            <!--fwp-loop-->

                            <?php
                            foreach ($proteins as $protein) {
                            ?>
                                <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                                    <div class="col-inner">

                                        <div class="badge-container absolute left top z-1">
                                            <?php
                                            $discount = '';
                                            $mrp = '';
                                            if ($protein['productCombinationsOptions']) {
                                                $marketPrice = '';
                                                foreach ($protein['productCombinationsOptions'] as $option) {
                                                    if ($option['label'] == 'MRP') {
                                                        $marketPrice = $option['label_value'];
                                                        $mrp = $option['label_value'];
                                                    }
                                                }
                                                if ($marketPrice) {
                                                    $discount = $protein['sale_price'] / $marketPrice * 100;
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
                                                    <a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank">
                                                        <?php
                                                        $image = Yii::$app->functions->ProductImage($protein['_id']);
                                                        $boxImage = Yii::$app->functions->ProductImages($protein['_id']);
                                                        if ($image) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $image['file_enc_name'];
                                                        } elseif ($boxImage) {
                                                            $image_path = Yii::$app->params['upload_directories']['products']['image'] . $protein['_id'] . '/' . $boxImage['file_enc_name'];
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
                                                    <p class="name product-title"><a href="<?= Url::to('/product/' . $protein['slug']) ?>" target="_blank"><?= $protein['title'] ?></a></p>
                                                </div>
                                                <div class="price-wrapper">
                                                    <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                                    </div>

                                                    <span class="price">From:
                                                        <?php if ($mrp) { ?>
                                                            <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span></del>
                                                        <?php } ?>
                                                        <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($protein['sale_price'], '2') ?></span></ins></span>
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

<div class="row row-collapse row-full-width align-middle align-center" id="row-1840980197" style="background-color: #eee;margin: 0;padding: 12px 0px;">

    <div class="col medium-2 small-12 large-2">
        <div class="col-inner">
            <p class="uppercase" style="text-align: center; font-size: 20px; font-weight: 500;"><strong>POPULAR BRAND</strong></p>
        </div>
    </div>
    <div class="col medium-10 small-12 large-10">
        <div class="col-inner text-center" style="padding:0 10px; display: inline-block">

            <!-- <div class="row row-full-width align-middle align-right" id="row-1650105290">
                <?php
                if (is_array($brands) && count($brands) > 0) {
                    foreach ($brands as $brand) {
                ?>
                        <div class="col medium-3 small-6 large-3 brand-logos-div">
                            <div class="col-inner">
                                <img class="brand-logos" src="/images/brands/<?= $brand['_uid'] . '/' . $brand['image_enc_name'] ?>">
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div> -->

            <div class="brand-logo">
                <img src="/images/brands/all-brands.png" alt="">
            </div>

            <div class="col-md-12">
                <a href="/site/brands" class="view-all-brands">View All Brands</a>
            </div>

        </div>
    </div>
</div>
<style>
    .brand-logos {
        max-width: 100%;
        height: 82px;
    }

    .brand-logos-div {
        margin: 0 0 +15px 0;
    }
</style>
<?php
if ($foods) {
?>
    <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px" id="row-77444144">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner text-center">

                <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>📈 TRENDING
                        IN Foods/Drinks</strong></p>
                <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                <a rel="noopener noreferrer" href="/shop?cat=omega3" target="_blank" class="button primary">
                    <span>View All</span>
                    <i class="icon-angle-right"></i></a>
            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner" style="margin:15px 0px -30px 0px;">


                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                    <!--fwp-loop-->

                    <?php
                    foreach ($foods as $food) {
                    ?>
                        <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                            <div class="col-inner">

                                <div class="badge-container absolute left top z-1">
                                    <?php
                                    $discount = '';
                                    $mrp = '';
                                    if ($food['productCombinationsOptions']) {
                                        $marketPrice = '';
                                        foreach ($food['productCombinationsOptions'] as $option) {
                                            if ($option['label'] == 'MRP') {
                                                $marketPrice = $option['label_value'];
                                                $mrp = $option['label_value'];
                                            }
                                        }
                                        if ($marketPrice) {
                                            $discount = $food['sale_price'] / $marketPrice * 100;
                                            $discount = 100 - $discount;
                                            $discount = floor($discount) . '%';
                                        }
                                    }
                                    if ($discount) {
                                    ?>
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="product-small box ">
                                    <div class="box-image">
                                        <div class="image-none">
                                            <a href="<?= Url::to('/product/' . $food['slug']) ?>" target="_blank">
                                                <?php
                                                $image = Yii::$app->functions->ProductImage($food['_id']);
                                                $boxImage = Yii::$app->functions->ProductImages($food['_id']);
                                                if ($image) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $food['_id'] . '/' . $image['file_enc_name'];
                                                } elseif ($boxImage) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $food['_id'] . '/' . $boxImage['file_enc_name'];
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
                                            <p class="name product-title"><a href="<?= Url::to('/product/' . $food['slug']) ?>" target="_blank"><?= $food['title'] ?></a></p>
                                        </div>
                                        <div class="price-wrapper">
                                            <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                            </div>

                                            <span class="price">From:
                                                <?php if ($mrp) { ?>
                                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span>
                                                    </del>
                                                <?php } ?>
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($food['sale_price'], '2') ?></span></ins></span>
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
<?php }
if ($recentProduct) {
?>
    <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px" id="row-77444144">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner text-center">

                <p class="uppercase" style="text-align: center;  font-size: 15px; font-weight: 700;"><strong>📈 RECENTLY
                        ADDED</strong></p>
                <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                <a rel="noopener noreferrer" href="/recently-added" target="_blank" class="button primary">
                    <span>View All</span>
                    <i class="icon-angle-right"></i></a>
            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner" style="margin:15px 0px -30px 0px;">
                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">
                    <!--fwp-loop-->
                    <?php
                    foreach ($recentProduct as $recent) {
                    ?>
                        <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                            <div class="col-inner">

                                <div class="badge-container absolute left top z-1">
                                    <?php
                                    $discount = '';
                                    $mrp = '';
                                    if ($recent['productCombinationsOptions']) {
                                        $marketPrice = '';
                                        foreach ($recent['productCombinationsOptions'] as $option) {
                                            if ($option['label'] == 'MRP') {
                                                $marketPrice = $option['label_value'];
                                                $mrp = $option['label_value'];
                                            }
                                        }
                                        if ($marketPrice) {
                                            $discount = $recent['sale_price'] / $marketPrice * 100;
                                            $discount = 100 - $discount;
                                            $discount = floor($discount) . '%';
                                        }
                                    }
                                    if ($discount) {
                                    ?>
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="product-small box ">
                                    <div class="box-image">
                                        <div class="image-none">
                                            <a href="<?= Url::to('/product/' . $recent['slug']) ?>" target="_blank">
                                                <?php
                                                $image = Yii::$app->functions->ProductImage($recent['_id']);
                                                $boxImage = Yii::$app->functions->ProductImages($recent['_id']);
                                                if ($image) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $recent['_id'] . '/' . $image['file_enc_name'];
                                                } elseif ($boxImage) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $recent['_id'] . '/' . $boxImage['file_enc_name'];
                                                } else {
                                                    $image_path = '/images/default-image.png';
                                                }
                                                ?>
                                                <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"> </a>
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
                                            <p class="name product-title"><a href="<?= Url::to('/product/' . $recent['slug']) ?>" target="_blank"><?= $recent['title'] ?></a></p>
                                        </div>
                                        <div class="price-wrapper">
                                            <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                            </div>

                                            <span class="price">From:
                                                <?php if ($mrp) { ?>
                                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span>
                                                    </del>
                                                <?php } ?>
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($recent['sale_price'], '2') ?></span></ins></span>
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
<?php }

if ($categories) {
?>
    <div class="row row-collapse row-full-width align-middle align-center" id="row-1840980197" style="background-color: #eee;margin: 0;padding: 20px 0px;">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner">

                <p class="uppercase" style="text-align: center;">🔍<strong> TRENDING</strong></p>
                <p class="uppercase" style="text-align: center;"><strong>SEARCHES</strong></p>

            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner text-center" style="padding:15px 0px 0px 30px; display: inline-block">

                <div class="row row-full-width align-middle align-right" id="row-1650105290">
                    <?php foreach ($categories as $cat) { ?>
                        <div class="col medium-3 small-6 large-3">
                            <div class="col-inner" style="margin:0px 0px +15px 0px;">

                                <a href="/shop?cat=<?= $cat['name'] ?>" target="_self" class="button white is-small box-shadow-1 box-shadow-2-hover expand">
                                    <span><?= $cat['name'] ?></span>
                                </a>

                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php }

if ($gainers) {
?>
    <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px" id="row-77444144">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner text-center">

                <p class="uppercase" style="text-align: center;"><strong>📈 TRENDING IN GAINERS</strong></p>
                <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                <a rel="noopener noreferrer" href="/shop?cat=gainers" target="_blank" class="button primary">
                    <span>View All</span>
                    <i class="icon-angle-right"></i></a>
            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner" style="margin:15px 0px -30px 0px;">


                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                    <!--fwp-loop-->

                    <?php
                    foreach ($gainers as $gainer) {
                    ?>
                        <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                            <div class="col-inner">

                                <div class="badge-container absolute left top z-1">
                                    <?php
                                    $discount = '';
                                    $mrp = '';
                                    if ($gainer['productCombinationsOptions']) {
                                        $marketPrice = '';
                                        foreach ($gainer['productCombinationsOptions'] as $option) {
                                            if ($option['label'] == 'MRP') {
                                                $marketPrice = $option['label_value'];
                                                $mrp = $option['label_value'];
                                            }
                                        }
                                        if ($marketPrice) {
                                            $discount = $gainer['sale_price'] / $marketPrice * 100;
                                            $discount = 100 - $discount;
                                            $discount = floor($discount) . '%';
                                        }
                                    }
                                    if ($discount) {
                                    ?>
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="product-small box ">
                                    <div class="box-image">
                                        <div class="image-none">
                                            <a href="<?= Url::to('/product/' . $gainer['slug']) ?>" target="_blank">
                                                <?php
                                                $image = Yii::$app->functions->ProductImage($gainer['_id']);
                                                $boxImage = Yii::$app->functions->ProductImages($gainer['_id']);
                                                if ($image) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $gainer['_id'] . '/' . $image['file_enc_name'];
                                                } elseif ($boxImage) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $gainer['_id'] . '/' . $boxImage['file_enc_name'];
                                                } else {
                                                    $image_path = '/images/default-image.png';
                                                }
                                                ?>
                                                <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"> </a>
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
                                            <p class="name product-title"><a href="<?= Url::to('/product/' . $gainer['slug']) ?>" target="_blank"><?= $gainer['title'] ?></a></p>
                                        </div>
                                        <div class="price-wrapper">
                                            <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                            </div>

                                            <span class="price">From:
                                                <?php if ($mrp) { ?>
                                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span>
                                                    </del>
                                                <?php } ?>
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($gainer['sale_price'], '2') ?></span></ins></span>
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
<?php }

if ($bcaa) {
?>
    <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px" id="row-77444144">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner text-center">

                <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>📈 TRENDING
                        IN BCAA</strong></p>
                <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                <a rel="noopener noreferrer" href="/shop?cat=omega3" target="_blank" class="button primary">
                    <span>View All</span>
                    <i class="icon-angle-right"></i></a>
            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner" style="margin:15px 0px -30px 0px;">


                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                    <!--fwp-loop-->

                    <?php
                    foreach ($bcaa as $bca) {
                    ?>
                        <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                            <div class="col-inner">

                                <div class="badge-container absolute left top z-1">
                                    <?php
                                    $discount = '';
                                    $mrp = '';
                                    if ($bca['productCombinationsOptions']) {
                                        $marketPrice = '';
                                        foreach ($bca['productCombinationsOptions'] as $option) {
                                            if ($option['label'] == 'MRP') {
                                                $marketPrice = $option['label_value'];
                                                $mrp = $option['label_value'];
                                            }
                                        }
                                        if ($marketPrice) {
                                            $discount = $bca['sale_price'] / $marketPrice * 100;
                                            $discount = 100 - $discount;
                                            $discount = floor($discount) . '%';
                                        }
                                    }
                                    if ($discount) {
                                    ?>
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="product-small box ">
                                    <div class="box-image">
                                        <div class="image-none">
                                            <a href="<?= Url::to('/product/' . $bca['slug']) ?>" target="_blank">
                                                <?php
                                                $image = Yii::$app->functions->ProductImage($bca['_id']);
                                                $boxImage = Yii::$app->functions->ProductImages($bca['_id']);
                                                if ($image) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $bca['_id'] . '/' . $image['file_enc_name'];
                                                } elseif ($boxImage) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $bca['_id'] . '/' . $boxImage['file_enc_name'];
                                                } else {
                                                    $image_path = '/images/default-image.png';
                                                }
                                                ?>
                                                <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"> </a>
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
                                            <p class="name product-title"><a href="<?= Url::to('/product/' . $bca['slug']) ?>" target="_blank"><?= $bca['title'] ?></a></p>
                                        </div>
                                        <div class="price-wrapper">
                                            <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                            </div>

                                            <span class="price">From:
                                                <?php if ($mrp) { ?>
                                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span>
                                                    </del>
                                                <?php } ?>
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($bca['sale_price'], '2') ?></span></ins></span>
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
<?php }

if ($vitamins) {
?>
    <div class="row row-collapse align-middle align-center" style="max-width:100%;margin:0px" id="row-77444144">

        <div class="col medium-2 small-12 large-2">
            <div class="col-inner text-center">

                <p class="uppercase" style="text-align: center; font-size: 15px; font-weight: 700;"><strong>📈 TRENDING
                        IN VITAMINS</strong></p>
                <div class="gap-element clearfix" style="display:block; height:auto; padding-top:15px"></div>

                <a rel="noopener noreferrer" href="/shop?cat=vitamin" target="_blank" class="button primary">
                    <span>View All</span>
                    <i class="icon-angle-right"></i></a>
            </div>
        </div>
        <div class="col medium-10 small-12 large-10">
            <div class="col-inner" style="margin:15px 0px -30px 0px;">


                <div class="row large-columns-5 medium-columns-3 small-columns-2 row-normal row-full-width has-shadow row-box-shadow-1-hover">

                    <!--fwp-loop-->

                    <?php
                    foreach ($vitamins as $vitamin) {
                    ?>
                        <div class="product-small col has-hover product type-product post-6089529 status-publish first instock product_cat-brands product_cat-nutrabay product_cat-bodybuilding product_cat-proteins product_cat-whey-proteins product_cat-whey-isolate has-post-thumbnail sale purchasable product-type-variable">
                            <div class="col-inner">

                                <div class="badge-container absolute left top z-1">
                                    <?php
                                    $discount = '';
                                    $mrp = '';
                                    if ($vitamin['productCombinationsOptions']) {
                                        $marketPrice = '';
                                        foreach ($vitamin['productCombinationsOptions'] as $option) {
                                            if ($option['label'] == 'MRP') {
                                                $marketPrice = $option['label_value'];
                                                $mrp = $option['label_value'];
                                            }
                                        }
                                        if ($marketPrice) {
                                            $discount = $vitamin['sale_price'] / $marketPrice * 100;
                                            $discount = 100 - $discount;
                                            $discount = floor($discount) . '%';
                                        }
                                    }
                                    if ($discount) {
                                    ?>
                                        <div class="callout badge badge-circle">
                                            <div class="badge-inner secondary on-sale"><span class="onsale">-<?= $discount ?></span></div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="product-small box ">
                                    <div class="box-image">
                                        <div class="image-none">
                                            <a href="<?= Url::to('/product/' . $vitamin['slug']) ?>" target="_blank">
                                                <?php
                                                $image = Yii::$app->functions->ProductImage($vitamin['_id']);
                                                $boxImage = Yii::$app->functions->ProductImages($vitamin['_id']);
                                                if ($image) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $vitamin['_id'] . '/' . $image['file_enc_name'];
                                                } elseif ($boxImage) {
                                                    $image_path = Yii::$app->params['upload_directories']['products']['image'] . $vitamin['_id'] . '/' . $boxImage['file_enc_name'];
                                                } else {
                                                    $image_path = '/images/default-image.png';
                                                }
                                                ?>
                                                <img width="247" height="247" src="<?= $image_path ?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail"> </a>
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
                                            <p class="name product-title"><a href="<?= Url::to('/product/' . $vitamin['slug']) ?>" target="_blank"><?= $vitamin['title'] ?></a></p>
                                        </div>
                                        <div class="price-wrapper">
                                            <div id="widget-lite-short-woo" class="wiremo-widget-top  home.  shop ">
                                            </div>

                                            <span class="price">From:
                                                <?php if ($mrp) { ?>
                                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($mrp, '2') ?></span>
                                                    </del>
                                                <?php } ?>
                                                <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₹</span><?= number_format($vitamin['sale_price'], '2') ?></span></ins></span>
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
<?php }
?>
<section style="padding:100px 0;">
    <div class="container">
        <div class="row align-items-center mt-4">
            <div class="col-md-7">
                <h1>𝐖𝐡𝐚𝐭 𝐖𝐞 𝐀𝐫𝐞 𝐁𝐞𝐬𝐭 𝐈𝐧 </h1>
                <h2>We've got India Covered!</h2>
                <ul class="we-are-best">
                    <li>
                        We deliver our products directly to the customers without any involvement of any third
                        party. Thus,
                        cutting the extra charges that customers have to bear. Moreover, reducing the chances of
                        customers getting
                        forged products.
                    </li>
                    <li>
                        We deal in all kinds of 𝐡𝐞𝐚𝐥𝐭𝐡 𝐬𝐮𝐩𝐩𝐥𝐞𝐦𝐞𝐧𝐭𝐬 including Whey Proteins,
                        Gainers, BCAA,
                        Omega3, Multivitamins etc. We are among the best stores to 𝐛𝐮𝐲 𝐡𝐞𝐚𝐥𝐭𝐡
                        𝐬𝐮𝐩𝐩𝐥𝐞𝐦𝐞𝐧𝐭𝐬 online
                        all over India.
                    </li>
                    <li>
                        We believe in 100% customer satisfaction and wellness. Therefore, we provide 100%
                        𝐠𝐞𝐧𝐮𝐢𝐧𝐞
                        𝐩𝐫𝐨𝐝𝐮𝐜𝐭𝐬 at the fastest possible time directly to them because we know the
                        importance of physical
                        wellness and customer’s time. We are one of the 𝐛𝐞𝐬𝐭 𝐬𝐢𝐭𝐞 𝐭𝐨 𝐛𝐮𝐲 𝐡𝐞𝐚𝐥𝐭𝐡
                        𝐬𝐮𝐩𝐩𝐥𝐞𝐦𝐞𝐧𝐭𝐬 𝐨𝐧𝐥𝐢𝐧𝐞.
                    </li>
                </ul>
                <p>
                    We have noticed that customer’s health is sacrificed for the growth and personal benefits of a
                    business. At
                    The BodyBay, we focus on customer’s health as we know the importance of a person’s life.
                </p>
            </div>
            <div class="col-md-5">
                <img src="/images/best.png" />
            </div>
        </div>
    </div>
</section>


<!-- FAQ SECTION -->

<?php /*
if($faqs) {
?>
<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="https://user-images.githubusercontent.com/72601463/157686897-aeda4252-fcaf-4ad3-ad8d-66fb3a9b39ae.png">
            </div>
            <div class="col-md-6">
                <div class="tab-container">

                    <!-- Tab 1 -->
                    <?php foreach ($faqs as $faq) { ?>
                        <div class="tab-accordian">

                        <div class="titleWrapper inactive">
                            <h3><?= $faq['question']?></h3>

                            <div class="collapse-icon">
                                <div class="acc-close"></div>
                                <div class="acc-open"></div>
                            </div>
                        </div>

                        <div id="descwrapper" class="desWrapper">
                            <h3><?= $faq['answer']?></h3>
                        </div>

                    </div>
                     <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } */?> 




<!-- TESTIMONIALS -->

<div class="testimonials-clean">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Clients Testimonials </h2>
            <p class="text-center">Our customers love us! Read what they have to say below.</p>
        </div>
        <div class="row people">
            <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">Aenean tortor est, vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu gravida. Aliquam varius finibus est.</p>
                </div>
                <div class="author"><img class="rounded-circle" src="https://i.imgur.com/nUNhspp.jpg">
                    <h5 class="name">Ben Johnson</h5>
                    <p class="title">CEO of Company Inc.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">Praesent aliquam in tellus eu gravida. Aliquam varius finibus est, et interdum justo suscipit id.</p>
                </div>
                <div class="author"><img class="rounded-circle" src="https://i.imgur.com/o5uMfKo.jpg">
                    <h5 class="name">Carl Kent</h5>
                    <p class="title">Founder of Style Co.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 item">
                <div class="box">
                    <p class="description">Aliquam varius finibus est, et interdum justo suscipit. Vulputate quis leo in, vehicula rhoncus lacus. Praesent aliquam in tellus eu.</p>
                </div>
                <div class="author"><img class="rounded-circle" src="https://i.imgur.com/At1IG6H.png">
                    <h5 class="name">Emily Clark</h5>
                    <p class="title">Owner of Creative Ltd.</p>
                </div>
            </div>
        </div>
    </div>
</div>




<!--    <section class="newsletter section-padding">-->
<!--        <div class="container">-->
<!--            <form>-->
<!--                <input name="email" id="email" type="email" placeholder="Email Address...">-->
<!--                <button-->
<!--                        id="subscribe_email">subscribe-->
<!--                </button>-->
<!--            </form>-->
<!--        </div>-->
<!--    </section>-->
<?php
$this->registerCSS('
.viewBtn{
   "padding: 10px;
}
.view-all-brands{
    padding: 10px 30px;
    display: inline-block;
    border: 3px solid #545bc4;
    color: #545bc4;
    margin-top: 20px;
    border-radius: 0;
    font-weight: 600;
    transition:all 0.5s ease-in;
}
.view-all-brands:hover{
    background-color: #545bc4;
    color: #fff;
}
.we-are-desc{
    max-width:750px;
    margin: auto;
    margin-bottom: 20px;
    color: #444;
    font-family: cursive;
}
.we-are-best{
    margin-top:30px;
    padding-left:20px;
}
.we-are-best, .we-are-best li{
    list-style: square;
} 
.we-are-best li{
    margin-bottom:20px;
    color: #555;
}
.tagusi-counter{
    margin-bottom : 20px;
    margin-top : 20px;
}
.about .about-item img {
    height: 400px;
    object-fit: contain;
    width: 100%;
}
.rowContainer
{
    padding: 40px 0;
    margin: 10px 15px 15px;
    border-top: 1px solid #dfe3e6;
    word-break: break-word;
}
.rowContainer h1 {
    font-size: 24px;
    font-weight: 700;
    padding-top: 30px;
    padding-bottom: 15px;
}
.rowContainer h2 {
    font-size: 16px;
    font-weight: 700;
    padding: 15px 0;
}
.rowContainer1{
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    margin-bottom: 15px;
    flex-wrap: wrap;
}
.rowContainer1 h3{
font-size: 12px;
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;  
}
.rowContainer1 span {
    font-size: 12px;
    line-height: 1.5;
}
.productViewDetail{
cursor:pointer;
}

.row-collapse {
    padding: 0;
}
.row-full-width {
    max-width: 100%!important;
}
.small-12 {
    max-width: 100%;
    -ms-flex-preferred-size: 100%;
    flex-basis: 100%;
}
.small-6 {
    max-width: 50%;
    -ms-flex-preferred-size: 50%;
    flex-basis: 50%;
}
@media screen and (min-width: 550px){
.medium-2 {
    max-width: 16.66667%;
    -ms-flex-preferred-size: 16.66667%;
    flex-basis: 16.66667%;
}
  .medium-10 {
    max-width: 83.33333%;
    -ms-flex-preferred-size: 83.33333%;
    flex-basis: 83.33333%;
}
}
@media screen and (min-width: 850px){
.large-2 {
    max-width: 16.66667%;
    -ms-flex-preferred-size: 16.66667%;
    flex-basis: 16.66667%;
}
  .large-10 {
    max-width: 83.33333%;
    -ms-flex-preferred-size: 83.33333%;
    flex-basis: 83.33333%;
}
}
.row-collapse>.flickity-viewport>.flickity-slider>.col, .row-collapse>.col {
    padding: 0!important;
}
.col-inner {
    position: relative;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    background-position: 50% 50%;
    background-size: cover;
    background-repeat: no-repeat;
    -ms-flex: 1 0 auto;
    flex: 1 0 auto;
}
@media screen and (min-width: 850px){
.col:first-child .col-inner {
    margin-left: auto;
    margin-right: 0;
}
}
.z-1 {
    z-index: 21;
}

.left {
    left: 0;
}
.top {
    top: 0;
}
.absolute {
    position: absolute!important;
}
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
    max-width: 245px;
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

/*=========FAQ CSS========*/
.faq{
    background: #F1F2FF;
    padding: 50px 0;
}
.tab-container{
    padding: 20px 5px;
}

/* Tab Accordian */

h3 {
    font-size: 1rem;
    font-weight: 700;
    line-height: 20px;
    color: #4d4e58;
    margin: 0;
}

ul li,
p{
    font-weight: 400;
    font-size: .88rem;
    line-height: 20px;
    color: #969696;
    font-family: Inter,Tahoma,sans-serif;
}

a{
    color: #60bdb2;
    text-decoration: none;
    cursor: pointer;
}

.tab-accordian ul{
    padding-left: 22px;
}
.tab-accordian p{
    margin-top: 0;
}

.tab-accordian{
    width: 100%;
    box-shadow: 0 10px 30px rgba(0,0,0,.08);
    border-radius: 10px;
    // border: 1px solid #cecece;
    background: transparent;
    margin-bottom: 20px;
    overflow: hidden;
}

.titleWrapper{
    padding: 20px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    -webkit-user-select: none;
    user-select: none;
    transition: background-color .8s linear;
}
/* .titleWrapper.active{
    background: #fff;
} */
.desWrapper{
    background: #fff;
    max-height: 500px;
    display: none;
    padding: 20px;
    transition: max-height 1s ease-in;
}

/* Collapse Icon */

.collapse-icon{
    position: relative;
}
.collapse-icon .acc-close{
    height: 10px;
    border-left: 2px solid #0a7a7f;
    transition: all .5s ease-in-out;
    transform: rotate(45deg);
    opacity: 1;
}

.collapse-icon .acc-open {
	width: 10px;
	position: absolute;
	border-top: 2px solid #0a7a7f;
	transition: all .5s ease-in-out;
	transform: rotate(45deg);
	top: 43%;
	right: -10px;
}

.titleWrapper.active .collapse-icon{
    transition: all .5s ease-in-out;
	transform: rotateX(0deg);
}

.titleWrapper.inactive .collapse-icon{
    transition: all .5s ease-in-out;
	transform: rotateX(-180deg);
}



@media screen and (min-width: 550px){
.medium-3 {
    max-width: 25%;
    -ms-flex-preferred-size: 25%;
    flex-basis: 25%;
}
}

@media screen and (min-width: 850px){
.large-3 {
    max-width: 25%;
    -ms-flex-preferred-size: 25%;
    flex-basis: 25%;
}
}
.box-shadow-1, .box-shadow-1-hover:hover {
    box-shadow: 0 1px 3px -2px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);
border-radius: 5px!important;
width: 100%!important;
    max-width: 100%!important;
    padding-left: 0!important;
    padding-right: 0!important;
    display: block;
    background-color: #fff!important;
    color: #666!important;
     padding: 6px 10px;
}
@media screen and (min-width: 550px){
#row-1650105290 .col.medium-3.small-12.large-3 {
    max-width: 16%;
    flex-basis: 16%;
    margin-bottom: 20px;
}
}
#row-1840980197 > .col.medium-2.small-12.large-2 {
    display: flex;
    align-items: center;
}
.col.medium-2.small-12.large-2{
    display: flex;
    align-items: center;
}
p span{
    font-size: 16px;
    font-weight: 600;
}
.rowContainer {
    padding: 40px 20px;
    font-family: monospace;
}
.rowContainer p {
    color: #4f4f4f;
}
.rowContainer p span {
    font-size: 16px;
    font-weight: 600;
    color: #000;
}
@media (max-width: 550px){
.product-small.col{
    //   display: block;    
      margin: auto;
}

.row.row-box-shadow-1-hover{
    margin: 0;
}
.product-small.col{
    max-width: 49%;
    min-width: 49%;
}
}





/*========TESTIMONIALS CSS==========*/
.testimonials-clean {
    color:#313437;
    background-color:#eef4f7;
  }
  
  .testimonials-clean p {
    color:#7d8285;
  }
  
  .testimonials-clean h2 {
    font-weight:bold;
    margin-bottom:40px;
    padding-top:40px;
    color:inherit;
  }
  
  @media (max-width:767px) {
    .testimonials-clean h2 {
      margin-bottom:25px;
      padding-top:25px;
      font-size:24px;
    }
  }
  
  .testimonials-clean .intro {
    font-size:16px;
    max-width:500px;
    margin:0 auto;
  }
  
  .testimonials-clean .intro p {
    margin-bottom:0;
  }
  
  .testimonials-clean .people {
    padding:50px 0 20px;
  }
  
  .testimonials-clean .item {
    margin-bottom:32px;
  }
  
  @media (min-width:768px) {
    .testimonials-clean .item {
      height:220px;
    }
  }
  
  .testimonials-clean .item .box {
    padding:30px;
    background-color:#fff;
    position:relative;
  }
  
  .testimonials-clean .item .box:after {
    content:"";
    position:absolute;
    left:30px;
    bottom:-24px;
    width:0;
    height:0;
    border:15px solid transparent;
    border-width:12px 15px;
    border-top-color:#fff;
  }
  
  .testimonials-clean .item .author {
    margin-top:28px;
    padding-left:25px;
  }
  
  .testimonials-clean .item .name {
    font-weight:bold;
    margin-bottom:2px;
    color:inherit;
  }
  
  .testimonials-clean .item .title {
    font-size:13px;
    color:#9da9ae;
  }
  
  .testimonials-clean .item .description {
    font-size:15px;
    margin-bottom:0;
  }
  
  .testimonials-clean .item img {
    width: 40px;
    height: 40px;
    float: left;
    margin-right: 12px;
    margin-top: -5px;
    object-fit: cover;
    object-position: center;
  }

');
$script = <<<JS
/* FAQ JS */
jQuery(document).ready(function(){
	jQuery('.titleWrapper').click(function(){
		var toggle = jQuery(this).next('div#descwrapper');
		jQuery(toggle).slideToggle("slow");
	});
    jQuery('.inactive').click(function(){
		jQuery(this).toggleClass('inactive active');
	});
});

var mobileList = ['/images/banners/mobile/mb1.jpg', '/images/banners/mobile/mb2.jpg', '/images/banners/mobile/mb3.jpg'];
if ($(window).width() < 500){
    let elemLists = 0;
    $('.carousel-item').each(function(){
        if(mobileList.length > elemLists){
           $(this).children('img').attr('src', mobileList[elemLists]);
           elemLists++;
       } else{
            $(this).children('img').attr('src', mobileList[elemLists -1]);
       }
    });
}

$(document).on('click','.productViewDetail',function(e){
    e.preventDefault();
    var btnValue = $(this).attr('data-id');
    window.open('/site/shop-detail?id='+btnValue);
});
$(document).on('click','#subscribe_email',function (e){
    e.preventDefault();
    var form = $('#email');
    var btn = $(this);
    var email = form.val();
    if(email){
        form.val('');
        $.ajax({
        url: '/site/subscribe',
        type: 'POST',
        data: {email:email},
        beforeSend: function () {
            btn.attr('disabled', true);
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                btn.attr('disabled', false);
                form.val('');
            } else {
                toastr.error(response.message, response.title);
            }
        },
    });
    }
});
JS;
$this->registerJs($script);
