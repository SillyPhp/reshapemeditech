<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SpecificationValues */

$this->title = $model->pool->name;
$this->params['breadcrumbs'][] = ['label' => 'Specification Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="specification-values-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Specification Name',
                'value' => function($m){
                    return $m->specification->pool->name;
                },
            ],
            [
                'label' => 'Value',
                'value' => function($m){
                    return $m->pool->name;
                },
            ],
            [
                'label' => 'Product Name',
                'value' => function($m){
                    return $m->product->name;
                },
            ],
            [
                'label' => 'Category',
                'value' => function($m){
                    return $m->product->cat->name;
                },
            ],
            [
                'label' => 'Detail Group',
                'value' => function($m){
                    return $m->specification->detailGroup->pool->name;
                },
            ],
        ],
    ]) ?>

</div>
