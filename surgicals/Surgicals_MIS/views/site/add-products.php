<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Add Product';
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
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
                <li><span><?= 'Add Product' ?></span></li>
                <li><span><?= $this->title ?></span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="service-create container-fluid">
        <div class="service-form">
            <?php $form = ActiveForm::begin(['id' => 'add-product']); ?>
            <div class="row">
                <div class="col-md-4">
                    <label>Product Name</label>
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-md-4">
                    <label>Category</label>
                    <?= $form->field($model, 'category')->dropDownList($categories,['prompt' => 'Select Category'])->label(false) ?>
                </div>
                <div class="col-md-4">
                    <label>Tax Present in %</label>
                    <?= $form->field($model, 'tax_present')->textInput(['autocomplete' => 'off', 'min' => 0, 'max' => 100, 'type' => 'number'])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Short Description</label>
                    <?= $form->field($model, 'short_desc')->textArea(['rows' => 4, 'cols' => 5, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Short Description'])->label(false); ?>
                </div>
            </div>
            <hr>
            <div class="col-md-12">
                <label class="f18">Product Combination 1</label>
            </div>
            <div class="row productCombinations">
                <div class="col-md-12 combinationDiv">
                    <div class="col-md-4">
                        <label>Title</label>
                        <?= $form->field($model, 'product_combination_titles[]')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4">
                        <label>Purchase Price</label>
                        <?= $form->field($model, 'product_combination_purchase_price[]')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4">
                        <label>Sell Price</label>
                        <?= $form->field($model, 'product_combination_sell_price[]')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="tleft add-multi-btn">
                <button class="btn-md btn btn-primary" id="add-variation-btn">+ Create New Combination</button>
            </div>
            <div class="col-md-12">
                <div class="form-group tcenter">
                    <?= Html::submitButton('Save', ['id' =>'services_btn','class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</section>
<?php
$this->registerCss('
.f18{
font-size:18px;
}
.text-right
{
float: right;
}
.combinationDiv{
border-style: solid;
margin-bottom: 30px;
}
.cPointer{
cursor:pointer;
}
.cRed{
color:red;
}
.tleft{
text-align:left;
}
.fright{
float:right;
}
.add-multi-btn{
padding-bottom : 15px;
}
.tcenter{
text-align:center;
}
.feature_label .variation_label{
    padding: 6px;
    text-align: center;
    font-size: 23px;
}
.cross {
    float: right;
    padding: 7px 10px;
    font-size: 20px;
    color: red;
    cursor: pointer;
}
');
$script = <<<JS
$(document).on('click','.removeFeature',function(e){
    e.preventDefault();
    var btn = $(this);
    btn.parent().next('div').remove();
    btn.parent().remove();
});
var clone_data = $('.productCombinations').html();
var i = 1;
$(document).on("click", "#add-variation-btn", function(e){
    e.preventDefault();
    i = i+1;
    $('.productCombinations').append('<div class="col-md-12"><label class="f18">Product Combination '+ i +'</label><span class="text-right fa fa-times cRed cPointer removeFeature"></span></div>');
    $('.productCombinations').append(clone_data);
});
$(document).on('submit','#add-product',function (e){
    e.preventDefault();
    var form = $(this);
    var btn = $('#services_btn');
    var btn_value = btn.text();
    e.stopImmediatePropagation();
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
                // window.location.href = '/site/our-team';
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
$this->registerJs($script);
