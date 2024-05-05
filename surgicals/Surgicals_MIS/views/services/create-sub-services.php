<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Create Sub Service';
$this->params['breadcrumbs'][] = ['label' => 'Blogs', 'url' => ['index']];
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
                    <li><span><?= 'Sub Services' ?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <div class="service-create container-fluid">
            <h1 class="service_title"><?= $service->name ?></h1>
            <div class="service-form">
                <?php $form = ActiveForm::begin(['id' => 'create-sub-services']); ?>
                <div class="row">
                    <div class="col-md-4">
                        <label>Service Name</label>
                        <?= $form->field($model, 'service_name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4">
                        <label>Short Description</label>
                        <?= $form->field($model, 'short_desc')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'image')->fileInput(['id' => 'logoUpload', 'autocomplete' => 'off']); ?>
                        <?= $form->field($model, 'base64image')->hiddenInput(['value' => '', 'autocomplete' => 'off'])->label(false); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textArea(['id' => "textarea", 'rows' => 4, 'cols' => 5, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Description'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group tcenter">
                        <?= Html::submitButton('Save', ['id' => 'services_btn', 'class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

<?php
echo $this->render('/widgets/croppie-modal');
$this->registerCss('
.service_title{
    text-align: center;
}
.tcenter{
text-align:center;
}
');
$script = <<<JS
$("#logoUpload").change(function() {
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#cropImagePop").modal("show");
            var rawImg = e.target.result;
            setTimeout(function() {
                renderCrop(rawImg);
            }, 500);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
var el = document.getElementById("demo");
var vanilla = new Croppie(el, {
    viewport: { width: 200, height: 200 },
    boundary: { width: 300, height: 300 },
    enforceBoundary: false,
    showZoomer: true,
    enableZoom: true,
    // enableExif: true,
    mouseWheelZoom: true,
    maxZoomedCropWidth: 10,
    // enableOrientation: true
});
function renderCrop(img){
    vanilla.bind({
        url: img,
        points: [20,20,20,20]
        // orientation: 4
    });
}

document.querySelector(".vanilla-result").addEventListener("click", function (ev) {
    vanilla.result({
        type: "base64",
        // format:"jpeg",
    }).then(function (data) {
        $("#page-loading").fadeOut(1000);
        $("#cropImagePop").modal("hide");
        $('#base64image').val(data);
        uploadImage();
    });
});
var uid = '';
var enc_image = '';
function uploadImage(){
    var image = $('#logoUpload')[0].files[0];
    var baseImage = $('#base64image').val();
    var formData = new FormData();
    formData.append("image", image);
    formData.append("baseImage", baseImage);
    $.ajax({
        url: '/services/upload-image',
        type: 'POST',
        enctype: 'multipart/form-data',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.status == 200){
                uid = response.uid;
                enc_image = response.enc_image;
            } else {
                toastr.error(response.message, response.title);
            }
        },
    });
}
$(document).on('submit','#create-sub-services',function (event){
    event.preventDefault();
    var form = $(this);
    var btn = $('#services_btn');
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    form.data('requestRunning', true);
    var url = form.attr('action');
    var method = form.attr('method');
    var formData = new FormData(this);
    if(uid){
        formData.append('uid',uid);
    }
    if(enc_image){
        formData.append('enc_image',enc_image);
    }
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
                window.location.href = '/services/sub-services?id=$id';
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
new Jodit('#textarea', {
    height: 400,
    sizeLG: 900,
    sizeMD: 700,
    sizeSM: 400,
     buttons: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsMD: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsSM: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    buttonsXS: [
        'source', '|',
        'bold',
        'italic', '|',
        'ul',
        'ol', '|',
        'font',
        'fontsize',
        'paragraph', '|',
        'left',
        'center',
        'right',
        'justify', '|',
        'undo', 'redo', '|',
        'hr',
        'eraser'
    ],
    
});
JS;
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/jodit/3.1.92/jodit.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/jodit/3.1.92/jodit.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJS($script);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css');
