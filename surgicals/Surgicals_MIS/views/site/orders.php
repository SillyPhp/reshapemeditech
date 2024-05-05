<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2><?= $this->title ?></h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="/">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span><?= $this->title ?></span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="faq-index container-fluid">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'full_name',
                    'label' => 'Name',
                    'content' => function ($model) {
                        return $model->first_name . ' ' . $model->last_name;
                    }
                ],
                'contact',
                'email',
                'address1',
                'address2',
                [
                    'label' => 'Sub Total',
                    'content' => function ($model) {
                        return $model->sub_total;
                    }
                ],
                [
                    'label' => 'Tax',
                    'content' => function ($model) {
                        return $model->tax_amount;
                    }
                ],
                [
                    'label' => 'Shipping Charges',
                    'content' => function ($model) {
                        return $model->shipping_charges;
                    }
                ],
                [
                    'label' => 'Grand Total',
                    'content' => function ($model) {
                        return $model->grand_total;
                    }
                ],
                [
                    'label' => 'City',
                    'content' => function ($model) {
                        return $model->cityEnc->name;
                    }
                ],
                [
                    'label' => 'Actions',
                    'content' => function ($model) {
                        return Html::a('View All',
                            Url::to('/site/order-items?OrderItemSearch[order_id]=' . $model->_id),
                            [
                            ]);
                    }
                ],

//            ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>


    </div>
</section>
