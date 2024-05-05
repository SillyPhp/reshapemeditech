<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Brands */

$this->title = 'Edit Client Review';
$this->params['breadcrumbs'][] = ['label' => 'Review', 'url' => ['index']];
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
                    <li><span><?= 'Client Says' ?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="blogs-create container-fluid">
            <div class="review-form">
                <?php $form = ActiveForm::begin(['id' => 'edit-review']); ?>
                <div class="row">
                    <div class="col-md-6">
                        <label>Client Name</label>
                        <?= $form->field($model, 'client_name')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'image')->fileInput(['id' => 'logoUpload','autocomplete' => 'off']); ?>
                        <?= $form->field($model, 'base64image')->hiddenInput(['value' => '', 'autocomplete' => 'off'])->label(false); ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                        $img = Yii::$app->params->upload_directories->client->image .$id.'/'. $client_image;
                        ?>
                        <img src="<?= $img?>" width="100px" height="100px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Designation</label>
                        <?= $form->field($model, 'designation')->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <div class="col-md-8">
                        <label>Comment</label>
                        <?= $form->field($model, 'comment')->textArea(['id'=>"textarea",'rows' => 4, 'cols' => 5, 'class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Comment'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group tcenter">
                        <?= Html::submitButton('Update', ['id' =>'review_btn','class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </section>

<?php
echo $this->render('/widgets/croppie-modal');
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
    });
});
$(document).on('submit','#edit-review',function (event){
    event.preventDefault();
    var form = $(this);
    var btn = $('#review_btn');
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
                window.location.href = '/site/reviews';
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
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css');
