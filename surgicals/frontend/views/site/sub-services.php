<?php

use yii\helpers\Url;

$this->title = 'Sub Services';
?>
<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2><?= $ser['name'] . ' Services'?></h2>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hs_service_main_wrapper">
    <div class="container">
        <div class="row">
            <div class="portfolio-area ptb-100">
                <div class="container">
                    <div class="row">
                        <?php if($services) {
                            foreach ($services as $service) { ?>
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
                            <?php } }?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!--/.portfolio-area-->
        </div>
    </div>
</div>