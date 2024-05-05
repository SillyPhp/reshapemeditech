<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

Yii::$app->view->registerJs('var base_url = "' . Yii::$app->params->baseUrl . '"', \yii\web\View::POS_HEAD);
$this->title = 'Assign Media';
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $mediaName ?></h2>

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
    <div class="row">
        <div class="assign-media container-fluid">
            <div class="assign-media-form">
                <?php $form = ActiveForm::begin(['id' => 'assign-media-form']); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label>Name</label>
                            <?= $form->field($model, 'name')->textInput(['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => true])->label(false); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Phone No.</label>
                            <?= $form->field($model, 'phone_num')->textInput(['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => true])->label(false); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <label>Email</label>
                            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => true])->label(false); ?>
                        </div>
                        <div class="col-md-6">
                            <label>Number Expire in days</label>
                            <?= $form->field($model, 'expiry_date')->textInput(['class' => 'form-control', 'autocomplete' => 'off', 'autofocus' => true])->label(false); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['id' => 'assign_media_btn', 'class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="all-assign-media container-fluid">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label' => 'Generate Link',
                        'content' => function ($model) {
                            return Html::a('Generate Link',
                                Url::to('javascript:;'),
                                [
                                    'onclick' => 'CopyToClipboard("'.$model->media->_uid.'","' . $model->has_token_key . '")',
                                    'class' => 'btn btn-info',
                                    'data-toggle' => 'tooltip',
                                    'title' => 'Click To Copy Affiliate Link',
                                ]);
                        }
                    ],
                    'user_name',
                    'phone',
                    'email',
                    'expiry_date_number',
                    [
                        'attribute' => 'media_name',
                        'label' => 'Media Name',
                        'content' => function ($model) {
                            return $model->media->title;
                        }
                    ],

//            ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</section>
<?php
$this->registerCss('
.tcenter{
text-align:center;
}
');
$script = <<<JS
$(document).on('submit','#assign-media-form',function(e) {
  e.preventDefault();
  var form = $(this);
  var btn = $('#assign_media_btn');
  var btn_value = btn.text();
  var url = form.attr('action');
  var method = form.attr('method');
  var data = form.serialize();
  $.ajax({
        url: url,
        type: method,
        data: data,
        beforeSend: function() {
                btn.html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
                btn.attr("disabled", true);
            },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                window.location.reload();
            } else {
                toastr.error(response.message, response.title);
            }
            btn.attr("disabled", false);
            btn.html(btn_value);
        },
    })
 
});
JS;
$this->registerJS($script);
?>
<script>
    function CopyToClipboard(slug_id,token_id) {
        var scr = base_url+'/spiritual/media' +'?token=' + token_id+'&slug='+slug_id;
        var dummy = $('<input>').val(scr).appendTo('body').select();
        document.execCommand("copy");
        toastr.success("Success", "Copied");
    }
</script>


