<?php

/* @var $this \yii\web\View */

/* @var $content string */

use common\models\Categories;
use common\models\Blogs;
use frontend\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Pjax;

AppAsset::register($this);
$session = Yii::$app->session;
$temp = [];
$pageLink = Url::to('/site/shop');
$pageLink1 = Url::to('/');
$services = Yii::$app->functions->getServices(1);
if (!isset($session['serviceMenuList']) || count($session['serviceMenuList']) != count($services)) {
  if ($services && count($services) > 0) {
    foreach ($services as $s) {
      $temp[$s['id']] = $s['name'];
    }
  }
  $session['serviceMenuList'] = $temp;
  unset($temp);
}
$internalPrice = Yii::$app->functions->getCountryWisePrice();
$blogs = Blogs::find()->alias('z')
  ->select(['z._id', 'z._uid', 'z.created_at', 'z.name', 'z.short_description', 'z.image'])
  ->where(['z.is_deleted' => 0])
  ->limit(5)
  ->orderBy(['z.created_at' => SORT_DESC])
  ->asArray()
  ->all();
$categories = Categories::find()
  ->select(['name', '_id'])
  ->where(['not', ['status' => 3]])
  ->andWhere(['_parent_id' => null])
  ->orderBy(['name' => SORT_ASC])
  ->asArray()
  ->all();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php $this->registerCsrfMetaTags() ?>
  <title><?= Html::encode($this->title) ?></title>
  <?php
  if (isset($this->params['description']) && !empty($this->params['description'])) {
  ?>
    <meta name="keywords" content="<?= $this->params['keywords'] ?>" />
    <meta name="description" content="<?= $this->params['description'] ?>">
  <?php
  }
  if (isset($this->params['seo_tags']) && !empty($this->params['seo_tags'])) {
    foreach ($this->params['seo_tags']['rel'] as $key => $value) {
      $this->registerLinkTag([
        'rel' => $key,
        'href' => Url::to($value, 'https'),
      ]);
    }
    foreach ($this->params['seo_tags']['property'] as $key => $value) {
      $this->registerMetaTag([
        'property' => $key,
        'content' => $value,
      ]);
    }
  }
  ?>
  <link rel="icon" href="/images/icons/favicon.png">
  <?php $this->head() ?>
</head>

<body>
  <?php $this->beginBody() ?>
  <div class="stars"></div>
  <!--<div class="twinkling"></div>-->
  <!-- preloader Start-->
  <!--<div id="preloader">-->
  <!--    <div id="status"><img src="/images/header/horoscope.gif" id="preloader_image" alt="loader">-->
  <!--    </div>-->
  <!--</div>-->
  <!-- main_header_wrapper Start -->

  <div class="responsive-header-main">
    <!--    <div class="responsive-menubar-theme">-->
    <!--        <div class="responsive-logo-theme">-->
    <!--            <a href="index.html" title=""><img src="http://placehold.it/178x40" alt="" /></a>-->
    <!--        </div>-->
    <!--        <div class="menu-theme-action">-->
    <!--            <div class="menu-theme-openmenu">-->
    <!--                <img src="./icon.png" alt="" /> Menu-->
    <!--            </div>-->
    <!--            <div class="menu-theme-closemenu">-->
    <!--                <img src="./icon2.png" alt="" /> Close-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <div class="responsive-theme-opened">
      <div class="btn-extars">
        <ul class="account-btns">
          <?php if (Yii::$app->user->isGuest) : ?>
            <li class="signup-popup">
              <a href="/site/login"><i class="fa fa-link"></i> Login</a>
            </li>
            <li class="signin-popup">
              <a href="/site/signup"><i class="fa fa-key"></i> Register</a>
            </li>
          <?php else : ?>
            <li class="signin-popup">
              <?php
              echo Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                  'Log Out',
                  ['class' => 'btn btn-link logout font-14']
                )
                . Html::endForm(); ?>
            </li>
          <?php endif; ?>
        </ul>
      </div>
      <!-- Btn Extras -->
      <div class="responsive-theme-menu-main">
        <ul>
          <li>
            <a href="/" title="">Home</a>
          </li>
          <?php
          if ($categories) {
            foreach ($categories as $category) {
              $subCategory = Categories::find()
                ->select(['name', '_id'])
                ->where(['not', ['status' => 3]])
                ->andWhere(['_parent_id' => $category['_id']])
                ->orderBy(['name' => SORT_ASC])
                ->asArray()
                ->all();
              if (!empty($subCategory)) {
          ?>
                <li class="menu-item-has-children">
                  <a href="/shop" title=""><?= $category['name'] ?></a>
                  <ul>
                    <?php
                    foreach ($subCategory as $subCat) {
                    ?>
                      <li><a href="/shop?cat=<?= $subCat['name'] ?>"><?= $subCat['name'] ?></a></li>
                    <?php
                    }
                    ?>
                  </ul>
                </li>
          <?php
              }
            }
          }
          ?>
          <li><a href="/recently-added">Top 10</a></li>
          <li><a href="/blogs">Blog</a></li>
        </ul>
      </div>
    </div>
  </div>
  <header>
    <div class="header-container">
      <!-- logo -->
      <strong class="logo d-flex align-items-center">
        <div class="menubar-toggle-main">
          <div class="menu-theme-action">
            <div class="menu-theme-openmenu">
              <i class="fas fa-bars"></i>
            </div>
            <div class="menu-theme-closemenu">
              <i class="fas fa-times"></i>
            </div>
          </div>
        </div>
        <a href="/" class="logo-img"><img src="/images/logo-white.png" alt="logo"></a>
      </strong>
      <!--        <div class="d-flex">-->
      <!-- open nav mobile -->
      <label class="open-search" for="open-search">
        <i class="fa fa-search"></i>
        <input class="input-open-search" id="open-search" type="checkbox" name="menu" />
        <form class="search" data-link="<?= $pageLink ?>" data-link1="<?= $pageLink1 ?>">
          <button class="button-search" id="button-search"><i class="fa fa-search"></i></button>
          <input type="text" placeholder="What are you looking for?" id="input-search" class="input-search" />
        </form>
      </label>
      <!-- // search -->
      <nav class="mutant-nav-content">
        <!-- nav -->
        <ul class="mutant-nav-content-list">
          <?php if (Yii::$app->user->isGuest) : ?>
            <li class="mutant-nav-content-item account-login desktop-icon">
              <a href="/site/login">Login</a>
            </li>
            <li class="mutant-nav-content-item desktop-icon">
              /
            </li>
            <li class="mutant-nav-content-item account-login desktop-icon">
              <a href="/site/signup">Register</a>
            </li>
          <?php else : ?>
            <li class="mutant-nav-content-item account-login desktop-icon">
              <?php
              echo Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                  'Log Out',
                  ['class' => 'btn btn-link logout font-14']
                )
                . Html::endForm(); ?>
            </li>
          <?php endif; ?>
          <li class="mutant-nav-content-item"><a class="mutant-nav-content-link cart-icon" href="<?= Url::to('/cart') ?>">
              <?php
              $session = Yii::$app->session;
              if (isset($session['cart_data']) && count($session['cart_data']) > 0) {
              ?>
                <span class="number-dot"><?= count($session['cart_data']) ?></span>
              <?php
              }
              ?>
              <i class="fas fa-shopping-cart"></i></a></li>
          <!-- call to action -->
        </ul>
      </nav>
      <!--        </div>-->
    </div>
    <!-- nav navigation commerce -->
    <div class="nav-header-container">
      <nav class="featured-category">
        <ul class="nav-row">
          <?php
          if ($categories) {
            foreach ($categories as $category) {
              $subCategory = Categories::find()
                ->select(['name', '_id'])
                ->where(['not', ['status' => 3]])
                ->andWhere(['_parent_id' => $category['_id']])
                ->orderBy(['name' => SORT_ASC])
                ->asArray()
                ->all();
              if (!empty($subCategory)) {
          ?>
                <li class="nav-row-list menu-item-has-children"><a href="/shop" class="nav-row-list-link"><?= $category['name'] ?></a>
                  <ul>
                    <?php
                    foreach ($subCategory as $subCat) { ?>
                      <li><a href="/shop?cat=<?= $subCat['name'] ?>"><?= $subCat['name'] ?></a></li>
                    <?php } ?>
                  </ul>
                </li>
          <?php
              }
            }
          }
          ?>
          <li class="nav-row-list"><a href="/recently-added" class="nav-row-list-link">Top 10</a></li>
          <li class="nav-row-list"><a href="/blogs" class="nav-row-list-link">Blog</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <?= $content ?>
  <!-- hs footer wrapper Start -->
  <footer>
    <div class="footer-top section-padding">
      <div class="footer-logo">
        <img src="/images/logo-inline-white.png">
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="widget-title">
              <h5>LATEST POSTS</h5>
            </div>
            <ul class="recent-post">
              <?php
              if ($blogs) {
                foreach ($blogs as $blog) {
              ?>
                  <li>
                    <div class="image postImage"><img src="<?= Yii::$app->params['upload_directories']['blogs']['image'] . $blog['_uid'] . '/' . $blog['image'] ?>" alt="post image"></div>
                    <div class="content">
                      <a href="/site/blog-detail?id=<?= $blog['_id'] ?>"><?= $blog['name'] ?></a>
                    </div>
                  </li>
              <?php
                }
              }
              ?>
            </ul>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="widget-title">
              <h5><?= Yii::$app->params['site_name'] ?></h5>
            </div>
            <ul class="tags">
              <li><a href="/shop">Shop</a></li>
              <li><a href="/contact">Contact Us</a></li>
              <li><a href="/about">About</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>
              <li><a href="/return-policy">Return Policy</a></li>
              <li><a href="/terms-of-use">Terms Of Use</a></li>
              <li><a href="/faq">FAQ</a></li>
            </ul>
          </div>
          <div class="col-lg-5 col-md-6">
            <div class="widget-title">
              <h5>About US</h5>
            </div>
            <p class="text-white">
              Best 𝐎𝐧𝐥𝐢𝐧𝐞 𝐇𝐞𝐚𝐥𝐭𝐡 𝐒𝐮𝐩𝐩𝐥𝐞𝐦𝐞𝐧𝐭𝐬 Store across PAN India with 100% Authentic
              Products
              The BodyBay is among the best and fast growing online platforms that are providing unfeigned,
              authentic
              and 𝐩𝐫𝐞𝐦𝐢𝐮𝐦 𝐫𝐚𝐧𝐠𝐞 𝐡𝐞𝐚𝐥𝐭𝐡 𝐬𝐮𝐩𝐩𝐥𝐞𝐦𝐞𝐧𝐭 𝐚𝐧𝐝 𝐰𝐞𝐥𝐥𝐧𝐞𝐬𝐬 𝐩𝐫𝐨𝐝𝐮𝐜𝐭𝐬
              𝐚𝐥𝐥 𝐨𝐯𝐞𝐫 𝐈𝐧𝐝𝐢𝐚 .
            </p>
            <div class="newsletter" style="
                                margin-top: 20px;
                            ">
              <div class="widget-title">
                <h5>Subscribe to our newsletter</h5>
              </div>
              <p class="subscribe-text">Be the first one to receive amazing offers , deals and news</p>
              <form>
                <input name="email" id="email_footer" type="email" placeholder="Email Address...">
                <button id="subscribe_email_footer">subscribe</button>
              </form>
            </div>
            <div class="widget-title">
              <h5>FOLLOW US</h5>
            </div>
            <div class="ushare">
              <a href="https://www.facebook.com/The-Bodybay-544022222791308"><img src="/images/icons/fb1.png" height="30px" width="30px"></a>
              <a href="#"><img src="/images/icons/linkedin.png" height="30px" width="30px"></a>
              <a href="https://www.instagram.com/thebodybay/"><img src="/images/icons/insta.png" height="30px" width="30px"></a>
              <a href="https://in.pinterest.com/TheBodyBay/_created/"><img src="/images/icons/pinterest.png" height="30px" width="30px"></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <p>© 2022 <?= Yii::$app->params['site_name'] ?>. All Rights Reserved</p>
      </div>
    </div>
  </footer>

  <?php
  $this->registerCSS('
@import url("https://fonts.googleapis.com/css2?family=Supermercado+One&display=swap");
* {
  box-sizing: border-box;
}
header a{
  color: #fff;
}
.logo{
    font-family: "Supermercado One", cursive;
}
a.logo-img{
  width: 205px;
}
body {
  padding: 0;
  margin: 0;
  font-family: "Rubik", sans-serif;
}

strong {
  padding: 0;
  margin: 0;
}

label, a {
  text-decoration: none;
  color: #000;
}

ul {
  list-style: none;
  padding: 0;
}

header {
  background: #000;
  box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.3);
  position: sticky;
  top: 0;
  width: 100%;
  height:120px;
  min-height:70px;
  z-index: 99;
}

.header-content-top {
  background: #545bc4;
  height: 30px;
  width: 100%;
}
.header-content-top .content {
  align-items: center;
  display: flex;
  height: 30px;
  justify-content: flex-end;
  margin: 0 auto;
  max-width: 1300px;
  width: 100%;
}
.header-content-top .content span {
  color: #fff;
  font-size: 12px;
  margin: 0 15px;
}
.header-content-top .content span .fas {
  margin-right: 5px;
}

.header-container {
  align-items: center;
  display: flex;
  height: 80px;
  justify-content: space-between;
//  margin: 0 20px;
//  max-width: 1300px;
  padding: 0 15px;
  position: relative;
  width: 100%;
}
.header-container .logo {
  color: #545bc4;
  font-size: 40px;
  line-height: 20px;
  padding-right: 15px;
  padding-bottom: 10px;
}
.header-container .logo img{
  max-height: 60px;
}
.header-container .open-search {
  border-radius: 3px;
  flex: auto;
  margin: 0 15px;
  overflow: hidden;
  position: relative;
  max-width:700px;
}
@media (max-width: 991px) {
  .header-container .open-search {
    margin: 0;
    position: static;
    text-align: right;
    margin-top: 11px;
  }
  header {
    height: 70px;
  }
}
.header-container .open-search .fa-search {
  display: none;
}
@media (max-width: 991px) {
  .header-container .open-search .fa-search {
    display: block;
  }
}
@media (max-width: 500px) {
.logo a{
    font-size: 25px;
}
.header-container .logo-img img{
  max-height: 45px;
}
}
.header-container .open-search .input-open-search {
  display: none;
}
.header-container .open-search .input-open-search:checked ~ .search {
  display: block;
}
@media (min-width: 991px) {
    .menubar-toggle-main{
        display: none;
    }
}
@media (max-width: 991px) {
  .header-container .search {
    display: none;
    position: absolute;
    left: 2%;
    top: 60px;
    width: 96%;
    z-index: 999;
  }
}
.header-container .search .input-search {
  border-radius: 3px;
  margin:0;
  font-size:14px;
  border: 1px solid #e1e1e1;
  height: 40px;
  padding: 0 70px 0 15px;
  width: 100%;
  background: white no-repeat;
  transition: 100ms all linear 0s;
  border-radius: 25px;
  background-size: 0 2px, 100% 1px;
  background-position: 50% 100%, 50% 100%;
  transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
}
.header-container .search .input-search:focus {
  background-size: 100% 2px, 100% 1px;
  outline: none;
}
.header-container .search .button-search {
  background: #545bc4;
  border: 0;
  color: #fff;
  cursor: pointer;
  padding: 13px 20px;
  position: absolute;
  right: 0px;
  top: 0px;
  border-radius: 0px 25px 25px 0px;
}
.header-container .search .button-search .fa-search {
  display: block;
}
.header-container .mutant-nav-content .mutant-nav-content-list {
  align-items: center;
  display: flex;
  justify-content: space-between;
  padding: 0 15px;
  margin:0px;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item {
  align-items: center;
  display: flex;
  height: 40px;
  margin: 0px;
  position: relative;
  transition: 100ms all linear 0s;
}
@media (max-width: 991px) {
  .header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item {
    padding: 0 5px;
  }
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .item-arrow {
  margin-left: 5px;
  position: relative;
  top: -3px;
}
@media (max-width: 768px) {
  .header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .item-arrow {
    display: none;
  }
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .open-menu-login-account {
  align-items: center;
  cursor: pointer;
  display: flex;
  position: relative;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .input-menu {
  display: none;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .input-menu:checked ~ .login-list {
  display: block;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .login-list {
  background: #fff;
  border-bottom: 3px solid #545bc4;
  border-radius: 3px;
  box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.3);
  display: none;
  overflow: hidden;
  position: absolute;
  right: 0;
  top: 28px;
  transition: 100ms all linear 0s;
  width: 200px;
  z-index: 10;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .login-list .login-list-item {
  padding: 15px 20px;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .login-list .login-list-item:hover {
  background: #545bc4;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item .login-list .login-list-item:hover a {
  color: #fff;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item:nth-child(2):hover .fas {
  color: #e74c3c;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-item:hover .fas {
  color: #545bc4;
}
.header-container .mutant-nav-content .mutant-nav-content-list .account-login .login-text {
  align-items: end;
  display: flex;
  flex-direction: column;
  font-size: 12px;
  margin-left: 5px;
}
@media (max-width: 991px) {
  .header-container .mutant-nav-content .mutant-nav-content-list .account-login .login-text {
    display: none;
  }
  .desktop-icon {
    display: none !important;
  }
}
.header-container .mutant-nav-content .mutant-nav-content-list .account-login .login-text strong {
  display: block;
}
.header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-link {
  border-radius: 3px;
  font-size: 19px;
  padding: 10px 15px;
  transition: 100ms all linear 0s;
}
@media (max-width: 991px) {
  .header-container .mutant-nav-content .mutant-nav-content-list .mutant-nav-content-link {
    padding: 0;
  }
}

.nav-header-container {
  align-items: center;
  display: flex;
 margin: 0 auto;
  max-width: 1300px;
  width: 100%;
}
.nav-header-container .nav-row {
  align-items: center;
  display: flex;
  height: 40px;
  justify-content: space-between;
  margin: 0;
  padding: 0;
//   overflow-x: scroll;
  width: 100%;
  position:relative;
}
@media (max-width: 991px) {
  .nav-header-container .nav-row {
    display: none;
  }
}
.nav-header-container .nav-row .nav-row-list {
  flex: auto;
  min-width: 160px;
  max-width: 250px;
}
.nav-header-container .nav-row .nav-row-list .nav-row-list-link {
  align-items: center;
  display: flex;
  height: 40px;
  justify-content: center;
  transition: 100ms all linear 0s;
  text-decoration: none;
}
.nav-header-container .nav-row .nav-row-list .nav-row-list-link:hover {
  background: #e1e1e1;
  width: 100%;
}
.nav-header-container .featured-category {
  flex: auto;
  margin: 0 15px 0 0;
  width:100%;
}
@media (max-width: 991px) {
  .nav-header-container .featured-category {
    display: none;
  }
}
.nav-header-container .all-navigator {
  align-items: center;
  background: #545bc4;
  color: #fff;
  display: flex;
  height: 40px;
  padding: 0 25px;
  width: 100%;
}
@media (max-width: 991px) {
  .nav-header-container .all-navigator {
    margin-right: 0;
  }
}
.nav-header-container .all-navigator .fa-angle-up,
.nav-header-container .all-navigator .fa-angle-down {
  position: absolute;
  right: 25px;
}
.nav-header-container .all-navigator .fa-angle-up {
  display: none;
}
.nav-header-container .all-navigator .fas {
  font-size: 16px;
  margin-right: 0;
}
.nav-header-container .all-navigator span {
  margin-left: 15px;
}
.nav-header-container .all-category-nav {
  cursor: pointer;
  max-width: 300px;
  position: relative;
  width: 100%;
}
@media (max-width: 991px) {
  .nav-header-container .all-category-nav {
    max-width: 100%;
  }
}
.nav-header-container .all-category-nav .open-menu-all {
  align-items: center;
  cursor: pointer;
  display: flex;
  position: relative;
}
.nav-header-container .all-category-nav .input-menu-all {
  display: none;
}
.nav-header-container .all-category-nav .input-menu-all:checked ~ .all-category-list {
  display: block;
}
.nav-header-container .all-category-nav .input-menu-all:checked + .all-navigator .fa-angle-down {
  display: none;
}
.nav-header-container .all-category-nav .input-menu-all:checked + .all-navigator .fa-angle-up {
  display: block;
}
.nav-header-container .all-category-list {
  background: #fff;
  border-bottom: 3px solid #545bc4;
  box-shadow: 2px 9px 49px -17px rgba(0, 0, 0, 0.3);
  display: none;
  height: auto;
  min-height: 300px;
  padding: 15px 0;
  position: absolute;
  top: 24px;
  width: 300px;
  z-index: 90;
}
@media (max-width: 991px) {
  .nav-header-container .all-category-list {
    min-width: 100%;
  }
}
.nav-header-container .all-category-list-item:hover {
  display: block;
  background: #545bc4;
}
.nav-header-container .all-category-list-item:hover .category-second-list {
  left: 100%;
  opacity: 1;
  visibility: visible;
}
.nav-header-container .all-category-list-item:hover .all-category-list-link {
  color: #fff;
}
.nav-header-container .all-category-list-link {
  align-items: center;
  display: flex;
  justify-content: space-between;
  padding: 15px;
  transition: 100ms all linear 0s;
}
.nav-header-container .category-second-list {
  background: #fff;
  border-bottom: 3px solid #545bc4;
  box-shadow: inset 44px -1px 88px -59px rgba(0, 0, 0, 0.37);
  display: flex;
  height: 322px;
  left: 80%;
  min-height: 297px;
  min-width: 400px;
  opacity: 0;
  position: absolute;
  top: 0;
  transition: 100ms all linear 0s;
  visibility: hidden;
  width: auto;
}
@media (max-width: 991px) {
  .nav-header-container .category-second-list {
    display: none;
  }
}
.nav-header-container .category-second-list .img-product-menu img {
  max-width: 180px;
}
.nav-header-container .category-second-list-ul {
  display: flex;
  flex-direction: column;
  min-width: 400px;
  padding: 0 15px;
}
.nav-header-container .category-second-item a {
  align-items: center;
  display: flex;
  justify-content: space-between;
  padding: 15px;
}
.nav-header-container .category-second-item:hover {
  background: #545bc4;
}
.nav-header-container .category-second-item:hover a {
  color: #fff;
}

.fa-bars {
  font-size: 28px;
}
.privacyPage{
margin: 20px;
}
.privacyPage a{
color: white;
}
.privacyPage a:hover{
color: blue;
}
.phone-cart{
height: 40px;
    width: 40px;
    display: block;
    float: right;
    margin: 27px 0;
    cursor: pointer;
    font-size: 30px;
    color: #57bce2;
}
.ushare a {
//    color: #fff;
    padding: 5px 8px;
    font-size: 25px;
}
.postImage
{
    height: 60px;
    width: 95px;
}
.contactTel{
cursor:pointer;
}
#add_to_cart_pjax{
     float:right;
}
.logoutIcon{
font-size: 30px;
    color: gray;
}
header .main-menu .menu-register .logout.btn-link {
    display: inline-block;
    float: left;
    padding: 12px 25px;
    color: #fff;
    background-color: #57bce2;
}
.logout.btn-link:hover{
    text-decoration: none;
}
.number-dot {
    position: absolute;
    width: 16px;
    height: 16px;
    background: #57bce2;
    top: 0px;
    border-radius: 50%;
    right: 0px;
    font-size: 11px;
    text-align: center;
    color: #fff;
    line-height: 16px;
}
.cart-icon{
    position: relative;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul {
    opacity: 0;
    visibility: hidden;
    margin: 0;
    position: absolute;
    top: 100%;
    width: 240px;
    padding-top: 0;
    -webkit-box-shadow: 0px 0px 30px rgb(0 0 0 / 10%);
    -moz-box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
    -ms-box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
    -o-box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 30px rgb(0 0 0 / 10%);
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
    -ms-border-radius: 8px;
    -o-border-radius: 8px;
    border-radius: 8px;
}
.nav-header-container nav.featured-category>ul.nav-row > li:hover>ul {
    opacity: 1;
    visibility: visible;
}
.nav-header-container nav.featured-category>ul.nav-row > li.menu-item-has-children>a::before {
    position: absolute;
    right: 0px;
    width: 10px;
    height: 10px;
    content: "\f0d7";
    font-size: 9px;
    top: 41%;
    margin-top: -4px;
    font: normal normal normal 14px/1 FontAwesome;
}
.nav-header-container nav.featured-category>ul.nav-row > li ul li.menu-item-has-children>ul {
    position: absolute;
    left: 100%;
    width: 250px;
    padding-left: 11px;
    opacity: 0;
    visibility: hidden;
}

.nav-header-container nav.featured-category>ul.nav-row > li ul li.menu-item-has-children>ul::before {
    position: absolute;
    left: 7px;
    top: 13px;
    width: 13px;
    height: 13px;
    background: #fafafa;
    content: "";
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.nav-header-container .nav-row .nav-row-list{
    position:relative;
}
.nav-header-container nav.featured-category>ul.nav-row > li ul li.menu-item-has-children:hover>ul {
    opacity: 1;
    visibility: visible;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul::before {
    position: absolute;
    left: 56%;
    top: -4px;
    width: 20px;
    height: 20px;
    background: #ffffff;
    content: "";
    -webkit-transform: rotate(
-45deg
);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(
-45deg
);
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    -ms-border-radius: 3px;
    -o-border-radius: 3px;
    border-radius: 3px;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li {
    background: #ffffff;
    margin: 0;
    position: relative;
    display: flex;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li a {
    font-size: 13px;
    color: #202020;
    padding: 9px 25px;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li a{
    width: 100%;
    float: left;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li:first-child>a {
    margin-top: 14px;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li:first-child {
    -webkit-border-radius: 6px 6px 0px 0px;
    -moz-border-radius: 6px 6px 0px 0px;
    -ms-border-radius: 6px 6px 0px 0px;
    -o-border-radius: 6px 6px 0px 0px;
    border-radius: 6px 6px 0px 0px;
}
header *:not(i) {
    -webkit-transition: all 0.4s ease 0s;
    -moz-transition: all 0.4s ease 0s;
    -ms-transition: all 0.4s ease 0s;
    -o-transition: all 0.4s ease 0s;
    transition: all 0.4s ease 0s;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li:hover>a {
    padding-left: 35px;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li:last-child {
    -webkit-border-radius: 0px 0px 6px 6px;
    -moz-border-radius: 0px 0px 6px 6px;
    -ms-border-radius: 0px 0px 6px 6px;
    -o-border-radius: 0px 0px 6px 6px;
    border-radius: 0px 0px 6px 6px;
}
.nav-header-container nav.featured-category>ul.nav-row > li>ul li:last-child>a {
    margin-bottom: 14px;
}
a:hover{
    text-decoration:none;
}
.menu-sec-theme, .menu-sec-theme nav>ul>li>ul li, .menu-sec-theme nav>ul>li>ul li a, .responsive-header-main, .responsive-menubar-theme, .responsive-theme-menu-main, .responsive-theme-opened .btn-extars, .responsive-theme-menu-main>ul, .responsive-theme-menu-main>ul>li, .responsive-theme-menu-main>ul>li>a, .responsive-theme-menu-main>ul>li ul, .responsive-theme-menu-main>ul>li ul>li, .responsive-theme-menu-main>ul>li ul>li a {
    width: 100%;
    float: left;
}
.menu-sec-theme nav>ul>li ul li.menu-item-has-children>ul {
            position: absolute;
            left: 100%;
            width: 250px;
            padding-left: 11px;
            opacity: 0;
            visibility: hidden;
        }
        
        .menu-sec-theme nav>ul>li ul li.menu-item-has-children>ul::before {
            position: absolute;
            left: 7px;
            top: 13px;
            width: 13px;
            height: 13px;
            background: #fafafa;
            content: "";
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            -ms-border-radius: 3px;
            -o-border-radius: 3px;
            border-radius: 3px;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
        }
        
        .menu-sec-theme nav>ul>li ul li.menu-item-has-children:hover>ul {
            opacity: 1;
            visibility: visible;
        }
        
        .bottom-line .scrollup {
            position: absolute;
            right: 70px;
            bottom: 44px;
            width: 50px;
            height: 50px;
            border: 2px solid #8a99b3;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            -ms-border-radius: 50%;
            -o-border-radius: 50%;
            border-radius: 50%;
            -webkit-transition: all 0.4s ease 0s;
            -moz-transition: all 0.4s ease 0s;
            -ms-transition: all 0.4s ease 0s;
            -o-transition: all 0.4s ease 0s;
            transition: all 0.4s ease 0s;
            line-height: 46px;
            color: #8a99b3;
            font-size: 23px;
        }
        
        .responsive-header-main {
            position: relative;
            background: #222;
            padding: 0 25px;
            z-index: 99;
            display: none;
        }
        
        .responsive-menubar-theme {
            padding: 30px 0;
        }
        
        .menu-theme-action {
            float: right;
            position: relative;
        }
        
        .responsive-theme-menu-main {
            margin-top: 0px;
            margin-bottom: 10px;
        }
        .account-btns {
            margin: 0;
            padding: 8px 0;
            display: flex;
            justify-content: space-around;
        }
.account-btns>li {
    margin: 0;
}
.account-btns>li a {
    font-size: 15px;
    color: #ffffff;
    line-height: 22px;
}        
        .menu-theme-openmenu {
            float: left;
            color: #fff;
            font-size: 15px;
            -webkit-border-radius: 26px;
            -moz-border-radius: 26px;
            -ms-border-radius: 26px;
            -o-border-radius: 26px;
            border-radius: 26px;
            cursor: pointer;
        }
        
        .menu-theme-openmenu img {
            float: left;
            margin-right: 11px;
        }
        .btn-extars {
            float: right;
        }
        .menubar-toggle-main{
            padding-right:10px;
        }
        .menu-theme-closemenu {
            position: absolute;
            right: 0;
            top: 2px;
            color: #fff;
            font-size: 26px;
            -webkit-border-radius: 26px;
            -moz-border-radius: 26px;
            -ms-border-radius: 26px;
            -o-border-radius: 26px;
            border-radius: 26px;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
        }
        
        .responsive-theme-opened {
            width: 80%;
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            background: #222;
            padding: 0 10px;
            overflow-y: scroll;
            height: 100vh;
            padding-top: 90px;
            margin-bottom: -10px;
        }
        
        .responsive-theme-opened .btn-extars {
            border-top: 1px solid #204849;
            border-bottom: 1px solid #204849;
            padding: 10px 0;
        }
        
        .responsive-theme-opened .btn-extars {
            border-top: 1px solid #204849;
            border-bottom: 1px solid #204849;
            padding: 10px 0;
        }
        
        .responsive-theme-menu-main>ul>li {
            margin: 10px 0;
            position: relative;
        }
        
        .responsive-theme-menu-main>ul>li>a {
            font-size: 16px;
            color: #f9f9f9;
            padding-right: 30px;
            position: relative;
        }
        
        .responsive-theme-menu-main>ul>li.menu-item-has-children>a::before,
        .responsive-theme-menu-main>ul>li.menu-item-has-children>a::after {
          transition: .2s all linear;
            position: absolute;
            right: 0;
            top: 13px;
            width: 20px;
            height: 1px;
            background: #ffffff;
            content: "";
        }
        
        .responsive-theme-menu-main>ul>li.menu-item-has-children>a::after {
            right: 10px;
            top: 4px;
            width: 1px;
            height: 20px;
            transition: .2s all linear;
        }
        .responsive-theme-menu-main>ul>li.menu-item-has-children.active a::before {
          transition: .2s all linear;
          transform: rotate(180deg);
      }
        
        .responsive-theme-menu-main>ul>li ul {
            margin: 20px 0;
            padding-left: 30px;
            display: none;
        }
        
        .responsive-theme-menu-main>ul,
        .responsive-theme-menu-main>ul>li ul>li {
            margin: 0;
            padding:10px;
        }
        
        .responsive-theme-menu-main>ul>li ul>li a {
            color: #ffffff;
            font-size: 13px;
            padding: 8px 0;
        }
        
        .responsive-theme-menu-main>ul>li.menu-item-has-children.active,
        .responsive-theme-menu-main>ul>li.menu-item-has-children.active>ul {
            margin-bottom: 0;
        }
        
        .responsive-theme-menu-main>ul>li.menu-item-has-children.active a::after {
            transform: rotate(270deg);
            transition: .2s all linear;
        }
        
        .responsive-theme-menu-main>ul>li.menu-item-has-children.active>a {
            color: #ffffff;
        }
        
        .responsive-theme-menu-main>ul>li ul>li a:hover {
            color: chocolate;
            padding-left: 15px;
        }
        
        .menu-theme-openmenu.active {
            opacity: 0;
            visibility: hidden;
            -webkit-transform: scale(0);
            -moz-transform: scale(0);
            -ms-transform: scale(0);
            -o-transform: scale(0);
            transform: scale(0);
        }
        
        .menu-theme-action.opened .menu-theme-closemenu {
            opacity: 1;
            visibility: visible;
        }
        
        .menu-theme-closemenu img {
            float: left;
            margin-right: 12px;
        }
        
        p.subscribe-text {
          font-weight: 500;
          color: #fff;
          font-size: 17px;
          line-height: 1.3;
      }
      .newsletter{
        margin: 45px 0 !important;
      }
      .footer-top{
        padding-bottom: 50px; 
      }
      .footer-top.section-padding{
        padding: 50px 20px;
      }
      footer .footer-top .tags li a{
        width: 134px;
        text-align: center;
      }
      .footer-logo{
        margin-bottom: 50px;
      }
      .footer-logo img{
        margin: auto;
        display: block;
      }
      .footer-top .widget-title h5{
        width: fit-content;
        margin: auto;
      }
        @media (max-width:1200px) {
            .responsive-header-main {
                display: block;
            }
        }
        footer .footer-top .widget-title{
            margin-bottom: 20px;
        }
        footer .footer-top{
            // background: #42d79e;
        }
        footer .footer-bottom{
          background: #313131;
        }
        .newsletter {
          background-color: unset !important;
      }
');
  $this->registerJs('
$(document).on("click","#subscribe_email_footer",function (e){
    e.preventDefault();
    var form = $("#email_footer");
    var btn = $(this);
    var email = form.val();
    if(email){
        form.val("");
        $.ajax({
        url: "/site/subscribe",
        type: "POST",
        data: {email:email},
        beforeSend: function () {
            btn.attr("disabled", true);
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                btn.attr("disabled", false);
                form.val("");
            } else {
                toastr.error(response.message, response.title);
            }
        },
    });
    }
});
$(document).on("click","#button-search",function(e){
e.preventDefault();
var dataVal = $("#input-search").val();
var dataLink = $(this).parent().attr("data-link");
var dataLink1 = $(this).parent().attr("data-link1");
if(dataVal){
url = dataLink + "?keyword=" + dataVal;
window.location.replace(url);
} else {
window.location.replace(dataLink1);
}
})
$(document).on("click",".contactTel",function(e){
var data_id = $(this).attr("data_id");
window.open("tel:"+data_id);
});
$(document).on("click",".open-link",function(e){
    e.preventDefault();
    location.replace($(this).attr("href"));
});
$(document).on("change","#open-search",function(e){
    if($(this).prop("checked")){
        $("header").css("height","110px");
    } else{
        $("header").css("height","70px");
    }
});
$(document).on("click",".remove_to_cart",function(e){
    var btn = $(this);
    var id = btn.attr("data-id");
    $("#"+id).remove();
    $.ajax({
            url: "/site/remove-to-cart",
            method: "POST",
            data: {id: id},
            success: function (response) {
                if (response.status == 200) {
                    $.pjax.reload({container:"#add_to_cart_pjax"});
                } 
            },
        });    
});
 $(".responsive-theme-menu-main .menu-item-has-children > a").on("click", function() {
            $(this).parent().siblings().children("ul").slideUp();
            $(this).parent().siblings().removeClass("active");
            $(this).parent().children("ul").slideToggle();
            $(this).parent().toggleClass("active");
            return false;
        });
        $(".menu-theme-openmenu").on("click", function() {
            $(".responsive-header-main").addClass("active");
            $(".responsive-theme-opened").slideDown();
            $(".menu-theme-closemenu").removeClass("active")
            $(this).addClass("active");
            $(this).parent().removeClass("closed");
            $(this).parent().addClass("opened");
            $(document.body).css("overflow", "hidden");
          });
          $(".menu-theme-closemenu").on("click", function() {
            $(".responsive-header-main").removeClass("active");
            $(".responsive-theme-opened").slideUp();
            $(".menu-theme-openmenu").removeClass("active")
            $(this).addClass("active");
            $(this).parent().removeClass("opened");
            $(this).parent().addClass("closed");
            $(document.body).css("overflow", "auto");
        });
// var ps = new PerfectScrollbar(".nav-row");
');
  // $this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.min.css');
  // $this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js');
  ?>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/61f24c5fb9e4e21181bc25ec/1fqd7klsc';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
  <!-- hs bottom footer wrapper End -->
  <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>