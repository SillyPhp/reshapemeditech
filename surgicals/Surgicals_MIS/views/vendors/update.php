<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Vendors */

$this->title = 'Update Vendors: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->enc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="vendors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'userList' => $userList,
    ]) ?>

</div>
