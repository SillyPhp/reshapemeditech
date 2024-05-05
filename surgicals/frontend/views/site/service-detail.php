<?php
$this->title = 'Service Detail';
?>
    <div class="hs_indx_title_main_wrapper">
        <div class="hs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                    <div class="hs_indx_title_left_wrapper">
                        <h2><?= $service['name']?></h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                    <div class="hs_indx_title_right_wrapper">
                        <ul>
                            <li><a href="/">Home</a> &nbsp;&nbsp;&nbsp;&gt; </li>
                            <li><?= $service['name']?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hs_blog_categories_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="hs_blog_left_sidebar_main_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="hs_blog_box1_main_wrapper">
                                    <div class="hs_blog_box1_img_wrapper">
                                        <?php
                                        $image_path = Yii::$app->params['upload_directories']['services']['image'].$service['_uid'].'/'.$service['image'];
                                        ?>
                                        <img src="<?= $image_path?>" alt="service_img">
<!--                                        <ul>-->
<!--                                            <li>--><?//= date('d M, Y',strtotime($blogData['created_at']))?><!--</li>-->
<!--                                        </ul>-->
                                    </div>
                                    <div class="hs_blog_box1_cont_main_wrapper">
                                        <div class="hs_blog_cont_heading_wrapper">
                                            <h2><?= $service['name']?></h2>
                                            <h4><span>&nbsp;</span></h4>
                                            <p><?= $service['description'] ?></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="hs_blog_right_sidebar_main_wrapper">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="hs_kd_right_first_sec_wrapper hs_vs_list_wrapper">
                                    <div class="hs_blog_right_cate_list_heading_wrapper">
                                        <h2>More Service</h2>
                                    </div>
                                    <?php
                                    if($allServices){
                                        foreach ($allServices as $b){
                                            ?>
                                            <div class="hs_blog_right_recnt_cont_wrapper">
                                                <div class="hs_footer_ln_img_wrapper">
                                                    <?php
                                                    $related_image_path = Yii::$app->params['upload_directories']['services']['image'].$b['_uid'].'/'.$b['image'];
                                                    ?>
                                                    <img src="<?= $related_image_path?>" class="img-responsive" alt="ln_img">
                                                </div>
                                                <div class="hs_footer_ln_cont_wrapper">
                                                    <h4><a href="/site/service-detail?id=<?= $b['_uid']?>"><?= $b['name']?></a></h4>
<!--                                                    <p>--><?//= date('d M Y',strtotime($b['created_at']))?><!--</p>-->
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-sm visible-xs">
                                <div class="pager_wrapper">
                                    <ul class="pagination">
                                        <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
                                        <li class="btc_shop_pagi"><a href="#">01</a></li>
                                        <li class="btc_shop_pagi"><a href="#">02</a></li>
                                        <li class="btc_third_pegi btc_shop_pagi"><a href="#">03</a></li>
                                        <li class="hidden-xs btc_shop_pagi"><a href="#">04</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php if($subServices) { ?>
    <div class="hs_service_main_wrapper">
        <div class="container">
            <div class="row">
                <div class="portfolio-area ptb-100">
                    <div class="container">
                        <div class="row">
                            <?php
                                foreach ($subServices as $service) { ?>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="hs_service_main_box_wrapper">
                                            <div class="hs_service_icon_wrapper">
                                                <?php
                                                $image_path = Yii::$app->params['upload_directories']['services']['image'].$service['_uid'].'/'.$service['image'];
                                                ?>
                                                <img src="<?= $image_path ?>" height="50px" width="50px">
                                            </div>
                                            <div class="hs_service_icon_cont_wrapper">
                                                <h2><?= $service['name']?></h2>
                                                <p><?= $service['short_description']?></p>
                                                <!--                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>-->
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container -->
                </div>
                <!--/.portfolio-area-->
            </div>
        </div>
    </div>
<?php
}
$this->registerCss('
.hs_blog_cont_heading_wrapper *{
     background-color:transparent !important;
     color:#fff !important;
}
');