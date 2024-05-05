<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Create Vouchers';
$this->params['breadcrumbs'][] = ['label' => 'Vouchers', 'url' => ['index']];
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
                    <li><span><?= 'Create Vouchers'?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="blogs-create container-fluid">
            <div class="blogs-form">
                <?php $form = ActiveForm::begin(['id' => 'create-vouchers']); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off'])->label("Voucher Code") ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'type')->dropDownList(['fixed' => 'Fixed', 'percentage' => 'Percentage'])->label('Type'); ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'amount')->textInput(['autocomplete' => 'off', 'type' => 'number'])->label("Amount") ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'use_once')->dropDownList([0 => "NO", 1 => "yes"])->label('Use Once'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'end_datetime')->textInput(['autocomplete' => 'off'])->label("Expiry Date"); ?>
                    </div>
                    <div class="col-md-4">
                        <label>Brand</label>
                        <?= $form->field($model, 'brand_id')->dropDownList($brands,['prompt'=>'Select Brand'])->label(false); ?>
                    </div>
                    <div class="col-md-5">
                        <label>Category</label>
                        <?= $form->field($model, 'category_id')->dropDownList($categories,['prompt'=>'Select Category'])->label(false); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group tcenter">
                            <?= Html::submitButton('Save', ['id' =>'blogs_btn','class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>
<?php
$script = <<<JS
$('#start_datetime, #end_datetime').datetimepicker({
          });
$(document).on('submit','#create-vouchers',function (event){
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
                window.location.href = '/vouchers';
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
//$this->registerJSFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js");
//$this->registerJSFile("https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js");
$this->registerJS($script);
?>
