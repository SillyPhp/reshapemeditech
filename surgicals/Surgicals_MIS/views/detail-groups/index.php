<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\DetailGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Detail Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-groups-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Detail Groups', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Category',
                'content' =>  function($m){
                    return $m->cat->name;
                }
            ],
            [
                'label' => 'Name',
                'content' =>  function($m){
                    return $m->pool->name;
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
