<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>


<!-- <div class="site-error container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div> -->

<section class="error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="error-img">
                    <img src="/images/error-img.png" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="error-text">
                    <h1><?= $exception->statusCode ?></h1>
                    <p><?= nl2br(Html::encode($message)); ?></p>
                    <a href="/"><i class="fa fa-arrow-left"></i>Go Back</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php

$this->registerCss('
// .site-error{
//     margin-top: 200px;
//     position: relative;
// }
// .site-error h1{
//     color:#ddd;
//     margin-bottom: 20px;
// }


section.error-page {
    margin-top: 163px;
    min-height: 500px;
    display: flex;
    align-items: center;
    padding-bottom: 40px;
}
.error-page .row {
    display: flex;
    align-items: center;
}
.error-img {
    width: 500px;
    margin: auto;
}
.error-img img {
    width: 100%;
}
.error-text h1 {
    font-size: 45px;
    color: #fff;
    text-transform: uppercase;
    font-family: Roboto;
    font-weight: 800;
    letter-spacing: 1.5px;
}
.error-text p {
    font-size: 20px;
    margin-top: 0px;
}
.error-text a {
    padding: 10px 16px;
    background: #fff;
    color: #000;
    margin-top: 40px;
    border-radius: 6px;
    display: inline-flex;
    align-items: baseline;
}
.error-text a i {
    transition: all .2s ease-in;
    margin-right: 6px;
}
.error-text a:hover i {
    transform: translateX(-8px);
    transition: all .2s ease-in;
}

@media only screen and (max-width: 1199px){
    .error-img{
        width: 430px;
    }
}

@media only screen and (max-width: 991px){
    .error-img{
        width: 380px;
    }
    .error-text h1{
        font-size: 40px;
    }
}

@media only screen and (max-width: 767px){
    .error-page .row{
        flex-direction: column;
    }
    .error-text{
        text-align: center;
    }
    .error-text h1{
        font-size: 30px;
    }
    .error-img{
        width: 300px;
    }
}
');