<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="contact">
    <div class="contact-heading">
        <img src="/images/content/about/whey-protein-powder.jpg">
        <h1>Contact The BodyBay</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center my-5">Get in Touch</h1>
            </div>
        </div>
        <div class="contact-form">
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'options' => ['class' => 'row']
            ]); ?>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?= $form->field($model, 'name')->textInput(["placeholder" => "Name", "class" => "input-text js-input"])->label(false) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?= $form->field($model, 'email')->textInput(["placeholder" => "Email", "class" => "input-text js-input"])->label(false) ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <?= $form->field($model, 'subject')->textInput(["placeholder" => "Subject", "class" => "input-text js-input"])->label(false) ?>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $form->field($model, 'body')->textArea(['autocomplete' => 'off', 'rows' => 3, 'placeholder' => 'Comments', "class" => "input-text js-input"])->label(false); ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    "class" => "input-text js-input",
                    'template' => '<div class="row"><div class="col-lg-12">{image}</div><div class="col-lg-12 captcha-input">{input}</div></div>',
                ]) ?>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <label>Want to Became a Dealer</label>
                <?=
                $form->field($model, 'dealer')->radioList([1 => 'Yes' ,0 => 'No'], [
                    'item' => function ($index, $label, $name, $checked, $value) {
                        $return = '<div class="radion_btn"><input type="radio" id="' . $value . $index . '" name="'.$name.'" value="' . $label . '" '.$checked.'>';
                        $return .= '<label for="' . $value . $index . '">' . $label . ' </label>';
                        $return .= '<div class="check"></div>';
                        $return .= '</div>';
                        return $return;
                    }
                ])->label(false);
                ?>
            </div>
            <div class="form-field col x-100 align-center">
                <?= Html::submitButton('Send a Message', ['class' => 'hs_btn_hover submitForm submit-btn', 'name' => 'contact-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="contact-card py-3">
                    <iframe width="320" height="125" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=550&amp;hl=en&amp;q=30.901271276336434,%2075.90984537053865+(The%20BodyBay)&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>

                    <p>The BodyBay 921/25/B, Adjoining Axis Bank Atm Jamalpur Chowk, Chandigarh Road Ludhiana</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="fa fa-phone"></i>
                    <h3>Phone</h3>
                    <p>+91 7355507555</p>
                    <a href="tel:+91 7355507555">Call</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card">
                    <i class="fa fa-envelope"></i>
                    <h3>Email</h3>
                    <p>support@thebodybay.com</p>
                    <a href="mailto:support@thebodybay.com">Mail</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$this->registerCss('
.contact{
        margin: 25px 0;
        margin-top: 0;
    }
    .contact-heading{
        height: 250px;
        width: 100%;
        position: relative;
    }
    .contact-heading img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.5;
    }
    .contact-heading h1 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%,-50%);
        text-transform: uppercase;
        color: #000;
    }
    .contact-heading h1::before {
        width: 9px;
        height: 100%;
        background: #57bce2;
        content: "";
        display: inline-block;
        position: absolute;
        left: -17px;
    }
    
      .contact-form .row:after {
        content: "";
        display: table;
        clear: both;
      }
      .contact-form .row .col {
        padding: 0 20px;
        float: left;
        box-sizing: border-box;
      }
      .contact-form .row .col.x-50 {
        width: 50%;
      }
      .contact-form .row .col.x-100 {
        width: 100%;
      }
      .contact-form .form-group {
        margin: 15px 0;
    }
    .contact-form .form-field {
    position: relative;
    margin: 32px 0;
    }
    .contact-form .input-text {
    display: block;
    width: 100%;
    height: 36px;
    border-width: 0 0 2px 0;
    border-color: #000;
    font-family: Lusitana, serif;
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    min-height: 50px;
    margin-bottom: 10px;
    }
    .contact-form .help-block{
        color: #ff5454;
    }
    .contact-form .input-text:focus {
    outline: none;
    }
    .contact-form .input-text:focus + .label, .contact-form .input-text.not-empty + .label {
    transform: translateY(-24px);
    }
    .captcha-input input {
        max-width: 250px;
        margin: 13px 0 0 0;
    }
    .contact-form .label {
    position: absolute;
    left: 20px;
    bottom: 17px;
    font-family: Lusitana, serif;
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    color: #888;
    cursor: text;
    transition: transform 0.2s ease-in-out;
    }

    .contact-form .submit-btn {
    display: inline-block;
    background-color: #000;
    color: #fff;
    font-family: Raleway, sans-serif;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 16px;
    line-height: 24px;
    padding: 8px 16px;
    border: none;
    cursor: pointer;
    }
    .contact-card {
        box-shadow: 0 0 2px 2px #ddd;
        padding: 20px;
        min-height: 240px;
        text-align: center;
        position: relative;
    }
    .contact-card i {
        font-size: 50px;
        color: #42d79e;
    }
    .contact h3 {
        margin-top: 20px;
        color: #646464;
    }
    .contact-card p {
        font-size: 16px;
        margin: 0;
    }
    .contact-card a {
        background: #42d79e;
        text-decoration: none;
        color: #fff;
        left: 50%;
        transform: translate(-50%);
        width: 90%;
        position: absolute;
        bottom: 10px;
        padding: 3px 0;
    }
');
$script = <<<JS
$(document).on('submit','#contact-form',function(e) {
  e.preventDefault();
  var form = $(this);
    var btn = $('.submitForm');
    var btn_value = btn.text();
    e.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    form.data('requestRunning', true);
    
    var url = form.attr('action');
    var data = form.serialize();
    var method = form.attr('method');
    $.ajax({
        url: url,
        type: method,
        data: data,
        beforeSend: function () {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
                btn.attr('disabled', false);
            btn.html(btn_value);
            form[0].reset();
            } else {
                toastr.error(response.message, response.title);
            }
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    });
  
})
JS;
$this->registerJS($script);
