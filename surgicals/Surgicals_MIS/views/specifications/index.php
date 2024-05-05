<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\SpecificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Specifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Specifications', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'spec_name',
                'label' => 'Name',
                'content' => function ($m) {
                    return $m->pool->name;
                }
            ],
            [
                'attribute' => 'group_name',
                'label' => 'Detail Group Name',
                'content' => function ($m) {
                    return $m->detailGroup->pool->name;
                }
            ],
            [
                'attribute' => 'cat_name',
                'label' => 'Category',
                'content' => function ($m) {
                    return $m->cat->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
