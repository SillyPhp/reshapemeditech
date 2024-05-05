<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Media';
$created_at = date("Y-m-d", strtotime($assignMedia->created_at));
$expiry_date = date("Y-m-d", strtotime($created_at . "+" . $assignMedia->expiry_date_number . "day"));

?>
    <div class="hs_indx_title_main_wrapper">
        <div class="hs_title_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 full_width">
                    <div class="hs_indx_title_left_wrapper">
                        <?php
                        if (date("Y-m-d") <= $expiry_date) {
                            ?>
                            <h2><?= $media['title'] ?></h2>
                        <?php } else { ?>
                            <h2>Link has Expired</h2>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hs_contact_indx_form_main_wrapper">
        <div class="container">
            <div class="row">
                <?php if(date("Y-m-d") <= $expiry_date) { ?>
                <?php $form = ActiveForm::begin(['id' => 'media-password-form']); ?>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="hs_about_heading_main_wrapper">
                        <div class="hs_about_heading_wrapper">
                            <!--                        <p>--><? //= $assignMedia->title ?><!--</p>-->
                        </div>
                    </div>
                </div>
                <form>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper">
                            <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'off'])->label('Password'); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="hs_kd_six_sec_input_wrapper">
                            <?= $form->field($model, 'confirm_password')->passwordInput(['autocomplete' => 'off'])->label('Confirm Password'); ?>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="response"></div>
                        <div class="hs_kd_six_sec_btn">
                            <ul>
                                <li>
                                    <?= Html::submitButton('Save', ['class' => 'hs_btn_hover submitForm']) ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
                <?php ActiveForm::end(); ?>
                <?php } else { ?>
                    <span> Link has Expired</span>
                <?php } ?>
            </div>
        </div>
    </div>
<?php
$script = <<<JS
$(document).on('click', '.submitForm', function (event) {
    event.preventDefault();
    var btn = $(this);
    var form = $('#media-password-form');
    event.stopImmediatePropagation();
    // if (form.data('requestRunning')) {
    //     return false;
    // }
    var btn_value = btn.text();
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
                window.location.reload();
            } else {
                toastr.error(response.message, response.title);
            }
            btn.html(btn_value);
            btn.attr('disabled', false);
        },
        complete: function () {
            btn.data('requestRunning', false);
        }
    });

});
JS;
$this->registerJs($script);
