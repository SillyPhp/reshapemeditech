<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Assign Media';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-assign-media container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'attribute' => 'media_name',
            'label' => 'Media Name',
            'content' => function($model){
                return $model->media->title;
            }
            ],
            'user_name',
            'phone',
            'email',
            'expiry_date_number',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
