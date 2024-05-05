<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Update Blogs';
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
                <li><span><?= 'Blogs'?></span></li>
                <li><span><?= $this->title ?></span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>
    <div class="blogs-create container">
        <div class="blogs-form">
            <?php $form = ActiveForm::begin(['id' => 'update-blogs']); ?>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'blog_name')->textInput(['maxlength' => true])->label('Title') ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'image')->fileInput(['id' => 'logoUpload','autocomplete' => 'off']); ?>
                    <?= $form->field($model, 'base64image')->hiddenInput(['value' => '', 'autocomplete' => 'off'])->label(false); ?>
                </div>
                <div class="col-md-2">
                    <?php
                    $img = Yii::$app->params->upload_directories->blog->image .$id.'/'. $blog_image;
                    ?>
                    <img src="<?= $img?>" width="100px" height="100px">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <label>Short Description</label>
                    <?= $form->field($model, 'short_desc')->textArea(['maxlength' => true, 'rows' => 6])->label(false) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($model, 'description')->textArea(['id' => "textarea", 'rows' => 4, 'cols' => 5, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Description'])->label(false); ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group tcenter">
                    <?= Html::submitButton('Update', ['id' => 'blogs_btn', 'class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    </section>
    <div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                </div>
                <div class="modal-body">
                    <div id="demo"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary custom-buttons2 vanilla-result">Done</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
$this->registerCss('
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
    viewport: { width: 450, height: 300 },
    boundary: { width: 510, height: 330 },
    enforceBoundary: false,
    showZoomer: true,
    enableZoom: true,
    // enableExif: true,
    mouseWheelZoom: true,
    maxZoomedCropWidth: 10
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
    });
});
$(document).on('submit','#update-blogs',function (event){
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
                window.location.href = '/blogs';
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
