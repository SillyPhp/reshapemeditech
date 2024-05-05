<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BrandsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
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
                    <li><span><?= $this->title ?></span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="container-fluid">
            <?php
            $form = ActiveForm::begin([
                'id' => 'brand-form',
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
                <div class="container-fluid" style="background: white; padding: 30px !important;">
                    <div class="row">
                        <div class="col-md-5">
                            <?= $form->field($model, 'name')->textInput(['autocomplete' => 'off']); ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'brand_logo')->fileInput(); ?>
                        </div>
                        <div class="col-md-3">
                            <?= $form->field($model, 'is_popular')->checkbox(['label' => 'Is Popular', 'uncheck' => null]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= Html::submitButton('Add', ['class' => 'btn btn-info submitBtn']); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="container-fluid" style="margin-top: 50px;">

            <div class="table-responsive">
                <?php
                Pjax::begin([
                    'id' => 'brands-container',
                ]);
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'label' => 'Image',
                            'content' => function ($model) {
                                return '<img src="' . Yii::$app->params->upload_directories->brand->image . '/' . $model->_uid . '/' . $model->image_enc_name . '" width="50px">';
                            }
                        ],
                        'name',
                        [
                            'label' => 'Is Popular',
                            'content' => function ($model, $key) {
                                if($model->is_popular == 1){
                                    return 'Popular';
                                } else {
                                    return "";
                                }
                            },
                        ],
                        [
                            'label' => 'Actions',
                            'content' => function ($model, $key) {
                                return Html::a('<i class="fa fa-trash"></i>',
                                    Url::to('javascript:;'),
                                    [
                                        'class' => 'btn btn-danger',
                                        'id' => 'dlt_btn',
                                        'data-key' => $key,
                                    ]);
                            },
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </section>
<?php
$script = <<<JS
$(document).on('submit','#brand-form', function(event) {
    event.preventDefault();
    var form = $(this);
    var btn = $('.submitBtn');
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
        url: '/brands/index',
        type: 'POST',
        enctype: 'multipart/form-data',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                btn.attr('disabled', false);
                btn.html(btn_value);
                toastr.success(response.message, response.title);
                location.reload();
                // $.pjax.reload({container:'#header-menu-container' , async : false});
                // form[0].reset();
            } else {
                btn.attr('disabled', false);
                btn.html(btn_value);
                toastr.error(response.message, response.title);
            }
        },
        complete: function() {
            form.data('requestRunning', false);
            btn.attr('disabled', false);
            btn.html(btn_value);
        }
    }).fail(function(data, textStatus, xhr) {
         toastr.error('Invalid URL', 'Error: '+data.responseJSON.message);
         btn.attr('disabled', false);
         btn.html(btn_value);
    });
    
});
$(document).on('click','#dlt_btn',function(event) {
    event.preventDefault();
    if (confirm("Are you sure delete this Brand ?")) {
    var btn = $(this);
    var btn_value = btn.text();
    event.stopImmediatePropagation();
    if ( btn.data('requestRunning') ) {
        return false;
    }
    btn.data('requestRunning', true);
    var dltid = btn.attr('data-key');
    $.ajax({
        url: '/brands/trash',
        method: 'POST',
        data : {id:dltid},
         beforeSend:function(){
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-circle-o-notch fa-spin"></i>');
        },
        success: function (response) {
            if (response.status == 200) {
                toastr.success(response.message, response.title);
               location.reload();
            } else {
                toastr.error(response.message, response.title);
            }
            btn.attr('disabled', false);
                btn.html(btn_value);
        },
        complete: function() {
            btn.data('requestRunning', false);
        }
    });
    }
})
JS;
$this->registerJS($script);
