<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Vendors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vendors-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'user_id')->dropDownList($userList, ['prompt' => 'Select One'])->label('Category') ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'address')->widget(\yii2jodit\JoditWidget::className(), [
                'settings' => [
                    'height' => '300px',
                    'enableDragAndDropFileToEditor' => new \yii\web\JsExpression("true"),
                ],
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true, 'type' => 'number']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
