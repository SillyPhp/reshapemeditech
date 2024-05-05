<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            '_id',
            'name',
            'email:email',
            'subject',
            [
                'label' => 'Dealer',
                'content' => function ($model) {
                    if ($model->dealer == 1) {
                        return 'yes';
                    } else {
                        return 'No';
                    }
                }
            ],
            'created_at',
            //'body:ntext',
            //'dealer',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
