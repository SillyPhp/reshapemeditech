<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Specifications */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-4">
            <?= $form->field($model, 'cat_id')->dropDownList($categoryList, ['prompt' => 'Select One',
                'onchange' => '$.post("' . Yii::$app->urlManager->createUrl('/specifications/get-group-details?id=') . '"+$(this).val(),function( data ) {
            $("select#detail_group_id").empty();
            if(data != ""){
                $("select#detail_group_id").append("<option value>Select Detail Group</option>");
            }
            $("select#detail_group_id").append(data);
        });'])->label('Category'); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'detail_group_id')->dropDownList([]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'has_variant')->dropDownList([0 => 'No', 1 => 'Yes'], ['value' => 0])->label('Variety?') ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'pool_id')->widget(\faryshta\widgets\JqueryTagsInput::className(), [
                'clientOptions' => [
                    'width' => '100%',
                    'height' => 'auto',
                    'defaultText' => 'Add Specification',
                    'removeWithBackspace' => false,
                    'interactive' => true,
                ],
            ])->label('Multiple Specifications'); ?>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php
$this->registerCss('
input#pool_id_tag {
    width: 200px;
    border: 1px solid #eee;
}
');