<?php

use yii\helpers\Url;

$this->title = 'Blog Detail';
$ref_link =  Url::to('/site/blog-detail?id='.$id,'https');

echo $this->render('/widgets/breadcrumb',[
    'title' => $blogData['name'],
    'parentName' => 'Blogs',
    'parentLink' => '/blogs',
]);
?>
<div class="blog-detail-page">
<div id="fixed-social">
    <div>
        <a href="https://www.facebook.com/The-Bodybay-544022222791308" class="fixed-facebook" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a>
    </div>
    <div>
        <a href="#" class="fixed-twitter" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a>
    </div>
    <div>
        <a href="https://www.instagram.com/thebodybay/" class="fixed-instagram" target="_blank"><i class="fa fa-instagram"></i> <span>Instagram</span></a>
    </div>
    <div>
        <a href="https://in.pinterest.com/TheBodyBay/_created/" class="fixed-pinterest" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> <span>Pinterest</span></a>
    </div>
    <div>
        <a href="#" class="fixed-youtube" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i> <span>Youtube</span></a>
    </div>
</div>
<div class="hs_indx_title_main_wrapper">
    <div class="hs_title_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                <div class="hs_indx_title_left_wrapper">
                    <h2><?= $blogData['name']?></h2>
                </div>
            </div>
            <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                <div class="hs_indx_title_right_wrapper">
                    <ul>
                        <li><a href="/">Home</a> &nbsp;&nbsp;&nbsp;&gt; </li>
                        <li><?= $blogData['name']?></li>
                    </ul>
                </div>
            </div> -->
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
                                    $image_path = Yii::$app->params['upload_directories']['blogs']['image'].$blogData['_uid'].'/'.$blogData['image'];
                                    ?>
                                    <img src="<?= $image_path?>" alt="<?= $blogData['name'] ?>"  style="width: 100%; height: auto">
                                </div>
                                <div class="hs_blog_box1_cont_main_wrapper">
                                    <ul class="date">
                                        <li><?= date('d M, Y',strtotime($blogData['created_at']))?></li>
                                    </ul>
                                    <div class="hs_blog_cont_heading_wrapper">
                                        <h2><?= $blogData['name']?></h2>
                                        <h4><span>&nbsp;</span></h4>
                                        <a href="javascript:;" onclick="window.open('<?= Url::to('https://api.whatsapp.com/send?text=' . $ref_link); ?>', '_blank', 'width=800,height=400,left=200,top=100');" class="mr20"><i class="fa fa-whatsapp f35"></i></a>
                                        <a href="javascript:;" onclick="window.open('<?= Url::to('https://www.facebook.com/sharer/sharer.php?u=' . $ref_link); ?>', '_blank', 'width=800,height=400,left=200,top=100');" class="mr20"><i class="fa fa-facebook-square f35"></i></a>
                                        <a href="javascript:;" onclick="window.open('<?= Url::to('mailto:?&body=' . $ref_link); ?>', '_blank', 'width=800,height=400,left=200,top=100');" class="mr20"><i class="fa fa-envelope f35"></i></a>
                                        <p><?= $blogData['description'] ?></p>

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
                                    <h2>Recent Blogs</h2>
                                </div>
                                <?php
                                if($allBlogs){
                                    foreach ($allBlogs as $b){
                                        ?>
                                        <div class="hs_blog_right_recnt_cont_wrapper">
                                            <div class="hs_footer_ln_img_wrapper">
                                                <?php
                                                $related_image_path = Yii::$app->params['upload_directories']['blogs']['image'].$b['_uid'].'/'.$b['image'];
                                                ?>
                                                <img src="<?= $related_image_path?>" class="img-responsive" alt="ln_img">
                                            </div>
                                            <div class="hs_footer_ln_cont_wrapper">
                                                <h4><a href="/site/blog-detail?id=<?= $b['_id']?>"><?= $b['name']?></a></h4>
                                                <p><?= date('d M Y',strtotime($b['created_at']))?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php
$this->registerCss('
/*=======SOCIAL BAR ICONS=======*/ 
/* fixed social*/
#fixed-social {
   position: fixed;
   top: 250px;
   z-index: 999;
}

#fixed-social a {
   color: #fff;
   display: block;
   height: 40px;
   position: relative;
   text-align: center;
    line-height: 40px;
   width: 40px;
   margin-bottom: 0;
   z-index: 2;
}
#fixed-social a:hover>span{
	visibility: visible;
  left: 40px;
  opacity: 1;
} 
#fixed-social a span {
	line-height: 40px;
    left: 60px;
    position: absolute;
    text-align: center;
    width: 120px;
    visibility: hidden;
    transition-duration: 0.5s;
    z-index: 1;
    opacity: 0;
}
 .fixed-facebook, .fixed-facebook span{
 	background-color: #1877f2;
 }
 .fixed-twitter, .fixed-twitter span{
	background-color: #1da1f2;

 }
 .fixed-instagram, .fixed-instagram span{
	background-color: #c32aa3;

 }
 .fixed-pinterest, .fixed-pinterest span{
	background-color: #bd081c;

 }
 .fixed-youtube, .fixed-youtube span{
	background-color: #ff0000;

 }
/*end fixed social*/



.blog-detail-page{
    background: #eee;
}
.hs_indx_title_main_wrapper {
    padding-top: 20px;
}
.hs_indx_title_right_wrapper ul {
    display: flex;
}
.hs_indx_title_right_wrapper ul li:nth-child(2) {
    margin-left: 15px;
}
.hs_blog_left_sidebar_main_wrapper {
    background: #fff;
    margin: 10px 0;
}
.hs_blog_box1_cont_main_wrapper {
    padding: 18px;
}
.hs_blog_box1_cont_main_wrapper ul.date li {
    display: inline-block;
    font-weight: 600;
    background: #b5e7ff;
    padding: 2px 10px;
    font-size: 14px;
    border-radius: 6px;
    color: #333;
}
.hs_blog_cont_heading_wrapper h2 {
    color: #323232;
    font-weight: 700;
}
.hs_blog_box1_cont_main_wrapper h4 {
    display: none;
}
.hs_footer_ln_img_wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.hs_footer_ln_img_wrapper {
    width: 100%;
    height: 135px;
}
.hs_blog_right_cate_list_heading_wrapper h2 {
    font-size: 20px;
    margin-bottom: 20px;
    font-weight: 700;
    color: #5a5a5a;
}
.hs_footer_ln_cont_wrapper * {
    font-size: 20px;
    display: block;
    margin-top: 5px;
    line-height: 23px;
    margin-bottom: 0;
}
.hs_footer_ln_cont_wrapper p {
    display: block;
    font-size: 14px;
    margin-top: 0;
    font-weight: 500;
    color: #303030;
}
.hs_blog_right_recnt_cont_wrapper {
    margin-bottom: 30px;
}
.mr20 {
    margin-right: 20px;
}
.f35{
font-size:35px;
}

@media only screen and (min-width: 992px){
    
    .pagination li {
        flex-basis: 20%;
    }
    .pagination li a {
        font-size: 20px;
        line-height: 38px;
        height: 40px;
        width: 100%;
    }
}
@media (min-width: 768px) and (max-width: 991px){
    .pagination li {
        flex-basis: 20%;
    }
    .pagination li a {
        font-size: 14px;
        line-height: 20px;
        height: 22px;
        width: 100%;
    }
    .hs_blog_right_sidebar_main_wrapper {
        margin-top: 0;
    }
}
@media only screen and (max-width: 767px){
    .pagination li a {
        line-height: 35px;
        height: 35px;
        width: 35px;
}

');