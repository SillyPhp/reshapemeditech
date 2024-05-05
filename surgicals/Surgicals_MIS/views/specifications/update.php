<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specifications */

$this->title = 'Update Specifications: ' . $model->enc_id;
$this->params['breadcrumbs'][] = ['label' => 'Specifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->enc_id, 'url' => ['view', 'id' => $model->enc_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="specifications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoryList' => $categoryList,
        'detailGroupList' => $detailGroupList,
    ]) ?>

</div>
