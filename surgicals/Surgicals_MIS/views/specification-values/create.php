<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SpecificationValues */

$this->title = 'Create Specification Values';
$this->params['breadcrumbs'][] = ['label' => 'Specification Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specification-values-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productList' => $productList,
    ]) ?>

</div>
