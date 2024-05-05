<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['id' => 'signup-form']); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'first_name')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'last_name')->textInput() ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-6">
                <?= $form->field($model, 'username')->textInput() ?>

            </div>
            <div class="col-md-6">

                <?= $form->field($model, 'email')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
<?php
$script = <<<JS
$(document).on('submit', '#signup-form', function(event) {
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

