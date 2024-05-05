<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-form-box">
    <div class="hs_indx_title_main_wrapper">
        <div class="hs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                    <div class="hs_indx_title_left_wrapper">
                        <h2 class="text-center">Login</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="hs_contact_tittle_main_wrapper login-inputs">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php
                    echo $this->render('/widgets/login');
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="register-here-btn">
    Not a user? <?= Html::a('Register Here', ['site/signup']) ?>
    </div>
</div>

<?php $this->registerCss('
    form#login-form {
        margin: auto;
        max-width: 330px;
    }
    .login-form-box {
        max-width: 500px;
        margin: 50px auto;
        background: #57bce212;
        padding: 40px 20px;
        border-top: 4px solid #57bce2;
        position: relative;
    }
    .hs_indx_title_left_wrapper h2 {
        margin-bottom: 35px;
        text-transform: uppercase;
    }
    .register-here-btn {
        text-align: center;
        position: absolute;
        left: 50%;
        transform: translate(-50%);
        bottom: 10px;
        font-size: 14px;
    }
    .login-inputs {
        border-bottom: 1px solid #aaa;
        padding-bottom: 25px;
    }

') ?>