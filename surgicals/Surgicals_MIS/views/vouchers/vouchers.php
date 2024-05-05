<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BlogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vouchers';
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

        <div class="container-fluid">
            <p>
                <?= Html::a('Create Vouchers', ['add'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'name',
                        [
                            'attribute' => 'type',
                            'label' => 'Amount',
                            'filter' => ['fixed' => 'Fixed','percentage' => 'Percentage'],
                            'content' => function($model, $key){
                                if($model->type == "percentage"){
                                    $res = $model->amount . " % Discount";
                                } else {
                                    $res = floatval($model->amount) . " Rs Fixed Discount";
                                }
                                return $res;
                            }
                        ],
                        [
                            'label' => 'Use Once',
                            'content' => function($model, $key){
                                if($model->use_once){
                                    return "yes";
                                } else {
                                    return "no";
                                }
                            }
                        ],
                        [
                            'label' => 'Expiry On',
                            'content' => function($model, $key){
                                if($model->end_datetime){
                                    return date('d M Y h:i A',strtotime($model->end_datetime));
                                }
                            }
                        ],
                        [
                            'attribute' => 'brand_name',
                            'label' => 'Brand',
                            'content' => function($model, $key){
                                if($model->brand_id) {
                                    return $model->brand->name;
                                }
                            }
                        ],
                        [
                            'attribute' => 'category_name',
                            'label' => 'Category',
                            'content' => function($model, $key){
                                if($model->category_id){
                                return $model->category->name;
                                }
                            }
                        ],
                        [
                            'label' => 'Actions',
                            'contentOptions' => ['style' => 'min-width:100px'],
                            'content' => function ($model,$key) {
                                return Html::a('<i class="fa fa-trash"></i>',
                                        Url::to('#'),
                                        [
                                            'class' => 'btn btn-danger edit_btn',
                                            'id' => 'dlt_btn',
                                            'data-key' => $model->_uid,
                                        ]);
                            }
                        ]

//            ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>

        </div>
    </section>


<?php
$script = <<<JS
$(document).on('click','#dlt_btn',function(e){
   e.preventDefault();
   var btn = $(this);
   if(confirm("Are you sure ?")){
   var btnParent = btn.parent().parent();
   var id = btn.attr('data-key');
   e.stopImmediatePropagation();
        if (btn.data('requestRunning')) {
            return false;
        }
        btn.data('requestRunning', true);
   $.ajax({
        url: '/vouchers/trash',
        type: "POST",
        data: {id:id},
        beforeSend: function() {
                btn.html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i>');
                btn.attr("disabled", true);
            },
        success: function (response) {
            if(response.status == 200){
                toastr.success(response.message, response.title);
                btnParent.remove();
            } else {
                toastr.error(response.message, response.title);
                btn.attr("disabled", false);
            }
        },
    })
    }
});
JS;
$this->registerJS($script);