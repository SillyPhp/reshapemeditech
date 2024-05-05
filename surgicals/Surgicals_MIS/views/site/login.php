<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-sign">
    <div class="panel-title-sign mt-xl text-right">
        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"input-group input-group-icon\">{input}</div>",
                'labelOptions' => ['class' => ''],
                'inputOptions' => ['class' => 'form-control input-lg'],
            ],
        ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class='checkbox-custom checkbox-default'>{input} {label}</div>",
                ]) ?>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-11">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>
        </div>
<!--        <p>Don't have an account yet? <a href="signup">Sign Up!</a>-->
            <?php ActiveForm::end(); ?>

    </div>
</div>