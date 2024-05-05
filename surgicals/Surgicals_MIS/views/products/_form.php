<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="products-form">
        <div class="row">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="col-md-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'cat_id')->dropDownList($categoryList, ['prompt' => 'Select One'])->label('Category') ?>
            </div>
            <div class="col-md-1"><i class="fa fa-plus text-success add_btn" id="add_category"></i></div>
            <div class="col-md-3">
                <?= $form->field($model, 'brand_id')->dropDownList($brandList, ['prompt' => 'Select One'])->label('Brand') ?>
            </div>
            <div class="col-md-1"><i class="fa fa-plus text-success add_btn" id="add_brand"></i></div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'short_description')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'is_featured')->dropDownList([0 => 'No', 1 => 'Yes'])->label('Is Featured ?') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'media_id')->fileInput(['id' => 'media_id'])->label('Product Card Image') ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($model, 'long_description')->widget(\yii2jodit\JoditWidget::className(), [
                    'settings' => [
                        'height' => '300px',
                        'enableDragAndDropFileToEditor' => new \yii\web\JsExpression("true"),
                    ],
                ]); ?>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'add_btn']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
<?php
$this->registerCss('
.add_btn {
    font-size: 25px;
    line-height: 90px;
    margin: 0 -20px;
    cursor: pointer;
}
');
$script = <<<JS

// $(document).on('submit', 'form', function (event) {
//     event.preventDefault();
//     var form = $(this);
//     var btn = $('#'+ $(this).find("button[type=submit]:focus").attr('id'));
//     var btn_value = btn.text();
//     event.stopImmediatePropagation();
//     if ( form.data('requestRunning') ) {
//         return false;
//     }
//     form.data('requestRunning', true);
//     var url = form.attr('action');
//     var method = form.attr('method');
//     var formData = new FormData(this);
//     $.ajax({
//         url: url,
//         type: method,
//         enctype: 'multipart/form-data',
//         data: formData,
//         processData: false,
//         contentType: false,
//         beforeSend: function () {
//             btn.attr('disabled', true);
//             btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
//         },
//         success: function (response) {
//             btn.attr('disabled', false);
//             btn.html(btn_value);
//             if (response.status == 200) {
//                 // toastr.success(response.message, response.title);
//                 // window.location.replace('/raw-database');
//                 // $.pjax.reload({container:'#active-questionnaire' , async : false});
//             } else {
//                 // toastr.error(response.message, response.title);
//             }
//         },
//         complete: function() {
//             // form.data('requestRunning', false);
//             // btn.attr('disabled', false);
//             // btn.html(btn_value);
//         }
//     }).fail(function(data, textStatus, xhr) {
//          // toastr.error('Invalid URL', 'Error: '+data.responseJSON.message);
//          // btn.attr('disabled', false);
//          // btn.html(btn_value);
//     });
// });

$(document).on('click', '#add_category', function(e) {
    e.preventDefault();
    var cat_name = prompt("Please enter category name:", "");
    if (cat_name != null || cat_name != "") {
        $.ajax({
            url: '/products/add-category',
            method: 'POST',
            data: {cat_name:cat_name},
            success: function (response) {
                if (response == 200) {
                    window.location.reload();
                } else if(response == 302) {
                    alert('Already Exist');
                } else {
                    alert('not updated');
                }
            },
        });
    }
});

$(document).on('click', '#add_brand', function(e) {
    e.preventDefault();
    var brand_name = prompt("Please enter brand name:", "");
    if (brand_name != null || brand_name != "") {
        $.ajax({
            url: '/products/add-brand',
            method: 'POST',
            data: {brand_name:brand_name},
            success: function (response) {
                if (response == 200) {
                    window.location.reload();
                } else if(response == 302) {
                    alert('Already Exist');
                } else {
                    alert('not updated');
                }
            },
        });
    }
});
JS;
$this->registerJs($script);