<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
if($id){
    $this->title = 'Edit Prayer';
    $btn_value = 'Update';
} else {
    $this->title = 'Add Prayers';
    $btn_value = 'Submit';
}
?>
    <section role="main" class="content-body">

<?php $form = ActiveForm::begin(['id' => 'prayer-form']); ?>

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
    <div class="row container-fluid">
        <div class="col-md-12">
            <div class="col-md-6">
                <label>Title</label>
                <?= $form->field($model, 'title')->textInput(['autocomplete' => 'false'])->label(false) ?>
            </div>
            <div class="col-md-6">
                <label>Description</label>
                <?= $form->field($model, 'description')->textInput(['autocomplete' => 'false'])->label(false) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($btn_value, ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
    </section>
<?php
$script = <<<JS
$(document).on('submit', '#prayer-form', function(event) {
        event.preventDefault();
        var form = $(this);
        event.stopImmediatePropagation();
        if ( form.data('requestRunning') ) {
            return false;
        }
        form.data('requestRunning', true);
        var url = form.attr('action');
        var method = form.attr('method');
        var data = form.serialize();
          $.ajax({
            url: url,
            method: method,
            data:data,
            beforeSend:function(){   
            },
            success: function (response) {
                if (response.status == 200) {
                    toastr.success(response.message, response.title);
                    form[0].reset();
                    window.location.href = '/site/prayers';
                } else {
                    toastr.error(response.message, response.title);
                }
            },
            complete: function() {
                form.data('requestRunning', false);
            }
        });
    });
JS;
$this->registerJS($script);

