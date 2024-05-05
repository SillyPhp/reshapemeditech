<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DetailGroups */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-6">
        <?= $form->field($model, 'cat_id')->dropDownList($categoryList, ['prompt' => 'Select One'])->label('Category') ?>
    </div>
    <div class="col-md-12">
        <?= $form->field($model, 'pool_id')->widget(\faryshta\widgets\JqueryTagsInput::className(), [
            'clientOptions' => [
                'width' => '100%',
                'height' => 'auto',
                'defaultText' => 'Add Groups',
                'removeWithBackspace' => false,
                'interactive' => true,
            ],
        ])->label('Multiple Group Name'); ?>
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