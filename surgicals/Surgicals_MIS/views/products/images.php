<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = "Add Images";
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
                    <li><span><?= 'Products' ?></span></li>
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <?php
        $form = ActiveForm::begin([
            'id' => 'add-product-images-form',
            'options' => [
                'class' => 'clearfix',
                'enctype' => 'multipart/form-data'
            ],
            'fieldConfig' => [
                'template' => '<div class="form-group">{input}{error}</div>',
                'labelOptions' => ['class' => ''],
            ],
        ]);
        ?>
        <div class="row">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <?= $form->field($model, 'image')->fileInput(['id' => 'logoUpload', 'autocomplete' => 'off']); ?>
<!--                        --><?//= $form->field($model, 'base64image')->hiddenInput(['value' => '', 'autocomplete' => 'off'])->label(false); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'is_cover_image')->checkbox(['label' => 'Is Cover Image', 'uncheck' => null]); ?>
                    </div>
                    <div class="col-md-4">
                        <?= Html::submitButton('Add', ['class' => 'btn btn-info', 'id' => 'add_product_images_btn']); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
        <?php
        Pjax::begin([
            'id' => 'products-images',
        ]);
        ?>
        <div class="row">
            <div class="container-fluid">
                <label class="head-txt text-semibold f20">Images</label>
                <div class="col-md-12">
                    <div class="main-image">
                        <?php
                        if ($images) {
                            $base_path = Yii::$app->params->upload_directories->product->image . $id;
                            foreach ($images as $image) {
                                ?>
                                <div class="all-ims">
                                    <div class="overlay-more">
                                        <a href="javascript:;" class="dlt_image" data-key="<?= $image['_uid'] ?>">
                                        <i class="fa fa-trash trr"></i>
                                        </a>
                                        <a href="javascript:;" class="edit_image" data-key="<?= $image['_uid'] ?>">
                                        <i class="fa fa-edit edd"></i>
                                        </a>
                                    </div>
                                    <img src="<?= $base_path . '/' . $image['file_enc_name'] ?>">
                                </div>
                                <?php
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">
                <label class="text-semibold f20 head-txt">Cover Images</label>
                <div class="col-md-12">
                    <div class="main-image">
                    <?php
                    if ($cover_images) {
                        $base_path = Yii::$app->params->upload_directories->product->image . $id;
                        foreach ($cover_images as $image) {
                            ?>
                            <div class="all-ims">
                                <div class="overlay-more">
                                    <a href="javascript:;" class="dlt_image" data-key="<?= $image['_uid'] ?>">
                                    <i class="fa fa-trash trr"></i>
                                    </a>
                                    <a href="javascript:;" class="edit_image" data-key="<?= $image['_uid'] ?>">
                                    <i class="fa fa-edit edd"></i>
                                    </a>
                                </div>
                                <img src="<?= $base_path . '/' . $image['file_enc_name'] ?>">
                            </div>
                            <?php
                        }
                    } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        Pjax::end();
        ?>
    </section>
<?php
echo $this->render('/widgets/croppie-modal');
$this->registerCss('
.head-txt {
    margin: 20px 0;
}
.f20{
font-size: 20px;
}
.p20{
padding:20px
}
.main-image {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
.all-ims {
    margin: 0 5px 5px 0;
    position:relative;
}
.all-ims img {
    width: 130px;
    height: 130px;
    object-fit: cover;
}
.overlay-more i {
    opacity: 0;
    position: absolute;
    top: 50%;
    color: #fff;
    font-size: 20px;
    transform: translate(-50%, -50%);
transition:all .4s;
}
.trr{left:35%;}
.edd{left:65%;}
.all-ims:hover .overlay-more i{
    opacity:1;
    }
.all-ims:hover .overlay-more{
  position: absolute;
  top: 0px;
  left: 0px;
  background-color: rgba(0,0,0,0.5);
  width: 100%;
  height: 100%;
transition:all .4s;
}
');
$script = <<<JS
$(document).on('click','.edit_image',function(e){
    e.preventDefault();
    var btn = $(this);
    var key = btn.attr('data-key');
    $.ajax({
        url: '/products/edit-image',
        type: "POST",
        data: {id:key},
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                $.pjax.reload({container:'#products-images' , async : false});
            } else {
                toastr.error(response.message, response.title);
            }
        },
        complete: function() {
        }
    });
    
})
$(document).on('click','.dlt_image',function(e){
    e.preventDefault();
    var btn = $(this);
    if(confirm("Are you sure delete this image?")){
    var key = btn.attr('data-key');
    $.ajax({
        url: '/products/delete-image',
        type: "POST",
        data: {id:key},
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                $.pjax.reload({container:'#products-images' , async : false});
            } else {
                toastr.error(response.message, response.title);
            }
        },
        complete: function() {
        }
    });
    }
})

$(document).on('submit', '#add-product-images-form', function (event) {
    event.preventDefault(); 
    var form = $(this);
    var btn = $('#'+ $(this).find("button[type=submit]:focus").attr('id'));
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( form.data('requestRunning') ) {
        return false;
    }
    // form.data('requestRunning', true);
    
    
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
                location.reload();
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
