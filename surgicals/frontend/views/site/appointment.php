<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Appointment';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="hs_indx_title_main_wrapper">
        <div class="hs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                    <div class="hs_indx_title_left_wrapper">
                        <h2>Appointment</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  full_width">
                    <div class="hs_indx_title_right_wrapper">
                        <ul>
                            <li><a href="/">Home</a></li>
                            <li>Appointment</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hs_contact_indx_form_main_wrapper">
        <div class="container">
            <div class="row">
                <?php $form = ActiveForm::begin(['id' => 'appointment-form']); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_about_heading_main_wrapper">
                        <div class="hs_about_heading_wrapper">
                            <h2>Book <span>Appointment</span></h2>
                            <h4><span>&nbsp;</span></h4>
                            <p>we would love to hear from you.</p>
                        </div>
                    </div>
                </div>
                <form>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-name">
                            <?= $form->field($model, 'name')->textInput(["placeholder" => "Name","class" => "c-white"])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-phone">
                            <?= $form->field($model, 'phone_no')->textInput(["placeholder" => "Phone Number","class" => "c-white"])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-email">
                            <?= $form->field($model, 'email')->textInput(["placeholder" => "email","class" => "c-white"])->label(false) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label>Gender : </label>
                        <?= $form->field($model, 'gender')->inline()->radioList(['Male' => 'Male', 'Female' => 'Female', 'Transgender' => 'Transgender'])->label(false); ?>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label>Have You Previously Taken Appointment : </label>
                        <?= $form->field($model, 'prev_appointment')->inline()->radioList([1 => 'Yes', 0 => 'No'])->label(false); ?>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-message">
                            <?= $form->field($model, 'description')->textArea(['autocomplete' => 'off', 'rows' => 3, 'placeholder' => 'Brief Description',"class" => "c-white"])->label(false); ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-message">
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-3 inputWhite">{input}</div></div>',
                            ]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper i-message i-message2">
                            <?= $form->field($model,'date')->input('datetime-local',['autocomplete' => "off","class" => "c-white"])->label(false)?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="response"></div>
                        <div class="hs_kd_six_sec_btn">
                            <ul>
                                <li>
                                    <input type="hidden" name="form_type" value="contact">
                                    <?= Html::submitButton('Submit', ['class' => 'hs_btn_hover submitForm', 'name' => 'contact-button']) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?php
$this->registerCss('
.col-lg-3.inputWhite > input {
    color: white;
}
.c-white{
color:white;
}
has-success .checkbox, .has-success .checkbox-inline, .has-success .control-label, .has-success .help-block, .has-success .radio, .has-success .radio-inline, .has-success.checkbox label, .has-success.checkbox-inline label, .has-success.radio label, .has-success.radio-inline label {
    color: white;
}
::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
.hs_kd_six_sec_input_wrapper.i-message.i-message2:after {
    left: 12px;
    top: 15px;
}
');
$script = <<<JS
$(document).on('submit','#appointment-form',function(e) {
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
             Swal.fire(
              'Appointment Book',
              'SuccessFully',
              'success'
            );
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
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['depends' => [\yii\web\JqueryAsset::className()]]);
