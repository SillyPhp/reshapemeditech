<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
AppAsset::register($this);
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<section class="body">

    <!-- start: header -->
    <header class="header">
        <div class="logo-container">
            <a href="/" class="logo">
                <img src="/images/account/logo/default-logo1.png" height="50" alt="Porto Admin" />
            </a>
            <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>

        <!-- start: search & user box -->
        <div class="header-right">

<!--            <form action="pages-search-results.html" class="search nav-form">-->
<!--                <div class="input-group input-search">-->
<!--                    <input type="text" class="form-control" name="q" id="q" placeholder="Search...">-->
<!--                    <span class="input-group-btn">-->
<!--								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>-->
<!--							</span>-->
<!--                </div>-->
<!--            </form>-->

            <span class="separator"></span>

<!--            <ul class="notifications">-->
<!--                <li>-->
<!--                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">-->
<!--                        <i class="fa fa-tasks"></i>-->
<!--                        <span class="badge">3</span>-->
<!--                    </a>-->
<!---->
<!--                    <div class="dropdown-menu notification-menu large">-->
<!--                        <div class="notification-title">-->
<!--                            <span class="pull-right label label-default">3</span>-->
<!--                            Tasks-->
<!--                        </div>-->
<!---->
<!--                        <div class="content">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <p class="clearfix mb-xs">-->
<!--                                        <span class="message pull-left">Generating Sales Report</span>-->
<!--                                        <span class="message pull-right text-dark">60%</span>-->
<!--                                    </p>-->
<!--                                    <div class="progress progress-xs light">-->
<!--                                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>-->
<!--                                    </div>-->
<!--                                </li>-->
<!---->
<!--                                <li>-->
<!--                                    <p class="clearfix mb-xs">-->
<!--                                        <span class="message pull-left">Importing Contacts</span>-->
<!--                                        <span class="message pull-right text-dark">98%</span>-->
<!--                                    </p>-->
<!--                                    <div class="progress progress-xs light">-->
<!--                                        <div class="progress-bar" role="progressbar" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100" style="width: 98%;"></div>-->
<!--                                    </div>-->
<!--                                </li>-->
<!---->
<!--                                <li>-->
<!--                                    <p class="clearfix mb-xs">-->
<!--                                        <span class="message pull-left">Uploading something big</span>-->
<!--                                        <span class="message pull-right text-dark">33%</span>-->
<!--                                    </p>-->
<!--                                    <div class="progress progress-xs light mb-xs">-->
<!--                                        <div class="progress-bar" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width: 33%;"></div>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">-->
<!--                        <i class="fa fa-envelope"></i>-->
<!--                        <span class="badge">4</span>-->
<!--                    </a>-->
<!---->
<!--                    <div class="dropdown-menu notification-menu">-->
<!--                        <div class="notification-title">-->
<!--                            <span class="pull-right label label-default">230</span>-->
<!--                            Messages-->
<!--                        </div>-->
<!---->
<!--                        <div class="content">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <figure class="image">-->
<!--                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Doe Junior" class="img-circle" />-->
<!--                                        </figure>-->
<!--                                        <span class="title">Joseph Doe</span>-->
<!--                                        <span class="message">Lorem ipsum dolor sit.</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <figure class="image">-->
<!--                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />-->
<!--                                        </figure>-->
<!--                                        <span class="title">Joseph Junior</span>-->
<!--                                        <span class="message truncate">Truncated message. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam, nec venenatis risus. Vestibulum blandit faucibus est et malesuada. Sed interdum cursus dui nec venenatis. Pellentesque non nisi lobortis, rutrum eros ut, convallis nisi. Sed tellus turpis, dignissim sit amet tristique quis, pretium id est. Sed aliquam diam diam, sit amet faucibus tellus ultricies eu. Aliquam lacinia nibh a metus bibendum, eu commodo eros commodo. Sed commodo molestie elit, a molestie lacus porttitor id. Donec facilisis varius sapien, ac fringilla velit porttitor et. Nam tincidunt gravida dui, sed pharetra odio pharetra nec. Duis consectetur venenatis pharetra. Vestibulum egestas nisi quis elementum elementum.</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <figure class="image">-->
<!--                                            <img src="assets/images/!sample-user.jpg" alt="Joe Junior" class="img-circle" />-->
<!--                                        </figure>-->
<!--                                        <span class="title">Joe Junior</span>-->
<!--                                        <span class="message">Lorem ipsum dolor sit.</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <figure class="image">-->
<!--                                            <img src="assets/images/!sample-user.jpg" alt="Joseph Junior" class="img-circle" />-->
<!--                                        </figure>-->
<!--                                        <span class="title">Joseph Junior</span>-->
<!--                                        <span class="message">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet lacinia orci. Proin vestibulum eget risus non luctus. Nunc cursus lacinia lacinia. Nulla molestie malesuada est ac tincidunt. Quisque eget convallis diam.</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!---->
<!--                            <hr />-->
<!---->
<!--                            <div class="text-right">-->
<!--                                <a href="#" class="view-more">View All</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">-->
<!--                        <i class="fa fa-bell"></i>-->
<!--                        <span class="badge">3</span>-->
<!--                    </a>-->
<!---->
<!--                    <div class="dropdown-menu notification-menu">-->
<!--                        <div class="notification-title">-->
<!--                            <span class="pull-right label label-default">3</span>-->
<!--                            Alerts-->
<!--                        </div>-->
<!---->
<!--                        <div class="content">-->
<!--                            <ul>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <div class="image">-->
<!--                                            <i class="fa fa-thumbs-down bg-danger"></i>-->
<!--                                        </div>-->
<!--                                        <span class="title">Server is Down!</span>-->
<!--                                        <span class="message">Just now</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <div class="image">-->
<!--                                            <i class="fa fa-lock bg-warning"></i>-->
<!--                                        </div>-->
<!--                                        <span class="title">User Locked</span>-->
<!--                                        <span class="message">15 minutes ago</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="clearfix">-->
<!--                                        <div class="image">-->
<!--                                            <i class="fa fa-signal bg-success"></i>-->
<!--                                        </div>-->
<!--                                        <span class="title">Connection Restaured</span>-->
<!--                                        <span class="message">10/10/2014</span>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!---->
<!--                            <hr />-->
<!---->
<!--                            <div class="text-right">-->
<!--                                <a href="#" class="view-more">View All</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->

            <span class="separator"></span>

            <div id="userbox" class="userbox">
                <a href="#" data-toggle="dropdown">
<!--                    <figure class="profile-picture">-->
<!--                        <img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />-->
<!--                    </figure>-->
<!--                    <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">-->
<!--                        <span class="name">--><?php //= Yii::$app->user->identity->username ?><!--</span>-->
<!--                        <span class="role">administrator</span>-->
<!--                    </div>-->

                    <i class="fa custom-caret"></i>
                </a>

                <div class="dropdown-menu">
                    <ul class="list-unstyled">
                        <li class="divider"></li>
<!--                        <li>-->
<!--                            <a role="menuitem" tabindex="-1" href="pages-user-profile.html"><i class="fa fa-user"></i> My Profile</a>-->
<!--                        </li>-->
<!--                        <li>-->
<!--                            <a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>-->
<!--                        </li>-->
                        <li>
                            <a role="menuitem" tabindex="-1" href="/products/clear-my-cache"><i class="fa fa-refresh"></i> Clear Cache</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="/site/logout" methods="post"><i class="fa fa-power-off"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end: search & user box -->
    </header>
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">

            <div class="sidebar-header">
                <div class="sidebar-title">
                    Navigation
                </div>
                <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <li>
                                <a href="/">
                                    <i class="fa fa-home" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
<!--                            <li>-->
<!--                                <a href="/categories">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Categories</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/brands">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Brands</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/detail-groups">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Detail Groups</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/specifications">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Specifications</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li>
                                <a href="/products/product">
                                    <!--                                    <span class="pull-right label label-primary">0</span>-->
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Products</span>
                                </a>
                            </li>
                            <li>
                                <a href="/products">
<!--                                    <span class="pull-right label label-primary">0</span>-->
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Products Combinations</span>
                                </a>
                            </li>
<!--                            <li>-->
<!--                                <a href="/site/add-product">-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>ADD Products</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li>
                                <a href="/blogs">
<!--                                                                        <span class="pull-right label label-primary">0</span>-->
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Blogs</span>
                                </a>
                            </li>
                            <li>
                                <a href="/site/subscribers">
                                    <!--                                                                        <span class="pull-right label label-primary">0</span>-->
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Subscribers</span>
                                </a>
                            </li>
                            <li>
                                <a href="/site/orders">
                                    <!--                                                                        <span class="pull-right label label-primary">0</span>-->
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Orders</span>
                                </a>
                            </li>
<!--                            <li>-->
<!--                                <a href="/services">-->
<!--                                 <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Services</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/site/reviews">-->
<!--                                         <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Client Reviews</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/site/videos">-->
<!--                             <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Media's</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li>
                                <a href="/site/contact-us">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Contact</span>
                                </a>
                            </li>
                            <li>
                                <a href="/categories/sub-category">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Categories</span>
                                </a>
                            </li>
                            <li>
                                <a href="/brands">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Brands</span>
                                </a>
                            </li>
                            <li>
                                <a href="/site/seo">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>SEO</span>
                                </a>
                            </li>
                            <li>
                                <a href="/vouchers">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Vouchers</span>
                                </a>
                            </li>
                            <li>
                                <a href="/faq">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>FAQ</span>
                                </a>
                            </li>
                            <li>
                                <a href="/user">
                                    <i class="fa fa-list" aria-hidden="true"></i>
                                    <span>Users</span>
                                </a>
                            </li>
<!--                            <li>-->
<!--                                <a href="/site/prayers">-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Prayers</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/user">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Users</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/site/faq">-->
                                    <!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>FAQ</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/specification-values">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Specification Values</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/vendors">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>All Vendors</span>-->
<!--                                </a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="/products/add">-->
<!--                                    <span class="pull-right label label-primary">0</span>-->
<!--                                    <i class="fa fa-list" aria-hidden="true"></i>-->
<!--                                    <span>Add Mobiles</span>-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </nav>


                </div>

            </div>

        </aside>
        <!-- end: sidebar -->
        <?= $content ?>
    </div>
    <aside id="sidebar-right" class="sidebar-right">
        <div class="nano">
            <div class="nano-content">
                <a href="#" class="mobile-close visible-xs">
                    Collapse <i class="fa fa-chevron-right"></i>
                </a>

                <div class="sidebar-right-wrapper">

                    <div class="sidebar-widget widget-calendar">
                        <h6>Upcoming Tasks</h6>
                        <div data-plugin-datepicker data-plugin-skin="dark" ></div>

                        <ul>
                            <li>
                                <time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
                                <span>Company Meeting</span>
                            </li>
                        </ul>
                    </div>

                    <div class="sidebar-widget widget-friends">
                        <h6>Friends</h6>
                        <ul>
                            <li class="status-online">
                                <figure class="profile-picture">
                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                </figure>
                                <div class="profile-info">
                                    <span class="name">Joseph Doe Junior</span>
                                    <span class="title">Hey, how are you?</span>
                                </div>
                            </li>
                            <li class="status-online">
                                <figure class="profile-picture">
                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                </figure>
                                <div class="profile-info">
                                    <span class="name">Joseph Doe Junior</span>
                                    <span class="title">Hey, how are you?</span>
                                </div>
                            </li>
                            <li class="status-offline">
                                <figure class="profile-picture">
                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                </figure>
                                <div class="profile-info">
                                    <span class="name">Joseph Doe Junior</span>
                                    <span class="title">Hey, how are you?</span>
                                </div>
                            </li>
                            <li class="status-offline">
                                <figure class="profile-picture">
                                    <img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
                                </figure>
                                <div class="profile-info">
                                    <span class="name">Joseph Doe Junior</span>
                                    <span class="title">Hey, how are you?</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </aside>
</section>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<?php
$this->registerCss('
//.logo_name{
//    position: fixed;
//    color: rebeccapurple;
//    font-size: 30px;
//    font-weight: 800;
//    top: 15px;
//    left: 15px;
//}
');
