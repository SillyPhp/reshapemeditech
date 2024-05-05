<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VendorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vendors-index container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Vendors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'phone',
            [
                'label' => 'Proprietor Name',
                'content' => function ($m) {
                    return $m->user->username;
                }
            ],
            [
                'attribute' => 'address',
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'filter' => [0 => 'Pending', 1 => 'Approved', 3 => 'Rejected'],
                'content' => function ($m) {
                    switch ($m->status) {
                        case 0 :
                            $status = 'Pending';
                            break;
                        case 1 :
                            $status = 'Approved';
                            break;
                        case 2 :
                            $status = 'Rejected';
                            break;
                        default :
                            $status = 'N/A';
                    }
                    return $status;
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
