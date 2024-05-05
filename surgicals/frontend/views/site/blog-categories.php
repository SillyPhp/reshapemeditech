<?php

use yii\helpers\Url;

$this->title = "Blog Categories";
$pageLink = Url::to('/site/blog-categories');

echo $this->render('/widgets/breadcrumb',[
    'title' => 'Blogs',
    'parentName' => 'Blogs',
    'parentLink' => '/blogs',
    'onlyParent' => true
]);

?>

<!-- <section class="page-header">
        <div class="overlay section-padding">
            <div class="container">
                <h2>Our Blogs</h2>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li>/ Blog </li>
                </ul>
            </div>
        </div>
    </section> -->

<div id="fixed-social">
    <div>
        <a href="#" class="fixed-facebook" target="_blank"><i class="fa fa-facebook"></i> <span>Facebook</span></a>
    </div>
    <div>
        <a href="#" class="fixed-twitter" target="_blank"><i class="fa fa-twitter"></i> <span>Twitter</span></a>
    </div>
    <div>
        <a href="#" class="fixed-instagram" target="_blank"><i class="fa fa-instagram"></i> <span>Instagram</span></a>
    </div>
    <div>
        <a href="#" class="fixed-pinterest" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i> <span>Pinterest</span></a>
    </div>
    <div>
        <a href="#" class="fixed-youtube" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i> <span>Youtube</span></a>
    </div>
</div>

<section class="blog">

    <!-- <div class="container">
        <div class="row">
            <?php
            if ($data) {
                foreach ($data as $blog) {
            ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-post">
                            <?php
                            $image_path = Yii::$app->params['upload_directories']['blogs']['image'] . $blog['_uid'] . '/' . $blog['image'];
                            ?>

                            <a href="javascript:;"><img src="<?= $image_path ?>" alt="blog_img" class="blog_img"></a>
                            <div class="blog-info">
                                <ul>
                                    <li><i class="far fa-clock"></i><?= date('d M, Y', strtotime($blog['created_at'])) ?></li>
                                </ul>
                                <h4><a href="/blog/<?= $blog['_id'] ?>"><?= $blog['name'] ?></a></h4>
                                <p><?= $blog['short_description'] ?></p>
                                <a href="/blog/<?= $blog['_id'] ?>" class="post-button">Read More</a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
        <ul class="pagination">
            <?php if ($all_blogs) {
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                    $prev_page = Url::to('/site/blog?page=' . $prev_page . '&keyword=' . $keyword);
                    $prev_disabled = '';
                } else {
                    $prev_page = 'javascript:;';
                    $prev_disabled = 'disabled';
                }
                if ($current_page < $all_blogs) {
                    $next_page = $current_page + 1;
                    $next_page = Url::to('/site/blog?page=' . $next_page . '&keyword=' . $keyword);
                    $next_disabled = '';
                } else {
                    $next_page = 'javascript:;';
                    $next_disabled = 'disabled';
                }
            ?>
                <li class="<?= $prev_disabled ?>"><a href="<?= $prev_page ?>"><i class="fa fa-angle-left"></i></a></li>
                <?php for ($i = 1; $i <= $all_blogs; $i++) { ?>
                    <?php $page = Url::to('/site/blog?page=' . $i . '&keyword=' . $keyword) ?>
                    <li class="<?= ($current_page == $i) ? 'active' : '' ?>"><a href="<?= $page ?>"><?= $i ?></a></li>
                <?php } ?>
                <li class="<?= $next_disabled ?>"><a href="<?= $next_page ?>"><i class="fa fa-angle-right"></i></a></li>
            <?php } ?>
        </ul>
    </div> -->

    <div class="container">

        <div class="blog-head">
            <a href="/blog/<?= $data[0]['_id'] ?>" class="blog-box blog-box-1">
                <img src="<?= Yii::$app->params['upload_directories']['blogs']['image'] . $data[0]['_uid'] . '/' . $data[0]['image']; ?>">
                <div class="blog-det">
                    <!-- <span class="cat-tag">Body Building</span> -->
                    <h1><?= $data[0]['name'] ?></h1>
                    <span class="blog-date"><i class="far fa-clock"></i><?= date('d M, Y', strtotime($data[0]['created_at'])) ?></span>
                    <p class="blog-desc"><?= $data[0]['short_description'] ?></p>
                </div>
            </a>
            <a href="/blog/<?= $data[1]['_id'] ?>" class="blog-box blog-box-2">
                <img src="<?= Yii::$app->params['upload_directories']['blogs']['image'] . $data[1]['_uid'] . '/' . $data[1]['image']; ?>">
                <div class="blog-det">
                    <!-- <span class="cat-tag">Body Building</span> -->
                    <h1><?= $data[1]['name'] ?></h1>
                    <span class="blog-date"><i class="far fa-clock"></i><?= date('d M, Y', strtotime($data[1]['created_at'])) ?></span>
                </div>
            </a>
            <a href="/blog/<?= $data[2]['_id'] ?>" class="blog-box blog-box-3">
                <img src="<?= Yii::$app->params['upload_directories']['blogs']['image'] . $data[2]['_uid'] . '/' . $data[2]['image']; ?>">
                <div class="blog-det">
                    <!-- <span class="cat-tag">Body Building</span> -->
                    <h1><?= $data[2]['name'] ?></h1>
                    <span class="blog-date"><i class="far fa-clock"></i><?= date('d M, Y', strtotime($data[2]['created_at'])) ?></span>
                </div>
            </a>
        </div>

        <div class="blogs-wrapper">
            <div class="row">
                <div class="col-md-8">
                    <!-- <h2 class="recent heading">Recent Posts</h2> -->
                    <?php if($data){ ?>
                    <div class="blog-list">
                        <?php foreach ($data as $blog) {
                            $image_path = Yii::$app->params['upload_directories']['blogs']['image'] . $blog['_uid'] . '/' . $blog['image'];
                        ?>
                            <div class="blog post">
                                <div class="post-main-header">
                                    <div class="post-info">
                                        <h2 class="post-title">
                                            <a href="/blog/<?= $blog['_id'] ?>"><?= $blog['name'] ?></a>
                                        </h2>
                                        <div class="post-meta">
                                            <!-- <a class="post-tag" href="#">Coding</a> -->
                                            <!-- <span class="blog-date"><i class="far fa-user"></i>Name Surname</span> -->
                                            <span class="blog-date"><i class="far fa-clock"></i><?= date('d M, Y', strtotime($blog['created_at'])) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-info-bottom">
                                    <div class="post-image-wrap">
                                        <a class="post-image-link" href="/blog/<?= $blog['_id'] ?>">
                                            <img alt="" class="post-thumb lazy-yard" src="<?= $image_path ?>">
                                        </a>
                                    </div>
                                    <div class="index-post-footer">
                                        <p class="post-snippet"><?= $blog['short_description'] ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="blog-subscribe-box">
                        <h1>
                            Subscribe To The BodyBay Blog
                        </h1>
                        <p>
                            Get your daily updates on fitness, bodybuilding, weight management, nutrition & much more.
                        </p>
                        <form action="" class="subcribe-form">
                            <input type="email" placeholder="Enter Your Email">
                            <button type="submit" class="subscribe-btn">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php
$this->registerCSS('
section.blog {
    padding-top: 25px;
    margin-bottom: 50px;
}
.blogs-wrapper {
    margin-top: 40px;
}


/*=======SOCIAL BAR ICONS Starts Here=======*/
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

/*=======SOCIAL BAR ICONS Starts Here=======*/ 

/*===========Blog Head Starts Here=============*/
    .blog-head{
        position: relative;
        width: 100%;
        height: 410px;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        grid-gap: 5px;
    }
    .blog-box-1 {
        height: 100% !important;
        grid-row: 1/3;
    }
    .blog-box {
        position: relative;
        width: 100%;
        height: 202.75px;
        display: flex;
        flex-direction: column;
        margin: 0;
        overflow: hidden;
    }
    .blog-box img{
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
    .blog-det {
        position: absolute;
        bottom: 0;
        width: 100%;
        padding: 5px 10px;
        background-image: linear-gradient(to bottom,transparent,rgba(0,0,0,0.8));
        color: #fff;
    }
    span.cat-tag {
        background: #57bce2;
        padding: 3px 6px;
        font-size: 13px;
        font-weight: 600;
        color: #fff;
        border-radius: 4px;
    }
    .blog-det h1 {
        font-size: 18px;
        font-weight: 700;
        margin: 5px 0;
    }
    span.blog-date i {
        margin-right: 5px;
        font-size: 14px;
    }   
    span.blog-date {
        font-size: 14px;
        font-weight: 600;
    }
    .blog-desc {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        margin-bottom: 0;
        color: #fff;
    }
/*===========Blog Head Ends Here=============*/

/*==============Blog List Starts Here===============*/
    h2.recent.heading {
        font-size: 22px;
        font-weight: 700;
        color: #666;
        margin-bottom: 15px;
    }
    .post {
        margin-bottom: 30px;
        background: #fff;
        box-shadow: 0 0 3px 0 #aaa;
        padding: 15px;
    }
    .post-title a {
        font-size: 24px;
        font-weight: 700;
    }
    .post-meta{
        font-size: 13px;
        margin: 5px 0;
        color: #666;
        font-weight: 400;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
    }
    .post-meta > *{
        margin-right: 10px;
    }
    .post-meta span{
        font-weight: 400;
    }
    .post-meta .post-tag {
        background: #57bce2;
        padding: 1px 7px;
        display: inline-block;
        font-size: 13px;
        color: #fff;
        border-radius: 3px;
    }
    .post-info-bottom{
        display: flex;
        margin-top: 20px;
    }
    .post-info-bottom .post-image-wrap{
        max-width: 150px;
        min-width: 150px;
        margin-right: 10px;
    }
    .index-post-footer .post-snippet{
        display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;  
            overflow: hidden;
    }
/*==============Blog List Ends Here===============*/


/*==============Rigth Side Bar Starts Here===============*/
    .blog-subscribe-box {
        background: #f5f5f5;
        padding: 35px 25px;
    }
    .blog-subscribe-box h1 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
    }
    .blog-subscribe-box p {
        font-size: 15px;
        line-height: 1.4;
        color: #666;
    }
    .blog-subscribe-box input{
        margin-bottom: 5px;
    }
    button.subscribe-btn {
        width: 100%;
        border: none;
        outline: none;
        background: #57bce2;
        color: #fff;
        padding: 5px 0;
    }
    

/*==============Rigth Side Bar Ends Here===============*/


/*========SCREEN BETWEEN 768PX AND 991PX===========*/
@media (min-screen: 768px) and (max-width: 991px){
    .blog-box{
        height: 140px;
    }
    .blog-head{
        height: 286px;
    }
}

/*========SCREEN LESS THAN 991PX===========*/
@media only screen and (max-width: 991px){
    .blog-subscribe-box h1 {
        font-size: 20px;
    }
    .blog-subscribe-box p {
        font-size: 13px;
        line-height: 1.4;
        color: #666;
    }
    .post-title a {
        font-size: 20px;
        font-weight: 700;
    }
}

/*========SCREEN LESS THAN 767PX===========*/
@media only screen and (max-width: 767px){
    .blog-box-1 {
        height: 100% !important;
        grid-row: auto;
        grid-column: 1/3;
    }
    .blog-head{
    grid-template-columns: 1fr 1fr;
    }
}

/*========SCREEN LESS THAN 575PX===========*/
@media only screen and (max-width: 575px){
    .blog-head{
        display: block;
        height: auto;
    }
    .blog-head .blog-box{
        height: 200px !important;
        margin-bottom: 10px;
    }
}


/*OLD BLOG CSS*/
/*
    section.blog {
        margin-bottom: -50px;
        padding-top: 60px;
        // background: #eee;
    }
    .blog-post {
        // margin-bottom: 30px;
        background: #fff;
        min-height: 450px;
    }
    .blog_img {
        height: 230px;
        object-fit: cover;
    }
    .blog-post img{
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 0 4px 1px #ccc;
    }
    .blog-info p {
        font-size: 13px;
        line-height: 1.3;
        height: 52px;
        color: #666;
        font-weight: 500;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;  
        overflow: hidden;
        margin-bottom: 10px;
    }
    .blog-info h4 a, .blog-info h4 {
        font-size: 19px;
        text-transform: initial;
        line-height: 1;
        display: block;
        margin-bottom: 4px;
        font-weight: 700;
        color: #333;
    }
    .blog-info {
        // padding: 0 15px;
    }
    .blog-post ul li {
        display: inline-block;
        font-weight: 600;
        background: #b5e7ff;
        padding: 2px 10px;
        font-size: 14px;
        border-radius: 6px;
        color: #333;
    }
    .blog-info .far.fa-clock {
        margin-right: 5px;
        font-size: 14px;
    }
    .blog-post .post-button {
        display: inline-block;
        color: #ffffff;
        padding: 4px 10px;
        background: #007bff;
        font-size: 12px;
        border-radius: 3px;
    }
    .blog-info p {
        font-size: 14px;
        line-height: 18px;
        height: 54px;
        overflow: hidden;
    }
    .p10{
    padding:10px;
    }
*/
');
$script = <<<JS
$(document).on('click','#blog_search',function(e) {
  e.preventDefault();
  var value = $('#blog_keyword').val();
  url = "$pageLink?keyword=" + value;
window.location.replace(url);
});
JS;
$this->registerJS($script);
