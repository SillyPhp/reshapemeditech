<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use dosamigos\fileupload\FileUploadUI;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = 'Update Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <?php
    Pjax::begin([
        'id' => 'product-detail-container',
    ]);
    ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <h1><?= Html::encode($model->name) ?></h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-4"><b>Brand</b></div>
            <div class="col-md-8">
                            <span data-url='/products/xeditable' class='x-edit-brand' data-pk='<?= $model->enc_id ?>'
                                  data-name='brand_id' data-type='select'
                                  data-value='<?= $model->brand_id ?>'></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <b>Variants</b>
                <i class="fa fa-plus" id="add-variant" data-id="<?= $model->enc_id ?>"></i>
            </div>
            <?php
            if ($variants) {
                foreach ($variants as $key => $variant) {
                    ?>
                    <div class="col-md-3">
                    <span data-url='/products/xedit-variant' class='x-edit' data-pk='<?= $key ?>'
                          data-name='variant_id' data-type='text'
                          data-value='<?= $variant ?>'></span>
                        <?php
                        $specifications = \app\models\Specifications::findAll(['cat_id' => $model->cat_id]);
                        foreach ($specifications as $specification) {
                            $value = \app\models\SpecificationVariantValues::findOne(['variant_id' => $key, 'specification_id' => $specification->enc_id]);
                            if ($specification->has_variant == 1) {
                                ?>
                                <div class="col-md-5 <?= ($specification->has_variant) ? 'text-success' : '' ?>">
                                    <b><?= $specification->pool->name ?></b></div>
                                <div class="col-md-7">
                                    <span data-url='/products/xedit-variant-values' class='x-edit'
                                                   data-pk='<?= $key ?>'
                                                   data-name='<?= $specification->enc_id ?>' data-type='text'
                                                   data-value='<?= ($value) ? $value->pool->name : "" ?>'></span>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <b>Colours</b>
                <i class="fa fa-plus" id="add-color" data-id="<?= $model->enc_id ?>"></i>
            </div>
            <?php
            if ($colours) {
                foreach ($colours as $key => $colour) {
                    ?>
                    <div class="col-md-2">
                    <span data-url='/products/xedit-color' class='x-edit' data-pk='<?= $key ?>'
                          data-name='colour_id' data-type='text'
                          data-value='<?= $colour ?>'></span>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <?php
    if ($colours) {
        ?>
        <div class="row">
            <?php
            if ($variants) {
                ?>
                <div class="col-md-12">
                    <h3 class="text-center">Product Stock</h3>
                </div>
                <?php
                foreach ($variants as $v_id => $v) {
                    ?>
                    <div class="col-md-12">
                        <h4 class="text-center text-primary"><strong><?= $v ?></strong></h4>
                        <?php
                        foreach ($colours as $c_id => $value) {
                            $stockObj = \app\models\Stocks::findOne(['colour_id' => $c_id, 'variant_id' => $v_id]);
                            $qty = $price = $salePrice = $stock_id = "";
                            if ($stockObj) {
                                $stock_id = $stockObj->enc_id;
                                $qty = $stockObj->qty;
                                $price = $stockObj->price;
                                $salePrice = $stockObj->sale_price;
                            }
                            ?>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <b class="text-danger"><?= $value ?></b>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <b>Quanitity</b>
                                </div>
                                <div class="col-md-6">
                                    <span
                                            data-url='/products/xedit-stock'
                                            class='x-edit-stock'
                                            data-color='<?= $c_id ?>'
                                            data-variant='<?= $v_id ?>'
                                            data-pk='<?= $stock_id ?>'
                                            data-name='qty' data-type='text'
                                            data-value='<?= $qty ?>'
                                    >
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <b>Price</b>
                                </div>
                                <div class="col-md-6">
                                    <span data-url='/products/xedit-stock' class='x-edit-stock'
                                          data-color='<?= $c_id ?>'
                                          data-variant='<?= $v_id ?>'
                                          data-pk='<?= $stock_id ?>'
                                          data-name='price' data-type='text'
                                          data-value='<?= $price ?>'></span>
                                </div>
                                <div class="col-md-6">
                                    <b>Sale Price</b>
                                </div>
                                <div class="col-md-6">
                                    <span data-url='/products/xedit-stock' class='x-edit-stock'
                                          data-color='<?= $c_id ?>'
                                          data-variant='<?= $v_id ?>'
                                          data-pk='<?= $stock_id ?>'
                                          data-name='sale_price' data-type='text'
                                          data-value='<?= $salePrice ?>'></span>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Add Images</h3>
            </div>
            <?php
            foreach ($colours as $color_id => $colour) {
                ?>
                <div class="col-md-6">
                    <div class="col-md-12">
                        <b>Images for <?= $colour ?> </b>
                    </div>

                    <div class="col-md-12">
                        <?php
                        $path = Yii::$app->params->upload_directories->product->image . $model->enc_id . '/';
                        $images = \app\models\ProductImages::findAll(['product_id' => $model->enc_id, 'colour_id' => $color_id]);
                        if ($images) {
                            foreach ($images as $img) {
                                echo '<div class="col-md-2"><img src="' . $path . $img->mediaFile->enc_name . '" width="auto" height="70px"></div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'image-upload-form',
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]);
                        ?>
                        <?= $form->field($model, 'media_id[]')->fileInput(['data-id' => $model->enc_id, 'onchange' => 'imageUpload(this)', 'id' => $colour, 'multiple' => true])->label(false); ?>
                        <?= $form->field($model, 'id')->hiddenInput(['value' => $color_id])->label(false); ?>
                        <?php
                        ActiveForm::end();
                        ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
    <div class="row">
        <?php
        $groups = \app\models\DetailGroups::findAll(['cat_id' => $model->cat_id]);
        foreach ($groups as $group) {
            ?>
            <div class="col-md-6">
                <h3 class="text-center"><?= $group->pool->name ?></h3>
                <?php
                $specifications = \app\models\Specifications::findAll(['detail_group_id' => $group->enc_id, 'cat_id' => $model->cat_id]);
                foreach ($specifications as $specification) {
                    $value = \app\models\SpecificationValues::findOne(['product_id' => $model->enc_id, 'specification_id' => $specification->enc_id]);
                    if ($specification->has_variant != 1) {
                        ?>
                        <div class="col-md-5 <?= ($specification->has_variant) ? 'text-success' : '' ?>">
                            <b><?= $specification->pool->name ?></b></div>
                        <div class="col-md-7">
                            <?php
                            if (isset($value->is_highlighted)) {
                            if ($value->is_highlighted) {
                            ?>
                            <i style="font-size: 15px; padding: 5px;" class="fa fa-file-text text-success is_highlight"
                               data-key="<?= $value->enc_id ?>">
                                <?php
                                } else {
                                ?>
                                <i style="font-size: 10px; padding: 5px;"
                                   class="fa fa-file-text text-default is_highlight"
                                   data-key="<?= $value->enc_id ?>">
                                    <?php
                                    }
                                    }
                                    ?>
                                </i> <span data-url='/products/xedit' class='x-edit' data-pk='<?= $model->enc_id ?>'
                                           data-name='<?= $specification->enc_id ?>' data-type='text'
                                           data-value='<?= ($value) ? $value->pool->name : "" ?>'></span>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    $this->registerJs("
         $('.x-edit-stock').editable({
            placement: 'top',
            validate: function(value) {
                if ($.isNumeric(value) == '') {
                    return 'Only numbers are allowed';
                }
                if ($.trim(value) == '') {
                    return 'This field is required';
                }
            },
            params:function(params){
                params.color_id = $(this).attr('data-color');
                params.variant_id = $(this).attr('data-variant');
                return params;
            },
            showbuttons: false,
            success: function (response) {}
        });
        
         $('.x-edit').editable({
            placement: 'top',
            showbuttons: false,
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'This field is required';
                }
            },
            success: function (response) {}
        });
        
        $('.x-edit-brand').editable({
            placement: 'top',
            source: '$brandList',
            showbuttons: false,
            validate: function (value) {
                if ($.trim(value) == '') {
                    return 'This field is required';
                }
            },
            success: function (response) {}
        });
    ");
    Pjax::end();
    ?>
</div>
<?php
$this->registerCss('
#add-color{
    font-size: 15px;
    color: lightgreen;
    margin: 0 5px;
    cursor: pointer;
}
#add-variant{
    font-size: 15px;
    color: green;
    margin: 0 5px;
    cursor: pointer;
}
#add-image{
    font-size: 15px;
    color: blue;
    margin: 0 5px;
    cursor: pointer;
}
.is_highlight{
    cursor: pointer;
}
');
$script = <<<JS
$(document).on('click', '.is_highlight', function(e) {
    e.preventDefault();
    var btn = $(this);
    var id = $(this).attr('data-key');
    $.ajax({
        url: '/products/change-highlight',
        method: 'POST',
        data: {id:id},
        beforeSend: function () {
            btn.attr('disabled', true);
            btn.attr('class','fa fa-refresh fa-spin');
        },
        success: function (response) {
            if (response) {
                $.pjax.reload({container:'#product-detail-container' , async : false});
            } else {
                alert('not updated');
            }
        },
        complete: function() {
            btn.attr('disabled', false);
        }
    });
});

$(document).on('click', '#add-color', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    // var data = '<span data-url="/products/xedit" class="x-edit editable editable-click editable-empty" data-pk="8K2wp-lWtC" data-name="S1MeEjpvZT" data-type="text" data-value="">Empty</span>';
    // var data = '<input type="text" id=>';
    var color = prompt("Please enter colour name:", "");
    if (color != null || color != "") {
        $.ajax({
            url: '/products/add-colour',
            method: 'POST',
            data: {id:id,color:color},
            success: function (response) {
                if (response) {
                    window.location.reload();
                    // window.location.replace('/raw-database');
                    // $.pjax.reload({container:'#active-questionnaire' , async : false});
                } else {
                    alert('not updated');
                    // btn.attr('disabled', false);
                    // btn.html(btn_value);
                    // toastr.error(response.message, response.title);
                }
            },
            complete: function() {
                // form.data('requestRunning', false);
                // btn.attr('disabled', false);
                // btn.html(btn_value);
            }
        });
    }
    // $('#color_section').append(data);
});

$(document).on('click', '#add-variant', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    // var data = '<span data-url="/products/xedit" class="x-edit editable editable-click editable-empty" data-pk="8K2wp-lWtC" data-name="S1MeEjpvZT" data-type="text" data-value="">Empty</span>';
    // var data = '<input type="text" id=>';
    var variant = prompt("Please enter variant name:", "");
    if (variant != null || variant != "") {
        $.ajax({
            url: '/products/add-variant',
            method: 'POST',
            data: {id:id,variant:variant},
            success: function (response) {
                if (response) {
                    window.location.reload();
                    // window.location.replace('/raw-database');
                    // $.pjax.reload({container:'#active-questionnaire' , async : false});
                } else {
                    alert('not updated');
                    // btn.attr('disabled', false);
                    // btn.html(btn_value);
                    // toastr.error(response.message, response.title);
                }
            },
            complete: function() {
                // form.data('requestRunning', false);
                // btn.attr('disabled', false);
                // btn.html(btn_value);
            }
        });
    }
    // $('#color_section').append(data);
});


//$(document).on('submit', '#image-upload-form', function (event) {
//    event.preventDefault();
//    var form = $(this);
//    var btn = $('#'+ $(this).find("button[type=submit]:focus").attr('id'));
//    var btn_value = btn.text();
//    event.stopImmediatePropagation();
//    if ( form.data('requestRunning') ) {
//        return false;
//    }
//    form.data('requestRunning', true);
//    var url = form.attr('action');
//    var data = form.serialize();
//    var method = form.attr('method');
//    var formData = new FormData(this);
//    $.ajax({
//        url: url,
//        type: method,
//        enctype: 'multipart/form-data',
//        data: formData,
//        processData: false,
//        contentType: false,
//        beforeSend: function () {
//            btn.attr('disabled', true);
//            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
//        },
//        success: function (response) {
//            if (response.status == 200) {
//                btn.attr('disabled', false);
//                btn.html(btn_value);
//                // $('#modal').modal('toggle');
//                toastr.success(response.message, response.title);
//                window.location.replace('/raw-database');
//                // $.pjax.reload({container:'#active-questionnaire' , async : false});
//            } else {
//                btn.attr('disabled', false);
//                btn.html(btn_value);
//                toastr.error(response.message, response.title);
//            }
//        },
//        complete: function() {
//            form.data('requestRunning', false);
//            btn.attr('disabled', false);
//            btn.html(btn_value);
//        }
//    }).fail(function(data, textStatus, xhr) {
//         toastr.error('Invalid URL', 'Error: '+data.responseJSON.message);
//         btn.attr('disabled', false);
//         btn.html(btn_value);
//    });
//});
JS;
$this->registerJs($script);
?>
<script>
    function imageUpload(input) {
        var form = input.closest('form');
        form.submit();
    }
</script>
