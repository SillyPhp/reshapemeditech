<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Add Category';
?>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Category</h2>
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Add Category</span></li>
                </ol>

                <!--            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>-->
            </div>
        </header>

        <!-- start: page -->
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>

                        <h2 class="panel-title">Category Add Form</h2>

                        <p class="panel-subtitle">
                            This is form with parent/child stage categories.
                        </p>
                    </header>
                    <div class="panel-body">
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'add-category-form',
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]);
                        ?>
                        <div class="row">
                            <div class="col-sm-5">
                                <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']); ?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($model, 'parent_id')->dropDownList($parentList, ['id' => 'parent-list','prompt' => 'Select One'])->label('Select Parent'); ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'image')->fileInput(['minWidth' => 250, 'maxWidth' => 250, 'minHeight' => 250, 'maxHeight' => 250, 'class' => 'fileUpload']); ?>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <?= Html::submitButton('Submit Form', ['class' => 'btn btn-success', 'id' => 'sbtBtn']); ?>
                    </footer>
                    <?php ActiveForm::end(); ?>
                </section>
            </div>
        </div>
        <!-- end: page -->
    </section>

<?php
$this->registerCss('
#camera-section div, #variants-section div {
    background: #fff8f8;
}
#fast_charge_section{
    display:none;
}
input#colors_tag, input#warranty_benefits_tag, input#sensors_tag, input#camera_features_tag {
    width: 200px;
    border: 1px solid #eee;
}
');

$script = <<<JS
$(document).on('submit', '#add-category-form', function (event) {
    event.preventDefault();
    var form = $(this);
    var btn = $('#sbtBtn');
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
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            btn.attr('disabled', false);
            btn.html(btn_value);
            if (response.status == 200) {
                alert('Added Successfully..');
                // toastr.success(response.message, response.title);
                window.location.reload();
            } else {
                alert('Added Successfully..');
                // toastr.error(response.message, response.title);
            }
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    }).fail(function(data, textStatus, xhr) {
         // toastr.error('Invalid URL', 'Error: '+data.responseJSON.message);
         alert(data.responseJSON.message);
         btn.attr('disabled', false);
         btn.html(btn_value);
    });
});

//$(document).on('change', '#has_dual_sim', function(e) {
//    e.preventDefault();
//    var data;
//    var value = $(this).val();
//    if(value == 1){
//        data = '<div class="col-sm-2"><div class="form-group field-sim1_type"> <label class="control-label" for="sim1_type">Sim1 Type</label> <select id="sim1_type" class="form-control" name="sim1_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim1_size"> <label class="control-label" for="sim1_size">Sim1 Size</label> <select id="sim1_size" class="form-control" name="sim1_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim2_type"> <label class="control-label" for="sim2_type">Sim2 Type</label> <select id="sim2_type" class="form-control" name="sim2_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim2_size"> <label class="control-label" for="sim2_size">Sim2 Size</label> <select id="sim2_size" class="form-control" name="sim2_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div>';
//    } else {
//        data = '<div class="col-sm-2"><div class="form-group field-sim1_type"> <label class="control-label" for="sim1_type">Sim1 Type</label> <select id="sim1_type" class="form-control" name="sim1_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim1_size"> <label class="control-label" for="sim1_size">Sim1 Size</label> <select id="sim1_size" class="form-control" name="sim1_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div>';
//    }
//    $('#dual_sim_option').html(data);
//});
//
//$(document).on('click', '#add_camera', function(e) {
//    e.preventDefault();
//    var data = '<div id="camera-section"><div class="camera-details"><div class="col-md-12"><div class="col-sm-3"><div class="form-group field-camera_type required"> <label class="control-label" for="camera_type">Camera Type</label> <select id="camera_type" class="form-control" name="camera_type[]"><option value="">Select One</option><option value="1">Rear</option><option value="2">Front</option><option value="3">Side</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-camera_size required"> <label class="control-label" for="camera_size">Camera Size</label> <input type="number" id="camera_size" class="form-control" name="camera_size[]" autocomplete="off" placeholder="mega pixels / Multiple"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-camera_angle required"> <label class="control-label" for="camera_angle">Camera Angle</label> <select id="camera_angle" class="form-control" name="camera_angle[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="Main">Main</option><option value="Wide Angle">Wide Angle</option><option value="Telephoto">Telephoto</option><option value="Macro">Macro</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-aperture"> <label class="control-label" for="aperture">Camera Aperture</label> <input type="number" step="0.1" id="aperture" class="form-control" name="aperture[]" autocomplete="off" placeholder="Float value like f/2.1"><p class="help-block help-block-error"></p></div></div></div><div class="col-md-12"><div class="col-sm-3"><div class="form-group field-autofocus required"> <label class="control-label" for="autofocus">Autofocus</label> <select id="autofocus" class="form-control" name="autofocus[]"><option value="0">No</option><option value="1" selected="">Yes</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-recording_quality required"> <label class="control-label" for="recording_quality">Recording Quality</label> <select id="recording_quality" class="form-control" name="recording_quality[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="720">720p HD</option><option value="1080">1080p FHD</option><option value="2160">2160p 4k</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-fps required"> <label class="control-label" for="fps">Frame per second</label> <select id="fps" class="form-control" name="fps[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="30">30fps</option><option value="60">60fps</option><option value="90">90fps</option><option value="120">120fps</option> </select><p class="help-block help-block-error"></p></div></div></div></div></div>';
//    $('#camera-section').append(data);
//});
//
//$(document).on('click', '#add_variant', function(e) {
//    e.preventDefault();
//    var data = '<div class="variant-details"><div class="col-sm-3"><div class="form-group field-memory_ram required"> <label class="control-label" for="memory_ram">RAM</label> <input type="number" id="memory_ram" class="form-control" name="memory_ram[]" autocomplete="off" placeholder="value as GB"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-memory_rom required"> <label class="control-label" for="memory_rom">Storage</label> <input type="number" id="memory_rom" class="form-control" name="memory_rom[]" autocomplete="off" placeholder="value as GB"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-price required"> <label class="control-label" for="price">Price</label> <input type="number" id="price" class="form-control" name="price[]" autocomplete="off" placeholder="Float value"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-sale_price required"> <label class="control-label" for="sale_price">Sale Price</label> <input type="number" id="sale_price" class="form-control" name="sale_price[]" autocomplete="off" placeholder="Float Value"><p class="help-block help-block-error"></p></div></div></div>';
//    $('#variants-section').append(data);
//});
//
//$(document).on('change', '#has_fast_charge', function(e) {
//    e.preventDefault();
//    var value = $(this).val();
//    var tar = $('#fast_charge_section');
//    if(value == 1){
//        tar.fadeIn();
//    } else {
//        tar.fadeOut();
//        $('#charge_type').val("");
//    }
//});
//function getImages() {
//    var result = [];
//    $('.colorsList').each(function() {
//        if($(this).children('input').val() != ""){
//            var data = {};
//            data['color'] = $(this).children('input').attr('name');
//            data['image'] = $(this).children('input').val();
//            result.push(data);
//        }
//    });
//    return result;
//};
//
//function imageOptions(){
//    var val = $('#colors').val();
//    var val_arr = val.split(',');
//    $('.imageByColors').html("");
//    for(var i=0;i<val_arr.length;i++){
//        var template = '<div class="col-md-3 colorsList"><label>Images for '+ val_arr[i] + ' color</label><input type="file" name="'+val_arr[i]+'"/></div>';
//        $('.imageByColors').append(template);
//    }
//}
//$('#colors').tagsInput({
//   'height':'auto',
//   'width':'100%',
//   'interactive':true,
//   'defaultText':'Color Here',
//   'onAddTag':imageOptions,
//   'onRemoveTag':imageOptions,
//   // 'onChange' : callback_function,
//   'removeWithBackspace' : false,
//});
JS;
$this->registerJs($script);
