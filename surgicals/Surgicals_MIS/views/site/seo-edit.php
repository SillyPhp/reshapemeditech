<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Edit SEO';
$this->params['breadcrumbs'][] = ['label' => 'Seo', 'url' => ['index']];
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
                    <li><span><?= 'Edit SEO'?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="blogs-create container-fluid">
            <div class="blogs-form">
                <?php $form = ActiveForm::begin(['id' => 'edit-seo']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Route</label>
                        <?= $form->field($model, 'route')->textInput(['autocomplete' => 'off','disabled' => true])->label(false) ?>
                    </div>
                    <div class="col-md-6">
                        <label>Title</label>
                        <?= $form->field($model, 'title')->textInput(['autocomplete' => 'off'])->label(false) ?>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-3">
                            <?= $form->field($model, 'image')->fileInput(['id' => 'logoUpload','autocomplete' => 'off']); ?>
                        </div>
                        <div class="col-md-3">
                            <?php
                            if($dataModel['image_enc_name']){
                                echo '<img src="' . Yii::$app->params->upload_directories->seo->image . '/' . $dataModel['_uid'] . '/' . $dataModel['image_enc_name'] . '" width="100%">';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Keywords</label>
                        <?= $form->field($model, 'keywords')->textInput(['autocomplete' => 'off'])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textArea(['id'=>"textarea",'rows' => 4, 'cols' => 5, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Description'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group tcenter">
                        <?= Html::submitButton('Update', ['id' =>'blogs_btn','class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
<?php
$script = <<<JS
$(document).on('submit','#edit-seo',function (event){
    event.preventDefault();
    var form = $(this);
    var btn = $('#blogs_btn');
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
                window.location.href = '/site/seo';
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
