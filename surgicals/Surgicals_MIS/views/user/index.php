<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="table-container table-responsive">
            <?= GridView::widget([
                'tableOptions' => [
                    'class' => 'table table-striped table-bordered table-hover table-checkable',
                    'id' => 'grid-id',
                ],
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'username',
                    'email:email',
                    [
                        'attribute' => 'contact',
                        'content' => function ($model, $key) {
                            if ($model->contact) {

                                return $model->contact;
                            }
                        }
                    ],
                    //'status',
                    //'updated_at',
                    //'verification_token',
                    [
                        'attribute' => 'total_referance',
                        'content' => function ($model, $key) {
                            if ($model->total_referance) {

                                return $model->total_referance;
                            }
                        }
                    ],
                    [
                        'label' => 'Copy referral link',
                        'content' => function ($model, $key) {
                            $ref = '';
                            if ($model->refferal) {
                                foreach ($model->refferal as $r) {
                                    $ref = $r->code;
                                }
                            }
                            if ($ref) {

                                return '<a href="javascript:;" data-id="' . $ref . '" class="fa fa-copy copyLink"></a>';
                            }
                        }
                    ],

//                ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
<?php
$script = <<<JS
$(document).on('click','.copyLink',function() {
  var src = $(this).attr('data-id');
  var link = "http://mutantnation.in?ref=" + src;
  var dummy = $('<input class="hiddenCopy">').val(link).appendTo('body').select();
    document.execCommand("Copy");
    $("body").find("[class='hiddenCopy']").remove(); 
    toastr.success("Success", "Refferal Link Copied");
});
JS;
$this->registerJS($script);
