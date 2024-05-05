<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\SpecificationValuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="specification-values-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'enc_id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'specification_id') ?>

    <?= $form->field($model, 'pool_id') ?>

    <?php // echo $form->field($model, 'is_highlighted') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_on') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
