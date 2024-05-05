<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Edit Appointment</h4>
    </div>
<?php
$form = ActiveForm::begin([
    'id' => 'edit-appointment',
    'fieldConfig' => [
        'template' => '<div class="form-group form-md-line-input form-md-floating-label">{input}{label}{error}{hint}</div>',
    ]
]);
?>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <label>Gender</label>
            <?= $form->field($model, 'gender')->inline()->radioList(['Male' => 'Male', 'Female' => 'Female','Transgender' => 'Transgender'])->label(false); ?>
        </div>
        <div class="col-md-4">
            <label>Email</label>
            <?= $form->field($model, 'email')->textInput(['autocomplete' => 'off'])->label(false); ?>
        </div>
        <div class="col-md-4">
            <label>Prev Appointment</label>
            <?= $form->field($model, 'prev_appointment')->inline()->radioList([1 => 'Yes', 0 => 'No'])->label(false); ?>
        </div>
    </div>
</div>
<div class="modal-footer">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary appointment-edit-btn', 'name' => 'user-button']); ?>
    <?= Html::button('Close', ['class' => 'btn default', 'data-dismiss' => 'modal']); ?>
</div>
<?php ActiveForm::end(); ?>
