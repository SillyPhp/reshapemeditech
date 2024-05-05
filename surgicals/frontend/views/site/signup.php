<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$site_name = Yii::$app->params['site_name'];
$this->title = $site_name . ' Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
    <section class="login-main-wrapper">
        <div class="container-fluid pl-0 pr-0">
            <div class="row no-gutters">
                <div class="col-md-12 bg-white full-height vertical-center">
                    <div class="login-main-left hs_kd_six_sec_input_wrapper mt-5">
                        <div class="text-center mr-0 mb-5 login-main-left-header pt-2">
                            <h3 class="mt-3 mb-3">Signup to <?= $site_name ?></h3>
                            <h5 class="mb-3">Please fill out the following fields to signup:</h5>
                        </div>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'email') ?>
                        <?= $form->field($model, 'contact') ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <div class="hs_contact_indx_form_main_wrapper p-0">
                            <div class="hs_kd_six_sec_btn m-0 mb-3">
                                <ul>
                                    <li>
                                        <?= Html::submitButton('Signup', ['class' => 'hs_btn_hover submitForm', 'name' => 'signup-button']) ?>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>
                        <div class="text-center mt-5">
                            <p class="light-gray">Already have an Account? <a href="/site/login">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<div class="site-signup">-->
    <!--    <h1>--><? //= Html::encode($this->title) ?><!--</h1>-->
    <!---->
    <!--    <p>Please fill out the following fields to signup:</p>-->
    <!---->
    <!--    <div class="row">-->
    <!--        <div class="col-lg-5">-->
    <!--            --><?php //$form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <!---->
    <!--                --><? //= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
    <!---->
    <!--                --><? //= $form->field($model, 'email') ?>
    <!---->
    <!--                --><? //= $form->field($model, 'password')->passwordInput() ?>
    <!---->
    <!--                <div class="form-group">-->
    <!--                    --><? //= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    <!--                </div>-->
    <!---->
    <!--            --><?php //ActiveForm::end(); ?>
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
<?php
$this->registerCss('
.vertical-center {
    min-height: 100%;
    min-height: 100vh;
    display: flex;
    align-items: center;
}
.p-0{
    padding: 0 !important;
}
.m-0{
    margin: 0 !important;
}
.p-5 {
    padding: 3rem!important;
}
.login-main-left {
    margin: auto;
    max-width: 420px;
}
.mt-5, .my-5 {
    margin-top: 3rem!important;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}
.mt-3, .my-3 {
    margin-top: 1rem!important;
}

.login-main-left-header h3, .login-main-left-header h5{
    color:#ddd;
}
.hs_kd_six_sec_btn{
    width:100%;
}
.hs_kd_six_sec_btn ul li{
    text-align:center;
}
.has-error .control-label{
    color:inherit !important;
}
.hs_kd_six_sec_input_wrapper input{
    border: 1px solid #75429c !Important;
}
.hs_kd_six_sec_input_wrapper input, .hs_kd_six_sec_input_wrapper2 input, .hs_kd_six_sec_input_wrapper2 select{
    padding-left: 10px;
}
button.submitForm {
    border: none;
    padding: 8px 25px;
    background: #42d79e;
    color: #fff;
    border-radius: 50px;
    margin-top: 20px;
}
.login-main-left.hs_kd_six_sec_input_wrapper.mt-5 {
    background: #42d79e24;
    padding: 5px 20px;
    border-top: 4px solid #42d79e;
    margin: 10px auto;
}
.text-center.mr-0.mb-5.login-main-left-header.pt-2 * {
    color: #000;
}
p.help-block.help-block-error {
    margin-top: -10px;
}
');