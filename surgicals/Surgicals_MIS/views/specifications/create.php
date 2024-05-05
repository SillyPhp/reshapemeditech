<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specifications */

$this->title = 'Create Specifications';
$this->params['breadcrumbs'][] = ['label' => 'Specifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
        'detailGroupList' => $detailGroupList,
    ]) ?>

</div>
