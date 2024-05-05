<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpecificationValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specification-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList($productList, ['prompt' => '',
        'onchange' => '$.post("' . Yii::$app->urlManager->createUrl('/specification-values/get-specifications?id=') . '"+$(this).val(),function( data ) {
            $("select#specificationvalues-specification_id").empty();
            if(data != ""){
                $("select#specificationvalues-specification_id").append("<option value>Select Specification</option>");
            }
            $("select#specificationvalues-specification_id").append(data);
        });']) ?>

    <?= $form->field($model, 'specification_id')->dropDownList([], ['prompt' => ''])->label('Specificattions') ?>

    <?= $form->field($model, 'pool_id')->textInput(['maxlength' => true])->label('Value') ?>

    <?= $form->field($model, 'is_highlighted')->dropDownList([0 => 'No', 1 => 'Yes'],['prompt' => 'Select One'])->label('Highlight?') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
