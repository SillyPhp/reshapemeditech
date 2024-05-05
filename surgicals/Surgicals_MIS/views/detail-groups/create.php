<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DetailGroups */

$this->title = 'Create Detail Groups';
$this->params['breadcrumbs'][] = ['label' => 'Detail Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
    ]) ?>

</div>
