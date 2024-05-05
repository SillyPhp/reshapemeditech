<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        "assets/css/lightcase.css",
        "assets/css/style.css",
        "assets/css/swiper.min.css",
        "assets/css/bootstrap.min.css",
//        "assets/css/fontawesome-all.min.css",
//        "css/animate.css",
//        "css/bootstrap.min.css",
        "css/font-awesome.css",
//        "css/fonts.css",
//        "css/flaticon.css",
        "css/owl.carousel.css",
        "css/owl.theme.default.css",
//        "css/magnific-popup.css",
        "css/reset.css",
        "css/datepicker.css",
//        "css/style.css",
        "css/responsive.css",
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
    ];
    public $js = [
        'assets/js/easing.min.js',
        'assets/js/functions.js',
        'assets/js/isotope.min.js',
        'assets/js/lightcase.min.js',
        'assets/js/swiper.min.js',
        "assets/js/bootstrap.min.js",
//        "js/modernizr.js",
//        "js/jquery.menu-aim.js",
//        "js/parallax.min.js",
        "js/owl.carousel.js",
//        "js/jquery.shuffle.min.js",
//        "js/jquery.countTo.js",
//        "js/jquery.inview.min.js",
        "js/jquery.magnific-popup.js",
        "js/datepicker.js",
        "js/custom.js",
        "js/customScript.js",
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js',
        'https://kit.fontawesome.com/af562a2a63.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
}
