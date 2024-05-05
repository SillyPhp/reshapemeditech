<?php

use yii\helpers\Url;

?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="hs_about_heading_main_wrapper">
                    <div class="hs_about_heading_wrapper">
                        <h2>Our <span> services</span></h2>
                        <h4><span>&nbsp;</span></h4>
                        <p>Get dependable and cost-effective answers to all of your difficulties.</p>
                    </div>
                </div>
            </div>
            <div class="portfolio-area ptb-100">
                <div class="container">
                    <div class="row">
                        <?php if ($services) {
                            foreach ($services as $service) { ?>
                                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                    <div class="hs_service_main_box_wrapper">
                                        <a href="<?= Url::to('/site/sub-services?id=' . $service['_uid']) ?>">
                                            <div class="hs_service_icon_wrapper">
                                                <?php
                                                $image_path = Yii::$app->params['upload_directories']['services']['image'] . $service['_uid'] . '/' . $service['image'];
                                                ?>
                                                <img src="<?= $image_path ?>" height="50px" width="50px">
                                            </div>
                                            <div class="hs_service_icon_cont_wrapper">
                                                <h2><?= $service['name'] ?></h2>
                                                <p><?= $service['short_description'] ?></p>
                                                <!--                                <h5><a href="#">Read More <i class="fa fa-long-arrow-right"></i></a></h5>-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container -->
            </div>
            <!--/.portfolio-area-->
        </div>
    </div>
<?php
$this->registerCSS('
.hs_service_main_box_wrapper {
    float: left;
    width: 100%;
    height: 340px;
    text-align: center;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 0px 30px 40px 30px;
    margin-top: 83px;
    -webkit-transition: all 0.5s;
    -o-transition: all 0.5s;
    -ms-transition: all 0.5s;
    -moz-transition: all 0.5s;
    transition: all 0.5s;
}
');