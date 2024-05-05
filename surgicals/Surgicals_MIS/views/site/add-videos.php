<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Add Videos';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2><?= $this->title ?></h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <div class="blogs-create container-fluid">
            <div class="blogs-form">
                <?php $form = ActiveForm::begin(['id' => 'add-videos']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Title</label>
                        <?= $form->field($model, 'video_title')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'video_name')->fileInput(['autocomplete' => 'off']); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['id' => 'videos_btn', 'class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
<?php
$this->registerCss('
.tcenter{
text-align:center;
}
');
$script = <<<JS
$(document).on('submit','#add-videos',function (event){
    event.preventDefault();
    var form = $(this);
    var btn = $('#videos_btn');
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    form.data('requestRunning', true);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = new FormData(this);
    $.ajax({
        url: url,
        type: method,
        enctype: 'multipart/form-data',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
            btn.attr('disabled', true);
        },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                window.location.href = '/site/videos';
            } else {
                toastr.error(response.message, response.title);
            }
            btn.html(btn_value);    
            btn.attr('disabled', false);
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    });
});
JS;
$this->registerJS($script);
