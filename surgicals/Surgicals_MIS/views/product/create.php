<?php

/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Add Product';
?>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Mobiles</h2>
            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="/">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Add Product</span></li>
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

                        <h2 class="panel-title">Mobile Add Form</h2>

                        <p class="panel-subtitle">
                            This is form with multiple block columns.
                        </p>
                    </header>
                    <div class="panel-body">
                        <?php
                        $form = ActiveForm::begin([
                            'id' => 'add-product-form',
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]);
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'model_name')->textInput(['autocomplete' => 'off'])->label('Product Name'); ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'brand_id')
                                    ->widget(\bootui\typeahead\Typeahead::className(), [
                                        'source' => ['Apple', 'Samsung', 'Oppo', 'Vivo', 'Nokia'],
                                        'limit' => 10,
                                        'scrollable' => true,
                                    ])->label('Brand') ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'model_number')->textInput(['autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <?= $form->field($model, 'release_date')->widget(yii\jui\DatePicker::className(), [
                                    'options' => [
                                        'class' => 'form-group',
                                    ],
                                    'clientOptions' => [
                                        'dateFormat' => 'dd/mm/yyyy'
                                    ],
                                ]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'colors')->textInput(['id' => 'colors', 'autocomplete' => 'off'])->label('Colors'); ?>
                            </div>
                            <div class="imageByColors"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_dual_sim')->dropDownList(['No', 'Yes'], ['value' => 1, 'id' => 'has_dual_sim'])->label('Dual Sim') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_dual_volte')->dropDownList(['No', 'Yes'], ['value' => 0])->label('Dual VoLTE') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_hybrid_sim_slot')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Hybrid Sim Slot') ?>
                            </div>
                            <div id="dual_sim_option">
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'sim1_type')->dropDownList(['GSM' => 'GSM', 'CDMA' => 'CDMA'])->label('Sim1 Type') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'sim1_size')->dropDownList(['Neno' => 'Neno', 'Micro' => 'Micro', 'Regular' => 'Regular'], ['prompt' => 'Select Size'])->label('Sim1 Size') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'sim2_type')->dropDownList(['GSM' => 'GSM', 'CDMA' => 'CDMA'])->label('Sim2 Type') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'sim2_size')->dropDownList(['Neno' => 'Neno', 'Micro' => 'Micro', 'Regular' => 'Regular'], ['prompt' => 'Select Size'])->label('Sim2 Size') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'card_slot_upto')->dropDownList([0 => 'No', 8 => '8GB', 16 => '16GB', 32 => '32GB', 64 => '64GB', 128 => '128GB', 256 => '256GB', 512 => '512GB', 1024 => '1TB', 2048 => '2TB'], ['prompt' => 'Select One']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Product Variants</h3>
                            <div id="variants-section">
                                <div class="variant-details">
                                    <div class="col-sm-3">
                                        <?= $form->field($model, 'memory_ram[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'value as GB'])->label('RAM') ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <?= $form->field($model, 'memory_rom[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'value as GB'])->label('Storage') ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <?= $form->field($model, 'price[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Float value']) ?>
                                    </div>
                                    <div class="col-sm-3">
                                        <?= $form->field($model, 'sale_price[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Float Value']) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" id="add_variant">Add Product Variant</button>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Design Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'dimension_height')->textInput(['type' => 'number', 'step' => '0.1', 'placeholder' => '163.8 x 75.8 x 9.4 mm', 'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'dimension_width')->textInput(['type' => 'number', 'step' => '0.1', 'placeholder' => '163.8 x 75.8 x 9.4 mm', 'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'dimension_depth')->textInput(['type' => 'number', 'step' => '0.1', 'placeholder' => '163.8 x 75.8 x 9.4 mm', 'autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'dimension_weight')->textInput(['type' => 'number', 'step' => '0.1', 'placeholder' => '120 gm', 'autocomplete' => 'off']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Display Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_type')->dropDownList($displayTypes, ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_touch')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Touch Screen') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_size')->textInput(['type' => 'number', 'step' => '0.1', 'placeholder' => '6.2 inches', 'autocomplete' => 'off'])->label('Display Size') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_resolution')->dropDownList(array_merge($displayResolutions, ['NULL' => 'Not Sure']), ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_ppi')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Numeric value'])->label('PPI') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_body_ratio')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Float value'])->label('Screen to Body Ratio') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_notch')->dropDownList(['No' => 'No', 'iPhone X Notch' => 'iPhone X Notch', 'Medium-sized Notch' => 'Medium-sized Notch', 'Water-Drop Notch' => 'Water-Drop Notch'], ['prompt' => 'Select One'])->label('Notch Screen') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_refresh_rate')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Numeric Value like (90Hz)'])->label('Refresh Rate') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'display_colors')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Numeric Value like (16M)']) ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Connectivity Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'gprs')->dropDownList(['No' => 'No', '2G' => '2G', '3G' => '3G', '4G' => '4G', '5G' => '5G', 'NULL' => 'Not Sure'], ['value' => '4G'])->label('GPRS Type') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_edge')->dropDownList(['No', 'Yes'], ['value' => 1])->label('EDGE') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_volte')->dropDownList(['No', 'Yes'], ['value' => 1])->label('VoLTE') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'wifi')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Wifi') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_wifi_tethering')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Wifi Tethring') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'bluetooth')->dropDownList([0 => 'No', '1.0' => '1.0v', '1.1' => '1.1v', '1.2' => '1.2v', '2.0' => '2.0v', '2.1' => '2.1v', '3.0' => '3.0v', '4.0' => '4.0v', '4.1' => '4.1v', '4.2' => '4.2v', '5.0' => '5.0v', '5.1' => '5.1v', '5.2' => '5.2v', 'NULL' => 'Not Sure'], ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_bluetooth_tethering')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Bluetooth Tethring') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'usb_type')->dropDownList(['NULL' => 'Not Sure', 'USB Type-A' => 'USB Type-A', 'USB Type-B' => 'USB Type-B', 'Mini-USB' => 'Mini-USB', 'Micro-USB' => 'Micro-USB', 'USB-C' => 'USB-C'], ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'usb_version')->dropDownList([0 => 'No', '1.0' => '1.0v', '2.0' => '2.0v', '3.0' => '3.0v', '3.1' => '3.1v', '3.2' => '3.2v', '4.0' => '4.0v', 'NULL' => 'Not Sure'], ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_usb_tethering')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Usb Tethring') ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Battery Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'battery_type')->dropDownList(['Removable' => 'Removable', 'Non-Removable' => 'Non-Removable'], ['prompt' => 'Select One'])->label('Battery Type') ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'battery_size')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => '3200mAh, 4000mAh']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'battery_quality')->dropDownList(['Li-Ion' => 'Li-Ion', 'Li-Po' => 'Li-Po'])->label('Battery Quality') ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'has_fast_charge')->dropDownList(['No', 'Yes'], ['prompt' => 'Select One', 'id' => 'has_fast_charge'])->label('Fast Charging') ?>
                            </div>
                            <div id="fast_charge_section">
                                <div class="col-sm-3">
                                    <?= $form->field($model, 'charge_type')->dropDownList($chargeTypesList, ['prompt' => 'Select One']) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">MultiMedia Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_email')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Email') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_music')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Music') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_video')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Video') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_fm')->dropDownList(['No', 'Yes'], ['value' => 1])->label('FM Radio') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_doc_reader')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Document Reader') ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Technical Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'operating_system')->dropDownList(['Android' => 'Android', 'IOS' => 'IOS', 'Windows' => 'Windows', 'BlackBerry' => 'BlackBerry', 'Symbian' => 'Symbian'], [
                                    'prompt' => 'Select One',
                                    'onchange' => '$.post("' . Yii::$app->urlManager->createUrl('/products/get-os-versions-list?type=') . '"+$(this).val(),function(data) {
                                            if(data != ""){
                                                $( "div#os_version_col" ).show();
                                                var html = [];
                                                html.push("<option value>Select One</option>");
                                                $.each(data,function(index,value)
                                                      {
                                                       html.push(\'<option value="\'+index+\'">\'+value+\'</option>\');
                                                     });
                                                $( "select#os_version" ).html(html);
                                            } else {
                                                $( "div#os_version_col" ).hide();
                                            }
                                        });'
                                ]) ?>
                            </div>
                            <div class="col-sm-3" id="os_version_col">
                                <?= $form->field($model, 'os_version')->dropDownList([], ['id' => 'os_version'])->label('OS Version') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'processor')->dropDownList($processors, ['prompt' => 'Select One'])->label('Processor') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'processor_type')->dropDownList(['NULL' => 'Not Sure', 'Single' => 'Single Core', 'Dual' => 'Dual Core', 'Quad' => 'Quad Core', 'Hexa' => 'Hexa Core', 'Octa' => 'Octa Core', 'Deca' => 'Deca Core'], ['prompt' => 'Select One'])->label('Processor Type') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'core_details')->textInput(['autocomplete' => 'off']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'cpu')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => '2.3GHz'])->label('CPU') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'gpu')
                                    ->widget(\bootui\typeahead\Typeahead::className(), [
                                        'source' => $gpuModels,
                                        'limit' => 10,
                                        'scrollable' => true,
                                    ])->label('GPU Model') ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'has_java')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Java') ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'has_browser')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Browser') ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($model, 'is_otg_compatible')->dropDownList(['No', 'Yes'], ['value' => 1])->label('OTG Compatible') ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Camera Details</h3>
                            <div id="camera-section">
                                <div class="camera-details">
                                    <div class="col-md-12">
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'camera_type[]')->dropDownList([1 => 'Rear', 2 => 'Front', 3 => 'Side'], ['prompt' => 'Select One'])->label('Camera Type') ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'camera_size[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'mega pixels / Multiple']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'camera_angle[]')->dropDownList(['NULL' => 'Not Sure', 'Main' => 'Main', 'Wide Angle' => 'Wide Angle', 'Ultra Wide' => 'Ultra Wide', 'Telephoto' => 'Telephoto', 'Macro' => 'Macro', 'Depth Sensor' => 'Depth Sensor'], ['prompt' => 'Select One']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'aperture[]')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Float value like f/2.1'])->label('Camera Aperture') ?>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'autofocus[]')->dropDownList(['No', 'Yes'], ['value' => 1]) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'recording_quality[]')->dropDownList(['NULL' => 'Not Sure', 720 => '720p HD', 1080 => '1080p FHD', 2160 => '2160p 4k'], ['prompt' => 'Select One']) ?>
                                        </div>
                                        <div class="col-sm-3">
                                            <?= $form->field($model, 'fps[]')->dropDownList(['NULL' => 'Not Sure', 30 => '30fps', 60 => '60fps', 90 => '90fps', 120 => '120fps'], ['prompt' => 'Select One'])->label('Frame per second') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" id="add_camera">Add Camera</button>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'camera_features')->widget(\faryshta\widgets\JqueryTagsInput::className(), [
                                    'clientOptions' => [
                                        'width' => '100%',
                                        'height' => 'auto',
                                        'defaultText' => 'Add Camera Feature',
                                        'removeWithBackspace' => false,
                                        'interactive' => true,
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Extra Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_gps')->dropDownList(['No', 'Yes'], ['value' => 1])->label('GPS') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'gps_mfg')->dropDownList(['NULL' => 'Not Sure', 'NavIC' => 'NavIC', 'Glonass' => 'Glonass', 'Beidou' => 'Beidou'], ['prompt' => 'Select One'])->label('GPS Manufacturer') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_fingerprint')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Finger Unlock') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_faceunlock')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Face Unlock') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_flash_light')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Flash Light') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'has_nfc')->dropDownList(['No', 'Yes'], ['value' => 1])->label('NFC') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'headphone_jack_size')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => '3.5mm'])->label('Headphone Jack Size') ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'is_splash_resistant')->dropDownList(['No', 'Yes'], ['value' => 1])->label('Splash Resistant') ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'extra_feature')->textInput(['autocomplete' => 'off', 'placeholder' => 'Extra feature here (Optional)']) ?>
                            </div>
                            <div class="col-sm-12">
                                <?= $form->field($model, 'sensors')->widget(\faryshta\widgets\JqueryTagsInput::className(), [
                                    'clientOptions' => [
                                        'width' => '100%',
                                        'height' => 'auto',
                                        'defaultText' => 'Add Sensor',
                                        'removeWithBackspace' => false,
                                        'interactive' => true,
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Service Details</h3>
                            <div class="col-md-3">
                                <?= $form->field($model, 'warranty_type')->dropDownList(['NULL' => 'Not Sure', 'Seller' => 'Seller', 'Manufacturer' => 'Manufacturer'], ['prompt' => 'Select One']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'warranty_period')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Months value']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'return_period')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Days value']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'replacement_period')->textInput(['type' => 'number', 'step' => '0.1', 'autocomplete' => 'off', 'placeholder' => 'Days value']) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($model, 'warranty_benefits')->widget(\faryshta\widgets\JqueryTagsInput::className(), [
                                    'clientOptions' => [
                                        'width' => '100%',
                                        'height' => 'auto',
                                        'defaultText' => 'Add Warranty benefit',
                                        'removeWithBackspace' => false,
                                        'interactive' => true,
                                    ],
                                ]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="text-center">Box-Item Details</h3>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'headphone')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'charger')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'usb_cable')->dropDownList(['No', 'Yes'], ['value' => 1]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'adapter')->dropDownList(['No', 'Yes'], ['value' => 1]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'booklet')->dropDownList(['No', 'Yes'], ['value' => 1]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'sim_ejector')->dropDownList(['No', 'Yes'], ['value' => 1]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'case_cover')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'tempered_glass')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'scratch_card')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($model, 'warranty_card')->dropDownList(['No', 'Yes'], ['value' => 0]) ?>
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

$(document).on('submit', '#add-product-form', function (event) {
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

$(document).on('change', '#has_dual_sim', function(e) {
    e.preventDefault();
    var data;
    var value = $(this).val();
    if(value == 1){
        data = '<div class="col-sm-2"><div class="form-group field-sim1_type"> <label class="control-label" for="sim1_type">Sim1 Type</label> <select id="sim1_type" class="form-control" name="sim1_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim1_size"> <label class="control-label" for="sim1_size">Sim1 Size</label> <select id="sim1_size" class="form-control" name="sim1_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim2_type"> <label class="control-label" for="sim2_type">Sim2 Type</label> <select id="sim2_type" class="form-control" name="sim2_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim2_size"> <label class="control-label" for="sim2_size">Sim2 Size</label> <select id="sim2_size" class="form-control" name="sim2_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div>';
    } else {
        data = '<div class="col-sm-2"><div class="form-group field-sim1_type"> <label class="control-label" for="sim1_type">Sim1 Type</label> <select id="sim1_type" class="form-control" name="sim1_type"><option value="GSM">GSM</option><option value="CDMA">CDMA</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-2"><div class="form-group field-sim1_size"> <label class="control-label" for="sim1_size">Sim1 Size</label> <select id="sim1_size" class="form-control" name="sim1_size"><option value="">Select Size</option><option value="Neno">Neno</option><option value="Micro">Micro</option><option value="Regular">Regular</option> </select><p class="help-block help-block-error"></p></div></div>';
    }
    $('#dual_sim_option').html(data);
});

$(document).on('click', '#add_camera', function(e) {
    e.preventDefault();
    var data = '<div id="camera-section"><div class="camera-details"><div class="col-md-12"><div class="col-sm-3"><div class="form-group field-camera_type required"> <label class="control-label" for="camera_type">Camera Type</label> <select id="camera_type" class="form-control" name="camera_type[]"><option value="">Select One</option><option value="1">Rear</option><option value="2">Front</option><option value="3">Side</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-camera_size required"> <label class="control-label" for="camera_size">Camera Size</label> <input type="number" id="camera_size" class="form-control" name="camera_size[]" autocomplete="off" placeholder="mega pixels / Multiple"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-camera_angle required"> <label class="control-label" for="camera_angle">Camera Angle</label> <select id="camera_angle" class="form-control" name="camera_angle[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="Main">Main</option><option value="Wide Angle">Wide Angle</option><option value="Telephoto">Telephoto</option><option value="Macro">Macro</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-aperture"> <label class="control-label" for="aperture">Camera Aperture</label> <input type="number" step="0.1" id="aperture" class="form-control" name="aperture[]" autocomplete="off" placeholder="Float value like f/2.1"><p class="help-block help-block-error"></p></div></div></div><div class="col-md-12"><div class="col-sm-3"><div class="form-group field-autofocus required"> <label class="control-label" for="autofocus">Autofocus</label> <select id="autofocus" class="form-control" name="autofocus[]"><option value="0">No</option><option value="1" selected="">Yes</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-recording_quality required"> <label class="control-label" for="recording_quality">Recording Quality</label> <select id="recording_quality" class="form-control" name="recording_quality[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="720">720p HD</option><option value="1080">1080p FHD</option><option value="2160">2160p 4k</option> </select><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-fps required"> <label class="control-label" for="fps">Frame per second</label> <select id="fps" class="form-control" name="fps[]"><option value="">Select One</option><option value="NULL">Not Sure</option><option value="30">30fps</option><option value="60">60fps</option><option value="90">90fps</option><option value="120">120fps</option> </select><p class="help-block help-block-error"></p></div></div></div></div></div>';
    $('#camera-section').append(data);
});

$(document).on('click', '#add_variant', function(e) {
    e.preventDefault();
    var data = '<div class="variant-details"><div class="col-sm-3"><div class="form-group field-memory_ram required"> <label class="control-label" for="memory_ram">RAM</label> <input type="number" id="memory_ram" class="form-control" name="memory_ram[]" autocomplete="off" placeholder="value as GB"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-memory_rom required"> <label class="control-label" for="memory_rom">Storage</label> <input type="number" id="memory_rom" class="form-control" name="memory_rom[]" autocomplete="off" placeholder="value as GB"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-price required"> <label class="control-label" for="price">Price</label> <input type="number" id="price" class="form-control" name="price[]" autocomplete="off" placeholder="Float value"><p class="help-block help-block-error"></p></div></div><div class="col-sm-3"><div class="form-group field-sale_price required"> <label class="control-label" for="sale_price">Sale Price</label> <input type="number" id="sale_price" class="form-control" name="sale_price[]" autocomplete="off" placeholder="Float Value"><p class="help-block help-block-error"></p></div></div></div>';
    $('#variants-section').append(data);
});

$(document).on('change', '#has_fast_charge', function(e) {
    e.preventDefault();
    var value = $(this).val();
    var tar = $('#fast_charge_section');
    if(value == 1){
        tar.fadeIn();
    } else {
        tar.fadeOut();
        $('#charge_type').val("");
    }
});

function imageOptions(){
    var val = $('#colors').val();
    var val_arr = val.split(',');
    $('.imageByColors').html("");
    for(var i=0;i<val_arr.length;i++){
        var str = val_arr[i]; 
        str = str.toLowerCase().trim();
        str = str.split(' ').join('_');
        var template = '<div class="col-md-3"><div class="form-group field-image"> <label class="control-label" for="'+str+'_image">Select Image for '+val_arr[i]+'</label> <input type="hidden" name="'+str+'_image[]" value=""> <input type="file" id="'+str+'_image" class="prod_img" name="'+str+'_image[]" multiple><p class="help-block help-block-error"></p></div></div>';
        $('.imageByColors').append(template);
    }
}

$('#colors').tagsInput({
   'height':'auto',
   'width':'100%',
   'interactive':true,
   'defaultText':'Color Here',
   'onAddTag':imageOptions,
   'onRemoveTag':imageOptions,
   // 'onChange' : callback_function,
   'removeWithBackspace' : false,
});
JS;
$this->registerJs($script);
