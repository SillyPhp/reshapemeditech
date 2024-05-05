<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Media';
$bUrl = Url::to('/', 'https');
$created_at = date("Y-m-d", strtotime($assignMedia->created_at));
$expiry_date = date("Y-m-d", strtotime($created_at . "+" . $assignMedia->expiry_date_number . "day"));
$session = Yii::$app->session;
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
<?php
if (date("Y-m-d") <= $expiry_date) {
    ?>
    <div class="hs_contact_indx_form_main_wrapper">
        <div class="container">
            <div class="row">
                <?php
                if ($session['media_login']) {
                    $path = Yii::$app->params['upload_directories']['videos']['image'] . $media['_uid'] . '/' . $media['video'];
                    $ext = explode('.', $path);
                    $ext = $ext[1];
                    $video_ext = '';
                    $audio_ext = '';
                    if (in_array($ext, ['mts', 'mp4', 'mov', 'avi', 'wmv'])) {
                        $video_ext = $ext;
                    } else {
                        $audio_ext = $ext;
                    }
                    ?>
                    <h1><?= $media['title'] ?></h1>
                    <?php if ($video_ext) { ?>
                        <video width="500" height="500" controls>
                            <source src="<?= $bUrl . $path ?>" type="video/<?= $video_ext ?>">
                            Your browser does not support the video tag.
                        </video>
                    <?php } else { ?>
                        <audio controls>
                            <source src="<?= $bUrl . $path ?>" type="audio/<?= $audio_ext ?>">
                            Your browser does not support the audio element.
                        </audio>
                    <?php } ?>
                <?php } else {
                    ?>
                    <?php $form = ActiveForm::begin(['id' => 'media-login-form']); ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="hs_about_heading_main_wrapper">
                            <div class="hs_about_heading_wrapper">
                                <!--                        <p>--><? //= $assignMedia->title ?><!--</p>-->
                            </div>
                        </div>
                    </div>
                    <form>
                        <div class="col-md-6 col-md-offset-3">
                            <div class="form-data">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="hs_kd_six_sec_input_wrapper">
                                        <?= $form->field($model, 'phone_number')->textInput(['autocomplete' => 'off'])->label('Enter Phone Number'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="hs_kd_six_sec_input_wrapper">
                                        <?= $form->field($model, 'password')->passwordInput(['autocomplete' => 'off'])->label('Confirm Password'); ?>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="response"></div>
                                    <div class="hs_kd_six_sec_btn margin-set">
                                        <ul>
                                            <li>
                                                <?= Html::submitButton('Login', ['class' => 'hs_btn_hover submitLoginForm']) ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php ActiveForm::end(); ?>
                    <?php
                } ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php
$this->registerCss('
.form-data {
    box-shadow: 0 0 14px 0px #fff;
    clear: both;
    display: flex;
    flex-wrap: wrap;
    padding: 20px;
    border-radius: 4px;
}
.margin-set{margin:20px 0;}
');
$script = <<<JS
$("#playvideo").click(function(){
      $("#video1")[0].src += "?autoplay=1";
     });
$(document).on('click', '.submitLoginForm', function (event) {
    // event.preventDefault();
    var btn = $(this);
    var form = $('#media-login-form');
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