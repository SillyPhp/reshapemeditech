<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Order Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'product_name',
                'label' => 'Product Name',
                'content' => function ($model) {
                    if($model->productCombinations->products->name){
                        return $model->productCombinations->products->name;
                    }
                }
            ],
            [
                'attribute' => 'price',
                'content' => function ($model) {
                    if($model->price){
                                return '₹ ' . $model->price;
                    }
                }
            ],
            [
                'attribute' => 'discount',
                'content' => function ($model) {
                    if ($model->discount) {
                        return '₹ ' . $model->discount;
                    }
                }
            ],
            'quantity',
            [
                'attribute' => 'tax_amount',
                'content' => function ($model) {
                    if ($model->tax_amount) {
                        return '₹ ' . $model->tax_amount;
                    }
                }
            ],

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
