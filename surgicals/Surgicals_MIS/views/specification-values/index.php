<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SpecificationValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specification Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specification-values-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Specification Values', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Specification Name',
                'content' => function($m){
                    return $m->specification->pool->name;
                },
            ],
            [
                'label' => 'Value',
                'content' => function($m){
                    return $m->pool->name;
                },
            ],
            [
                'label' => 'Product Name',
                'content' => function($m){
                    return $m->product->name;
                },
            ],
            [
                'label' => 'Category',
                'content' => function($m){
                    return $m->product->cat->name;
                },
            ],
            [
                'label' => 'Detail Group',
                'content' => function($m){
                    return $m->specification->detailGroup->pool->name;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
