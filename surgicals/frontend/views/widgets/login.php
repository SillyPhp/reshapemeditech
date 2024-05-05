<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use common\models\LoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$model = new LoginForm();
?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'action' => '/site/login',
]); ?>
    <div class="formsix-pos">
        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Username', 'autocomplete' => 'off'])->label(false) ?>
    </div>
    <div class="formsix-e">
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Password', 'autocomplete' => 'off'])->label(false) ?>
    </div>
    <div class="remember_box">
        <?= $form->field($model, 'rememberMe')->checkbox() ?>
        <span><?= Html::a('Forget Password', ['site/request-password-reset']) ?></span>
    </div>
    <div class="hs_top_user_profile width100">
        <div class="hs_effect_btn">
            <ul>
                <li data-animation="animated flipInX">
                    <?= Html::submitButton('Login', ['class' => 'hs_btn_hover', 'name' => 'login-button']) ?>
                    <!--            <a href="#" class="hs_btn_hover">Login</a>-->
                </li>
            </ul>
        </div>
    </div>

    
<?php ActiveForm::end();

$this->registerCss('
.width100{
    width:100%;
    padding:0px !important;
}
.remember_box div .checkbox label{
    line-height:21px;
}
.remember_box div .checkbox p{
    margin:0px !important;
}
button[name="login-button"] {
    padding: 8px 37px;
    margin-top: 20px;
    border-radius: 24px;
    border: none;
    background: #57bce2;
    color: #fff;
    font-weight: 700;
}
');

